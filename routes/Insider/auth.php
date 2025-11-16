<?php

use App\Http\Controllers\Insider\Auth\EmailVerificationController;
use App\Http\Controllers\Insider\Auth\ForgotPasswdController;
use App\Http\Controllers\Insider\Auth\LoginController;
use App\Http\Controllers\Insider\Auth\RegisterController;
use App\Http\Controllers\Insider\Auth\WhatsappVerificationController;
use Illuminate\Support\Facades\Route;

// Rute untuk Insider (Admin)
// Semua rute di sini akan otomatis memiliki prefix 'insider'
// dan nama rute 'insider.' jika Anda mendaftarkannya dengan benar di RouteServiceProvider

Route::middleware('guest:insider')->group(function () {
    // Rute Registrasi
    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'store'])->name('register.post');

    // Rute Login
    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store'])->name('login.store');

    // Rute Lupa Password
    Route::get('forgot-password', [ForgotPasswdController::class, 'createRequestForm'])
        ->name('password.request');

    Route::post('forgot-password', [ForgotPasswdController::class, 'sendResetLink'])
        ->name('password.email');

    // Rute Reset Password
    Route::get('reset-password/{token}', [ForgotPasswdController::class, 'createResetForm'])
        ->name('password.reset');

    Route::post('reset-password', [ForgotPasswdController::class, 'storeNewPassword'])
        ->name('password.store');
});

Route::middleware('auth:insider')->group(function () {
    // Rute Verifikasi Email
    Route::get('verify-email', [EmailVerificationController::class, 'prompt'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Rute Verifikasi Whatsapp (Contoh Kerangka)
    Route::get('verify-whatsapp', [WhatsappVerificationController::class, 'create'])
        ->name('verification.whatsapp.notice');

    Route::post('verify-whatsapp', [WhatsappVerificationController::class, 'store'])
        ->name('verification.whatsapp.store');

    // Rute Logout
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
