<?php

namespace App\Http\Requests\Insider\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:50|unique:insiders,username',
            'email' => 'required|email|max:191|unique:insiders,email',
            'password' => 'required|string|min:8|confirmed',
            // profile fields optional
            // 'id_code' => 'nullable|string|max:50',
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'identity_number' => 'nullable|string|max:100',
            'identity_type' => 'nullable|string|max:50',
            'phone_region' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:25',
            //'whatsapp_verified_status' => 'nullable|boolean',
        ];
    }
}
