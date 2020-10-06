<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Payment\Store;
use App\Http\Requests\Application\Payment\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display Payments Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get Payments by Company
        $payments = QueryBuilder::for(Payment::findByCompany($currentCompany->id))
        ->allowedFilters([
            AllowedFilter::partial('payment_number'),
            AllowedFilter::exact('payment_method_id'),
            AllowedFilter::scope('from'),
            AllowedFilter::scope('to'),
        ])
        ->oldest()
        ->paginate()
        ->appends(request()->query());

        return view('application.payments.index', [
            'payments' => $payments
        ]);
    }

    /**
     * Display the Form for Creating New Payment
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get next Payment number if the auto generation option is enabled
        $payment_prefix = $currentCompany->getSetting('payment_prefix');
        $next_payment_number = Payment::getNextPaymentNumber($payment_prefix);


        // Create new Payment model and set estimate_number and company_id
        // so that we can use them in the form
        $payment = new Payment();
        $payment->payment_number = $next_payment_number ?? 0;
        $payment->company_id = $currentCompany->id;

        // If the request has invoice parameter then set
        // invoice_id and customer_id from the given invoice.
        if ($request->has('invoice')) {
            $invoice = Invoice::find($request->invoice);

            // Checking if invoice is exist
            if($invoice) {
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $invoice->customer_id;
                $payment->amount = $invoice->due_amount;
            }
        }
        $current_customer = Customer::find(['id' =>$request->customerid])->first();
        return view('application.payments.create', [
            'payment' => $payment,
            'current_customer'=> $current_customer,
        ]);
    }

     /**
     * Store the Payments in Database
     *
     * @param \App\Http\Requests\Application\Payment\Store $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Payment and Store in Database
        $payment = Payment::create([
            'payment_date' => $request->payment_date,
            'payment_number' => $request->payment_number,
            'customer_id' => $request->customer_id,
            'company_id' => $currentCompany->id,
            'invoice_id' => $request->invoice_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
        ]);

        // Find the Invoice which belongs to Payment
        $invoice = Invoice::findOrFail($payment->invoice_id);

        // Update the status to complete and paid if the payment amount
        // is the same with the amount of invoice
        if ($invoice->due_amount == $payment->amount) {
            $invoice->status = Invoice::STATUS_COMPLETED;
            $invoice->paid_status = Invoice::STATUS_PAID;
            $invoice->due_amount = 0;

        // If it is partially paid then set status to partially paid
        } else if ($invoice->due_amount != $payment->amount) {
            $invoice->due_amount = (int) $invoice->due_amount - (int)$payment->amount;

            // If the due_amount is negative delete the payment then go back
            if ($invoice->due_amount < 0) {
                $payment->delete();
                return redirect()->back()->withErrors(['amount' => __('messages.invalid_amount')]);
            }

            // Set status to partially paid
            $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
        }

        // Update the Invoice
        $invoice->save();

        session()->flash('alert-success', __('messages.payment_added'));
        return redirect()->route('payments');
    }

    /**
     * Display the Form for Editing Payment
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $payment = Payment::findOrFail($request->payment);
        $current_customer = Customer::find(['id' =>$request->customerid])->first();
        return view('application.payments.edit', [
            'payment' => $payment,
            'current_customer'=> $current_customer,
        ]);
    }

    /**
     * Update the Payment in Database
     *
     * @param \App\Http\Requests\Application\Payment\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $payment = Payment::findOrFail($request->payment);
        $oldAmount = $payment->amount;

        // Check whether the amount is updated or not.
        // If it updated then update the invoice
        if ($oldAmount != $request->amount) {
            $amount = (int) $request->amount - (int) $oldAmount;
            $invoice = Invoice::findOrFail($request->invoice_id);
            $invoice->due_amount = (int) $invoice->due_amount - (int) $amount;

            // If the due_amount is negative then go back
            if ($invoice->due_amount < 0) {
                return redirect()->back()->withErrors(['amount' => __('messages.invalid_amount')]);
            }

            // Set new Invoice status
            if ($invoice->due_amount == 0) {
                $invoice->status = Invoice::STATUS_COMPLETED;
                $invoice->paid_status = Invoice::STATUS_PAID;
            } else {
                $invoice->status = $invoice->getPreviousStatus();
                $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
            }

            // Save the Invoice
            $invoice->save();
        }

        // Update the Payment
        $payment->update([
            'payment_date' => $request->payment_date,
            'payment_number' => $request->payment_number,
            'customer_id' => $request->customer_id,
            'invoice_id' => $request->invoice_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
        ]);

        session()->flash('alert-success', __('messages.payment_updated'));
        return redirect()->route('payments');
    }

    /**
     * Delete the Payment
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $payment = Payment::findOrFail($request->payment);

        // Decrease paid amount from the invoice
        if ($payment->invoice_id != null) {
            $invoice = Invoice::findOrFail($payment->invoice_id);
            $invoice->due_amount = ((int)$invoice->due_amount + (int)$payment->amount);

            // Set new Invoice paid_status
            if ($invoice->due_amount == $invoice->total) {
                $invoice->paid_status = Invoice::STATUS_UNPAID;
            } else {
                $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
            }

            // Save the Invoice
            $invoice->status = $invoice->getPreviousStatus();
            $invoice->save();
        }

        // Delete Payment from Database
        $payment->delete();

        session()->flash('alert-success', __('messages.payment_deleted'));
        return redirect()->route('payments');
    }
}
