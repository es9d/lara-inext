<?php

namespace App\Http\Requests\Application\Customer;

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
        return [
            'display_name' => 'required|string|max:190',
            'contact_name' => 'required|string|max:190',
            // Email is unique to customers table except current model
            'email' => 'required|string|email|max:190|unique:customers,email,' . $this->route('customer'),
            'phone' => 'nullable|string|max:190',
            'website' => 'nullable|string|max:190',
            'currency_id' => 'required|integer',

            'billing.name' => 'required|string|max:190',
            'billing.phone' => 'nullable|string|max:190',
            'billing.country_id' => 'required|integer',
            'billing.state' => 'nullable|string|max:190',
            'billing.city' => 'nullable|string|max:190',
            'billing.zip' => 'nullable|string|max:190',
            'billing.address_1' => 'required|string|max:500',

            'shipping.name' => 'nullable|string|max:190',
            'shipping.phone' => 'nullable|string|max:190',
            'shipping.country_id' => 'nullable|integer',
            'shipping.state' => 'nullable|string|max:190',
            'shipping.city' => 'nullable|string|max:190',
            'shipping.zip' => 'nullable|string|max:190',
            'shipping.address_1' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => __('messages.customer_exists'),
        ];
    }
}