<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\VerificationController;

Route::prefix('vendor/email')
    ->name('vendor.auth.verify.')
    ->group(function () {
        Route::get('verify', [VerificationController::class, 'show'])
            ->middleware('auth:vendor')
            ->name('notice');

        Route::get('verify/{id}/{hash}', [VerificationController::class, 'verify'])
            ->middleware(['auth:vendor','signed'])
            ->name('verify');

        Route::post('email/resend', [VerificationController::class, 'resend'])
            ->middleware(['auth:vendor','throttle:6,1'])
            ->name('resend');
    });
