<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProject extends FormRequest {
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
            'name' => 'string|required|min:3',
            'description' => 'string|required|min:10',
            'deadline' => 'date|required',
            'progress' => 'string|required',
            'billing_status' => 'string',
            'current_status' => 'string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024',
        ];
    }

    protected function withValidator($validator) {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'updateProject');
        }
    }
}
