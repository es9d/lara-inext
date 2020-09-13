<?php

namespace App\Http\Controllers\CustomerPortal\Checkout;

use App\Http\Controllers\Controller;
use App\Mails\PaymentReceiptToCustomer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Mail;

class BaseGatewayController extends Controller
{
    /**
     * Helper function to
     * Save Payment to Database
     * 
     * @param \App\Models\Invoice $invoice
     * @param string $gateway
     * @param string $reference
     * 
     * @return \App\Models\Payment
     */
    public function savePayment($invoice, $gateway, $reference)
    {
        // Set payment_number
        $payment_prefix = $invoice->company->getSetting('payment_prefix');
        $next_payment_number = Payment::getNextPaymentNumber($payment_prefix);
        $payment_number_with_prefix = $payment_prefix.'-'.sprintf('%06d', intval($next_payment_number));

        // Find or Create Payment Method
        $method = PaymentMethod::firstOrCreate(['name' => $gateway]);

        // Create Payment and Store in Database 
        $payment = Payment::create([
            'payment_date' => now()->format('Y-m-d'),
            'payment_number' => $payment_number_with_prefix,
            'customer_id' => $invoice->customer->id,
            'company_id' => $invoice->company->id,
            'invoice_id' => $invoice->id,
            'payment_method_id' => $method->id,
            'transaction_reference' => $reference,
            'amount' => $invoice->due_amount,
        ]);

        // Update Invoice Status
        $invoice->status = Invoice::STATUS_COMPLETED;
        $invoice->paid_status = Invoice::STATUS_PAID;
        $invoice->due_amount = 0;
        $invoice->save();

        // Send Mail to Customer
        try {
            Mail::to($invoice->customer->email)->send(new PaymentReceiptToCustomer($payment));
        } catch (\Throwable $th) {
            session()->flash('message-danger', __('messages.email_could_not_sent'));
        }
    
        // Log activity
        activity()->on($payment->customer)->by($payment)
            ->log('Payment Receipt :causer.payment_number emailed to Customer by system.');

        return $payment;
    }
}