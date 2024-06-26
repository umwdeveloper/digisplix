<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartner extends FormRequest {
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
            'email' => 'email|required',
            'password' => 'string|min:8|required',
            'designation' => 'string|required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'country' => 'string|required',
            'country_code' => 'string|required',
            'address' => 'string|nullable',
            'phone' => 'string|required',
            'commission' => 'string|required',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024'
        ];
    }

    protected function withValidator($validator) {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'createPartner');
        }
    }
}
