<?php

namespace App\Http\Requests\Insider\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'credential' => 'required|string', // username or email
            'password' => 'required|string',
        ];
    }
}
