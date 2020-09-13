<?php

namespace App\Http\Controllers\CustomerPortal\Checkout;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Services\Gateways\Stripe;

class StripeController extends BaseGatewayController
{
    /**
     * Display the Stripe Checkout Form
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);

        return view('customer_portal.checkout.stripe', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Create the Payment Request
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);
 
        // Get Stripe Service
        $stripe = new Stripe($invoice->company);
 
        // Make the Payment Request
        $response = $stripe->purchase([
            'amount' => $stripe->formatAmount($invoice->due_amount),
            'currency' => $invoice->currency_code,
            'paymentMethod' => $request->paymentMethodId,
            'description' => 'Invoice ' . $invoice->invoice_number, 
            'returnUrl' => $stripe->getReturnUrl($invoice),
            'confirm' => true,
        ]);

        // If payment was successful then save payment and return user to success page
        if ($response->isSuccessful()) {
            // Create and Save Payment to Database
            $payment = $this->savePayment($invoice, 'Stripe', $response->getPaymentIntentReference());
            
            session()->flash('message-success', __('messages.payment_successful', ['payment_number' => $payment->payment_number]));
            return redirect()->route('customer_portal.invoices.details', [
                'customer' => $request->customer, 
                'invoice' => $request->invoice
            ]);
        } 
        // If stripe needs additional redirect like 3d secure then redirect the customer
        elseif ($response->isRedirect()) {
            $response->redirect();
        }
        
        // Something else happend, go back to invoice details
        session()->flash('message-danger', $response->getMessage());
        return redirect()->route('customer_portal.invoices.details', [
            'customer' => $request->customer, 
            'invoice' => $request->invoice
        ]);
    }

    /**
     * Complete the Payment Request
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function completed(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);

        // Get Stripe Service
        $paypal = new Stripe($invoice->company);

        // Complete the Payment Request
        $response = $paypal->complete([
            'paymentIntentReference' => $request->payment_intent,
            'returnUrl' => $paypal->getReturnUrl($invoice),
        ]);
 
        // If payment was successful then save payment and return user to success page
        if ($response->isSuccessful()) {
            // Create and Save Payment to Database
            $payment = $this->savePayment($invoice, 'Stripe', $response->getPaymentIntentReference());

            session()->flash('message-success', __('messages.payment_successful', ['payment_number' => $payment->payment_number]));
            return redirect()->route('customer_portal.invoices.details', [
                'customer' => $request->customer, 
                'invoice' => $request->invoice
            ]);
        }

        // Something else happend, go back to invoice details
        session()->flash('message-danger', $response->getMessage());
        return redirect()->route('customer_portal.invoices.details', [
            'customer' => $request->customer, 
            'invoice' => $request->invoice
        ]);
    }
}