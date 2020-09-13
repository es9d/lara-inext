<?php

namespace App\Services\Gateways;

use Razorpay\Api\Api;

class Razorpay
{
    public $company;

    /**
     * Razorpay Construct
     */
    function __construct($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function gateway()
    {
        return new Api($this->company->getSetting('razorpay_id'), $this->company->getSetting('razorpay_secret_key'));
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters)
    {
        $gateway = $this->gateway();
        return $gateway->order->create($parameters);
    }

    /**
     * @param array $parameters
     */
    public function checkSignature(array $parameters)
    {
        try {
            $gateway = $this->gateway();
            $attributes  = [
                'razorpay_signature' => $parameters['razorpay_signature'],
                'razorpay_payment_id' => $parameters['razorpay_payment_id'],
                'razorpay_order_id' => $parameters['razorpay_order_id']
            ];
            $gateway->utility->verifyPaymentSignature($attributes);

            // Signature is correct
            return true;
        }
        catch(\Exception $e) {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

    /**
     * @param $invoice
     */
    public function getReturnUrl($invoice)
    {
        return route('customer_portal.invoices.razorpay.callback', [
            'customer' => $invoice->customer->uid ,
            'invoice' => $invoice->uid
        ]);
    }
}
