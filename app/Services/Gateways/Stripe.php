<?php

namespace App\Services\Gateways;

use Omnipay\Omnipay;

class Stripe
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
        $gateway = Omnipay::create('Stripe\PaymentIntents');

        $gateway->setApiKey($this->company->getSetting('stripe_secret_key'));
        $gateway->setTestMode($this->company->getSetting('stripe_test_mode'));
 
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
            ->confirm($parameters)
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
    public function getReturnUrl($invoice)
    {
        return route('customer_portal.invoices.stripe.completed', [
            'customer' => $invoice->customer->uid ,
            'invoice' => $invoice->uid
        ]);
    }
}
