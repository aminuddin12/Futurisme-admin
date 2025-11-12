<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Insider\Insider; // Menggunakan model Insider
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Insider\Auth\RegisterRequest; // Menggunakan Request Insider
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    /**
     * Menampilkan tampilan registrasi.
     */
    public function create(): Response
    {
        // Asumsi halaman register Anda ada di 'Admin/Auth/Register'
        // Sesuaikan path ini jika nama komponen React Anda berbeda
        return Inertia::render('Auth/Register');
    }

    /**
     * Menangani permintaan registrasi yang masuk.
     *
     * @throws ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        // Validasi sudah ditangani oleh RegisterRequest

        $insider = Insider::create([
            'username' => $request->username, // Sesuaikan dengan field di RegisterRequest
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($insider));

        // Login pengguna dengan guard 'insider'
        Auth::guard('insider')->login($insider);

        // Mengarahkan ke dashboard admin
        return redirect(RouteServiceProvider::HOME);
    }
}
