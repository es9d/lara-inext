<?php

namespace App\Http\Requests\Application\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'email' => 'required|string|email|unique:vendors',
            'phone' => 'nullable|string|max:190',
            'website' => 'nullable|string|max:190',

            'billing.name' => 'required|string|max:190',
            'billing.phone' => 'nullable|string|max:190',
            'billing.country_id' => 'required|integer',
            'billing.state' => 'nullable|string|max:190',
            'billing.city' => 'nullable|string|max:190',
            'billing.zip' => 'nullable|string|max:190',
            'billing.address_1' => 'required|string|max:500',
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
            'email.unique' => __('messages.vendor_exists'),
        ];
    }
}