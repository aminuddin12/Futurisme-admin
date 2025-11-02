<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('landing');
Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard', [
        'pageTitle' => 'Dashboard', // <-- Kirim judul sebagai prop
    ]);
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Route Chat
Route::get('/admin/chat', function () {
    return Inertia::render('Chat/Chat', [
        'pageTitle' => 'Messages', // <-- Kirim judul sebagai prop
    ]);
})->name('admin.chat');

// -- TAMBAHKAN ROUTE PROFIL --
// Bisa langsung render view atau lewat controller
Route::get('/admin/profile', function () {
    return Inertia::render('Profile/AccountProfile', [
        'pageTitle' => 'Profile Settings', // Kirim judul
        // Kirim data lain jika perlu (misal: history)
    ]);
})->name('admin.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
