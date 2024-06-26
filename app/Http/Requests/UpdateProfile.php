<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Partner;
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
        $rules = [
            'name' => 'string|min:3|required',
            'email' => 'email|required',
            'designation' => 'string|required',
            'country' => 'string|required',
            'country_code' => 'string|required',
            'address' => 'string|nullable',
            'phone' => 'string|required',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024'
        ];

        if ($this->user() && $this->user()->userable_type === Partner::class) {
            $rules['facebook'] = 'nullable|url';
            $rules['instagram'] = 'nullable|url';
            $rules['linkedin'] = 'nullable|url';
        }

        if ($this->user() && $this->user()->userable_type === Client::class) {
            $rules['url'] = 'url|nullable';
            $rules['business_name'] = 'string|required';
            $rules['business_phone'] = 'string|nullable';
        }

        return $rules;
    }
}
