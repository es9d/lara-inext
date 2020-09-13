<?php

namespace App\Http\Controllers\CustomerPortal\Checkout;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Services\Gateways\Razorpay;

class RazorpayController extends BaseGatewayController
{
    /**
     * Display the Razorpay Checkout Form
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);

        // Get Razorpay Service
        $razorpay = new Razorpay($invoice->company);

        // Create Razorpay Order
        $order = $razorpay->create([
            'receipt' => $invoice->invoice_number,
            'amount' => $invoice->due_amount,
            'currency' => $invoice->currency_code
        ]);

        // Get callback url
        $callbackUrl = $razorpay->getReturnUrl($invoice);

        return view('customer_portal.checkout.razorpay', [
            'invoice' => $invoice,
            'order' => $order,
            'callbackUrl' => $callbackUrl
        ]);
    }

    /**
     * Complete the Payment Request
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);

        // Get Razorpay Service
        $razorpay = new Razorpay($invoice->company);

        // Check if the signature is correct or not
        $check = $razorpay->checkSignature($request->only('razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature'));
 
        // If payment was successful then save payment and return user to success page
        if ($check) {
            // Create and Save Payment to Database
            $payment = $this->savePayment($invoice, 'Razorpay', $request->rzp_orderid);

            session()->flash('message-success', __('messages.payment_successful', ['payment_number' => $payment->payment_number]));
            return redirect()->route('customer_portal.invoices.details', [
                'customer' => $request->customer, 
                'invoice' => $request->invoice
            ]);
        }

        // Something else happend, go back to invoice details
        session()->flash('message-danger', __('messages.error_while_proccessing_payment'));
        return redirect()->route('customer_portal.invoices.details', [
            'customer' => $request->customer, 
            'invoice' => $request->invoice
        ]);
    }
}