<?php

namespace App\Http\Requests\Application\Expense;

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
            'expense_category_id' => 'required|integer|exists:expense_categories,id',
            'amount' => 'required',
            'vendor_id' => 'sometimes|required|integer|exists:vendors,id',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ];
    }
}