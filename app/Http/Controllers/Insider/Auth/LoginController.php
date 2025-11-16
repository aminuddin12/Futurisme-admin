<?php

namespace App\Http\Controllers\Insider\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Insider\Auth\LoginRequest; // Diperbarui
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Menampilkan tampilan login.
     */
    public function create(): Response
    {
        // Asumsi halaman login Anda ada di 'Insider/Auth/Login'
        // Sesuaikan path ini jika nama komponen React Anda berbeda
        return Inertia::render('Insider/Auth/Login', [
            'canResetPassword' => Route::has('insider.password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Menangani permintaan login yang masuk.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Logika dipindahkan ke LoginRequest

        $request->session()->regenerate();

        // Mengarahkan ke dashboard Insider, atau default ke RouteServiceProvider::HOME
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Menghancurkan sesi autentikasi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Pastikan menggunakan guard 'insider'
        Auth::guard('insider')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Arahkan ke halaman utama setelah logout
    }
}
