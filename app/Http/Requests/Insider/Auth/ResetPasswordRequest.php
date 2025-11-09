<?php

namespace App\Http\Requests\Insider\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'token' => 'required|string',
            'credential' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ];
    }
}
