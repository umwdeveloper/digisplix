<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLead extends FormRequest {
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
            'name' => 'string|min:3|required',
            'business_name' => 'string|required',
            'business_phone' => 'string|nullable',
            'email' => 'email|required',
            'designation' => 'string|required',
            'status' => 'string|required',
            'url' => 'url|nullable',
            'partner_id' => 'integer|required',
            'country' => 'string|required',
            'country_code' => 'string|required',
            'address' => 'string|nullable',
            'phone' => 'string|required',
            'joined_date' => 'date|nullable',
            'followup_date' => 'date|nullable',
        ];
    }

    protected function withValidator($validator) {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'updateLead');
        }
    }
}
