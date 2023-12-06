<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest {
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
            'designation' => 'string|required',
            'country' => 'string|required',
            'country_code' => 'string|required',
            'address' => 'string|required',
            'phone' => 'string|required',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024'
        ];
    }
}
