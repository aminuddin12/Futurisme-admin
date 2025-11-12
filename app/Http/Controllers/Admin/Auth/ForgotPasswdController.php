<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Insider\Auth\ForgotPasswordRequest; // Request Forgot
use App\Http\Requests\Insider\Auth\ResetPasswordRequest; // Request Reset
use App\Models\Insider\Insider; // Model Insider
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswdController extends Controller
{
    /**
     * Menampilkan tampilan form lupa password.
     */
    public function createRequestForm(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Menangani permintaan kirim link reset password.
     */
    public function sendResetLink(ForgotPasswordRequest $request): RedirectResponse
    {
        // Validasi ditangani oleh ForgotPasswordRequest
        $data = $request->validated();

        // Menggunakan broker 'insiders'
        $status = Password::broker('insiders')->sendResetLink(
            ['email' => $data['email']]
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Menampilkan tampilan form reset password.
     */
    public function createResetForm(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Menangani penyimpanan password baru.
     */
    public function storeNewPassword(ResetPasswordRequest $request): RedirectResponse
    {
        // Validasi ditangani oleh ResetPasswordRequest
        $data = $request->validated();

        // Menggunakan broker 'insiders'
        $status = Password::broker('insiders')->reset(
            $data,
            function (Insider $insider, string $password) {
                $insider->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($insider));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('insider.login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
