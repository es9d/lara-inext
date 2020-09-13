<?php

namespace App\Services\Gateways;

use Omnipay\Omnipay;

class PaypalExpress
{
    public $company;

    /**
     * PaypalExpress Construct
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
        $gateway = Omnipay::create('PayPal_Express');

        $gateway->setUsername($this->company->getSetting('paypal_username'));
        $gateway->setPassword($this->company->getSetting('paypal_password'));
        $gateway->setSignature($this->company->getSetting('paypal_signature'));
        $gateway->setTestMode($this->company->getSetting('paypal_test_mode'));
 
        return $gateway;
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function purchase(array $parameters)
    {
        $response = $this->gateway()
            ->purchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param array $parameters
     */
    public function complete(array $parameters)
    {
        $response = $this->gateway()
            ->completePurchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param $amount
     */
    public function formatAmount($amount)
    {
        return number_format($amount/100, 2, '.', '');
    }

    /**
     * @param $invoice
     */
    public function getCancelUrl($invoice)
    {
        return route('customer_portal.invoices.paypal.cancelled', [
            'customer' => $invoice->customer->uid ,
            'invoice' => $invoice->uid
        ]);
    }

    /**
     * @param $invoice
     */
    public function getReturnUrl($invoice)
    {
        return route('customer_portal.invoices.paypal.completed', [
            'customer' => $invoice->customer->uid ,
            'invoice' => $invoice->uid
        ]);
    }
}
