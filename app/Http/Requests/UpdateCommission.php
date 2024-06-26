<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommission extends FormRequest {
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
            'client_id' => 'string|required',
            'project_id' => 'string|required',
            'deal_date' => 'date|required',
            'deal_size' => 'numeric|required',
            'commission' => 'numeric|required',
            'status' => 'string|required',
            'type' => 'numeric|required'
        ];
    }

    protected function withValidator($validator) {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'updateCommission');
        }
    }
}
