<?php

use Illuminate\Support\Facades\Route;

// Vendor panel routes
Route::prefix('vendor')
    ->name('vendor.')
    ->middleware('auth:vendor')   // guard ‘vendor’ harus ditetapkan di config/auth.php
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('profile', \App\Http\Controllers\Vendor\ProfileController::class);

        // contoh route lainnya
        Route::get('orders', [\App\Http\Controllers\Vendor\OrderController::class, 'index'])
            ->name('orders.index');
        Route::get('orders/{order}', [\App\Http\Controllers\Vendor\OrderController::class, 'show'])
            ->name('orders.show');
    });
