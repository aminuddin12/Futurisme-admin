<?php
// Lokasi file ini ada di /routes/API/v1/Client/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Client\v1\Auth\LoginController;
use App\Http\Controllers\API\Client\v1\Auth\RegisterController;
use App\Http\Controllers\API\Client\v1\Auth\EmailVerificationController;
use App\Http\Controllers\API\Client\v1\Auth\WhatsappVerificationController;
use Illuminate\Http\Request;


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::prefix('verify/whatsapp')->group(function () {
    Route::post('/send-otp', [WhatsappVerificationController::class, 'sendOtp']);
    Route::post('/verify-otp', [WhatsappVerificationController::class, 'verifyOtp']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('verify/email')->group(function () {
        Route::post('/send', [EmailVerificationController::class, 'sendVerificationEmail'])->name('verification.send.api');
        // Rute 'verify' (GET) biasanya ditangani oleh web.php bawaan Laravel
        // Route::get('/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify.api');
    });

});
