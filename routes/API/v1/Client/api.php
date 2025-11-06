<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Client\v1\Auth\LoginController;
use App\Http\Controllers\API\Client\v1\Auth\RegisterController;
use App\Http\Controllers\API\Client\v1\Auth\EmailVerificationController;
use App\Http\Controllers\API\Client\v1\Auth\WhatsappVerificationController;
use Illuminate\Http\Request;

// Rute Publik (Autentikasi)
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Rute Verifikasi (Whatsapp)
Route::prefix('verify/whatsapp')->group(function () {
    Route::post('/send-otp', [WhatsappVerificationController::class, 'sendOtp']);
    Route::post('/verify-otp', [WhatsappVerificationController::class, 'verifyOtp']);
});

// Rute yang Membutuhkan Autentikasi (Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout']);

    // Get User Profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rute Verifikasi (Email)
    Route::prefix('verify/email')->group(function () {
        Route::post('/send', [EmailVerificationController::class, 'sendVerificationEmail'])->name('verification.send.api');
        // Rute 'verify' (GET) biasanya ditangani oleh web.php bawaan Laravel
        // Route::get('/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify.api');
    });

});
