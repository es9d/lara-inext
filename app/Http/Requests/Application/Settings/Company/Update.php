<?php

namespace App\Http\Requests\Application\Settings\Company;

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
            'avatar' => 'mimes:jpeg,jpg,png,gif',
            'name' => 'required|string|max:190',
            'billing.phone' => 'nullable|string|max:190',
            'billing.country_id' => 'required|integer',
            'billing.state' => 'nullable|string|max:190',
            'billing.city' => 'nullable|string|max:190',
            'billing.zip' => 'nullable|string|max:190',
            'billing.address_1' => 'required|string|max:500',
        ];
    }
}