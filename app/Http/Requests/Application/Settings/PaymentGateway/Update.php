<?php

namespace App\Http\Requests\Application\Settings\PaymentGateway;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */ 
    public function rules()
    {
        if ($this->route('gateway') == 'stripe') {
            return [
                'stripe_public_key' => 'required|string',
                'stripe_secret_key' => 'required|string',
                'stripe_test_mode' => 'required|boolean',
                'stripe_active' => 'required|boolean',
            ];
        } else if ($this->route('gateway') == 'paypal') {
            return [
                'paypal_username' => 'required|string',
                'paypal_password' => 'required|string',
                'paypal_signature' => 'required|string',
                'paypal_test_mode' => 'required|boolean',
                'paypal_active' => 'required|boolean',
            ];
        } else if ($this->route('gateway') == 'razorpay') {
            return [
                'razorpay_id' => 'required|string',
                'razorpay_secret_key' => 'required|string',
                'razorpay_test_mode' => 'required|boolean',
                'razorpay_active' => 'required|boolean',
            ];
        }
    }
}