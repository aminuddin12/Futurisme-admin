<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\LoginVendorRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return Inertia::render('Vendor/Auth/Login');
    }

    public function login(LoginVendorRequest $request)
    {
        $credentials = $request->only('email','password');
        if (Auth::guard('vendor')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('vendor.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('vendor.auth.login.form');
    }
}
