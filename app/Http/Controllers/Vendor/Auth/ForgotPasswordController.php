<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\ResetVendorPasswordRequest;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return Inertia::render('Vendor/Auth/Password/Forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => ['required','email','exists:vendors,email']]);
        $status = Password::broker('vendors')->sendResetLink(
            $request->only('email')
        );
        return back()->with(['status' => __($status)]);
    }

    public function showResetForm($token)
    {
        return Inertia::render('Vendor/Auth/Password/Reset', [
            'token' => $token,
        ]);
    }

    public function reset(ResetVendorPasswordRequest $request)
    {
        $status = Password::broker('vendors')->reset(
            $request->only('email','password','password_confirmation','token'),
            function ($vendor, $password) {
                $vendor->passwds()->create([
                    'vIdentification' => $vendor->vIdentification,
                    'password'        => Hash::make($password),
                    'status'          => 'newPass',
                ]);
                $vendor->save();
                Auth::guard('vendor')->login($vendor);
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('vendor.dashboard')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
