<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use app\Http\Controllers\Web\IndexController;

Route::get('/maintenance', function () {
    return inertia('Maintenance');
})->name('maintenance');

// Grup rute untuk tamu.
Route::middleware(['check.maintenance'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
});
