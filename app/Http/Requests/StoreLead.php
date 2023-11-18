<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLead extends FormRequest {
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
            'business_email' => 'email|required',
            'business_phone' => 'string|required',
            'title' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|min:8|required',
            'designation' => 'string|required',
            'status' => 'string|required',
            'url' => 'url|required',
            'partner_id' => 'integer|required',
            'country' => 'string|required',
            'address' => 'string|required',
            'phone' => 'string|required',
            'joined_date' => 'date|required',
            'followup_date' => 'date|required',
        ];
    }

    protected function withValidator($validator) {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'createLead');
        }
    }
}
