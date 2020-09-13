<?php

namespace App\Http\Requests\Application\Settings\Payment;

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
            'payment_prefix' => 'required|string|max:190',
            'payment_color' => 'required|string|max:190',
            'payment_auto_archive' => 'required|boolean',
            'payment_footer' => 'nullable|string',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        foreach ($this->rules() as $key => $value) {
            // Set values of checked checkboxes from 'on' to true
            if ($this->$key == 'on') {
                $this->merge([
                    $key => 1,
                ]);
            }

            // Add unposted checkbox values as false
            if (!$this->has($key)) {
                $this->merge([
                    $key => 0,
                ]);
            }
        }
    }
}