<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name'   => ['required','string','max:255','unique:vendors,company_name'],
            'email'          => ['required','email','max:255','unique:vendors,email'],
            'contact_person' => ['nullable','string','max:255'],
            'phone_region'   => ['nullable','string','max:10'],
            'phone_number'   => ['nullable','string','max:25','unique:vendors,phone_number'],
            'website'        => ['nullable','url','max:255'],
            'address'        => ['nullable','string'],
            'password'       => ['required','string','min:8','confirmed'],
        ];
    }
}
