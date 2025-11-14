<?php

namespace App\Http\Controllers\Insider\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Insider\Insider; // Gunakan model Insider

class EmailVerificationController extends Controller
{
    /**
     * Menampilkan halaman pemberitahuan verifikasi email.
     */
    public function prompt(Request $request): RedirectResponse|Response
    {
        $insider = $request->user('insider'); // Pastikan mendapatkan user dari guard 'insider'

        if (!$insider) {
            return redirect()->route('insider.login');
        }

        return $insider->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    /**
     * Menandai email pengguna sebagai terverifikasi.
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        // EmailVerificationRequest secara otomatis akan mengambil user berdasarkan guard
        // Tapi kita perlu memastikan guard-nya benar
        if ($request->user('insider')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user('insider')->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($request->user('insider')));
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }

    /**
     * Mengirim ulang email verifikasi.
     */
    public function send(Request $request): RedirectResponse
    {
        $insider = $request->user('insider'); // Pastikan mendapatkan user dari guard 'insider'

        if (!$insider) {
            return redirect()->route('insider.login');
        }

        if ($insider->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $insider->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
