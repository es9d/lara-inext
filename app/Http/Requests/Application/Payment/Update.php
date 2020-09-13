<?php

namespace App\Http\Requests\Application\Payment;

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
            'payment_number' => 'required|unique:payments,payment_number,' . $this->route('payment'),
            'payment_date' => 'required|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'invoice_id' => 'required|integer|exists:invoices,id',
            'payment_method_id' => 'required|integer',
            'amount' => 'required',
            'notes' => 'nullable|string',
            'private_notes' => 'nullable|string',
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
            'payment_number.unique' => __('messages.payment_exists'),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'payment_number' => $this->payment_prefix.'-'.sprintf('%06d', intval($this->payment_number)),
        ]);
    }
}