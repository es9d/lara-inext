<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Mails\InvoiceToCustomer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Invoice\Store;
use App\Http\Requests\Application\Invoice\Update;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceController extends Controller
{
    /**
     * Display Invoices Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Query Invoices by Company and Tab
        if($request->tab == 'all') {
            $query = Invoice::findByCompany($currentCompany->id)->orderBy('invoice_number');
            $tab = 'all';
        } else if($request->tab == 'due') {
            $query = Invoice::findByCompany($currentCompany->id)->active()->orderBy('due_date');
            $tab = 'due';
        } else {
            $query = Invoice::findByCompany($currentCompany->id)->drafts()->orderBy('invoice_number');
            $tab = 'drafts';
        }

        // Apply Filters and Paginate
        $invoices = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ])
            ->paginate()
            ->appends(request()->query());

        return view('application.invoices.index', [
            'invoices' => $invoices,
            'tab' => $tab,
        ]);
    }

    /**
     * Display the Form for Creating New Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get next Invoice number if the auto generation option is enabled
        $invoice_prefix = $currentCompany->getSetting('invoice_prefix');
        $next_invoice_number = Invoice::getNextInvoiceNumber($invoice_prefix);


        // Create new number model and set invoice_number and company_id
        // so that we can use them in the form
        $invoice = new Invoice();
        $invoice->invoice_number = $next_invoice_number;
        $invoice->company_id = $currentCompany->id;

        // Also for filling form data and the ui
        $customers = $currentCompany->customers;
        $products = $currentCompany->products;
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
        
        return view('application.invoices.create', [
            'invoice' => $invoice,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $tax_per_item,
            'discount_per_item' => $discount_per_item,
        ]);
    }

    /**
     * Store the Invoice in Database
     *
     * @param \App\Http\Requests\Application\Invoice\Store $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get company based settings
        $tax_per_item = (boolean) $currentCompany->getSetting('tax_per_item');
        $discount_per_item = (boolean) $currentCompany->getSetting('discount_per_item');
 
        // Save Invoice to Database
        $invoice = Invoice::create([
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_number' => $request->invoice_number,
            'reference_number' => $request->reference_number,
            'customer_id' => $request->customer_id,
            'company_id' => $currentCompany->id,
            'status' => Invoice::STATUS_DRAFT,
            'paid_status' => Invoice::STATUS_UNPAID,
            'sub_total' => $request->sub_total,
            'discount_type' => 'percent',
            'discount_val' => $request->total_discount ?? 0,
            'total' => $request->grand_total,
            'due_amount' => $request->grand_total,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
            'tax_per_item' => $tax_per_item,
            'discount_per_item' => $discount_per_item,
        ]);

        // Arrays of data for storing Invoice Items
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $currentCompany->id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.invoice_added'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Display the Invoice Details Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice);

        return view('application.invoices.details', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Send an email to customer about the Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice);

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('invoices.details', $invoice->id);
        };

        // Send mail to customer
        try {
            Mail::to($invoice->customer->email)->send(new InvoiceToCustomer($invoice));
        } catch (\Throwable $th) {
            session()->flash('message-danger', __('messages.email_could_not_sent'));
        }

        // Log the activity
        activity()->on($invoice->customer)->by($invoice)
            ->log('Invoice :causer.invoice_number emailed to Customer by system.');

        // Change the status of the Invoice
        if ($invoice->status == Invoice::STATUS_DRAFT) {
            $invoice->status = Invoice::STATUS_SENT;
            $invoice->sent = true;
            $invoice->save();
        }

        session()->flash('alert-success', __('messages.an_email_sent_to_customer'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Change Status of the Invoice by Given Status
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function mark(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice);

        // Mark the Invoice by given status
        if ($request->status && $request->status == 'sent') {
            $invoice->status = Invoice::STATUS_SENT;
            $invoice->sent = true;
        } else if ($request->status && $request->status == 'paid') {
            $invoice->status = Invoice::STATUS_COMPLETED;
            $invoice->paid_status = Invoice::STATUS_PAID;
        } else if ($request->status && $request->status == 'unpaid') {
            $invoice->paid_status = Invoice::STATUS_UNPAID;
        }

        // Save the status
        $invoice->save();

        session()->flash('alert-success', __('messages.invoice_status_updated'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Display the Form for Editing Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $invoice = Invoice::findOrFail($request->invoice);

        // Filling form data and the ui
        $customers = $currentCompany->customers;
        $products = $currentCompany->products;

        return view('application.invoices.edit', [
            'invoice' => $invoice,
            'customers' => $customers,
            'products' => $products,
            'tax_per_item' => $invoice->tax_per_item,
            'discount_per_item' => $invoice->discount_per_item,
        ]);
    }

    /**
     * Update the Invoice in Database
     *
     * @param \App\Http\Requests\Application\Invoice\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Find Invoice or Fail (404 Http Error)
        $invoice = Invoice::findOrFail($request->invoice);

        // Getting old amount
        $oldAmount = $invoice->total;
        if ($oldAmount != $request->total) {
            $oldAmount = (int)round($request->grand_total) - (int)$oldAmount;
        } else {
            $oldAmount = 0;
        }

        // Update Invoice due_amount
        $invoice->due_amount = ($invoice->due_amount + $oldAmount);

        // Update Invoice status based on new due amount
        if ($invoice->due_amount == 0 && $invoice->paid_status != Invoice::STATUS_PAID) {
            $invoice->status = Invoice::STATUS_COMPLETED;
            $invoice->paid_status = Invoice::STATUS_PAID;
        } elseif ($invoice->due_amount < 0 && $invoice->paid_status != Invoice::STATUS_UNPAID) {
            session()->flash('alert-danger', __('messages.invalid_due_amount'));
            return redirect()->route('invoices.edit', $invoice->id);
        } elseif ($invoice->due_amount != 0 && $invoice->paid_status == Invoice::STATUS_PAID) {
            $invoice->status = $invoice->getPreviousStatus();
            $invoice->paid_status = Invoice::STATUS_PARTIALLY_PAID;
        }

        // Update Invoice
        $invoice->update([
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'invoice_number' => $request->invoice_number,
            'reference_number' => $request->reference_number,
            'customer_id' => $request->customer_id,
            'discount_type' => 'percent',
            'discount_val' => $request->total_discount ?? 0,
            'sub_total' => $request->sub_total,
            'total' => $request->grand_total,
            'notes' => $request->notes,
            'private_notes' => $request->private_notes,
        ]);

        // Posted Values
        $products = $request->product;
        $quantities = $request->quantity;
        $taxes = $request->taxes;
        $prices = $request->price;
        $totals = $request->total;
        $discounts = $request->discount;

        // Remove old invoice items
        $invoice->items()->delete();

        // Add products (invoice items)
        for ($i=0; $i < count($products); $i++) {
            $item = $invoice->items()->create([
                'product_id' => $products[$i],
                'company_id' => $currentCompany->id,
                'quantity' => $quantities[$i],
                'discount_type' => 'percent',
                'discount_val' => $discounts[$i] ?? 0,
                'price' => $prices[$i],
                'total' => $totals[$i],
            ]);

            // Add taxes for Invoice Item if it is given
            if ($taxes && array_key_exists($i, $taxes)) {
                foreach ($taxes[$i] as $tax) {
                    $item->taxes()->create([
                        'tax_type_id' => $tax
                    ]);
                }
            }
        }

        // Remove old invoice taxes
        $invoice->taxes()->delete();

        // If Invoice based taxes are given
        if ($request->has('total_taxes')) {
            foreach ($request->total_taxes as $tax) {
                $invoice->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.invoice_updated'));
        return redirect()->route('invoices.details', $invoice->id);
    }

    /**
     * Delete the Invoice
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice);

        // return error if payment already exists with the invoice
        if ($invoice->payments()->exists() && $invoice->payments()->count() > 0) {
            session()->flash('alert-danger', __('messages.invoice_cant_delete'));
            return redirect()->route('invoices');
        }

        // Delete Invoice from Database
        $invoice->delete();

        session()->flash('alert-success', __('messages.invoice_deleted'));
        return redirect()->route('invoices');
    }
}
