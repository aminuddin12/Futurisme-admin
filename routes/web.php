<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Muat rute otentikasi (login, register, dll.)
require __DIR__.'/auth.php';

// Definisikan grup rute admin dengan middleware yang benar dan aman.
// Middleware 'web' sudah otomatis diterapkan pada file ini.
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    require __DIR__.'/Admin.php';
});
