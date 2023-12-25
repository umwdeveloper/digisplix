<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoice extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'invoice_id' => 'string|required',
            'client_id' => 'integer|required',
            'category_id' => 'integer|required',
            'invoice_from' => 'string|required',
            'invoice_to' => 'string|required',
            'status' => 'string|nullable',
            'due_date' => 'date|required',
            'terms_n_conditions' => 'nullable|string',
            'note' => 'nullable|string',
            'recurring' => 'nullable',
            'start_from' => 'required_if:recurring,1|date|nullable',
            'duration' => 'required_if:recurring,1|integer|nullable',
            'account_holder_name' => 'string|required',
            'bank_name' => 'string|required',
            'ifsc_code' => 'string|required',
            'account_number' => 'string|required',
            'descriptions.*' => 'string|required',
            'prices.*' => 'numeric|required',
            'quantities.*' => 'integer|required'
        ];
    }

    public function messages() {
        return [
            'descriptions.*.required' => 'Description is required',
            'prices.*.required' => 'Price is required',
            'quantities.*.required' => 'Quantity is required',
        ];
    }
}
