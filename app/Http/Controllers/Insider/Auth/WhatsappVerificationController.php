<?php

namespace App\Http\Controllers\Insider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class WhatsappVerificationController extends Controller
{
    /**
     * Menampilkan halaman untuk memasukkan kode verifikasi WA.
     */
    public function create(Request $request): Response
    {
        // Anda mungkin perlu mengirim kode OTP WA di sini sebelum menampilkan halaman
        // $insider = $request->user('insider');
        // $insider->sendWhatsappVerificationCode(); // Contoh metode

        return Inertia::render('Auth/VerifyWhatsapp', [
            'status' => session('status')
        ]);
    }

    /**
     * Memvalidasi dan menyimpan kode verifikasi WA.
     */
    public function store(Request $request): RedirectResponse
    {
        $insider = $request->user('insider');

        $request->validate([
            'verification_code' => ['required', 'string', 'digits:6'], // Sesuaikan validasi
        ]);

        // Logika untuk memvalidasi kode
        // if ($insider->whatsapp_verification_code !== $request->verification_code) {
        //     return back()->withErrors(['verification_code' => 'Kode verifikasi tidak valid.']);
        // }

        // Tandai WA sebagai terverifikasi
        // $insider->markWhatsappAsVerified(); // Contoh metode

        return redirect()->intended(RouteServiceProvider::HOME)->with('status', 'whatsapp-verified');
    }
}
