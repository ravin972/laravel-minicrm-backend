<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255|unique:clients,contact_email,' . $this->route('client')->id,
            'contact_phone_number' => 'required|string|max:20|unique:clients,contact_phone_number,' . $this->route('client')->id,
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_city' => 'required|string|max:255',
            'company_zip' => 'required|string|max:20',
            'company_gst' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'contact_name.required' => 'The contact name field is required.',
            'contact_email.required' => 'The contact email field is required.',
            'contact_email.email' => 'Please provide a valid email address.',
            'contact_email.unique' => 'This email address is already registered.',
            'contact_phone_number.required' => 'The contact phone number field is required.',
            'contact_phone_number.unique' => 'This phone number is already registered.',
            'company_name.required' => 'The company name field is required.',
            'company_address.required' => 'The company address field is required.',
            'company_city.required' => 'The company city field is required.',
            'company_zip.required' => 'The company zip code field is required.',
        ];
    }
}
