<?php

namespace App\Http\Requests\Application\Settings\Notification;

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
            'notification_invoice_sent' => 'required|boolean',
            'notification_invoice_viewed' => 'required|boolean',
            'notification_invoice_paid' => 'required|boolean',
            'notification_estimate_sent' => 'required|boolean',
            'notification_estimate_viewed' => 'required|boolean',
            'notification_estimate_approved_or_rejected' => 'required|boolean',
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