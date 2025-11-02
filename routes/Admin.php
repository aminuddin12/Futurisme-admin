<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Inertia\Inertia;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', fn () => Inertia::render('Profile/AccountProfile'))->name('profile');
// Route untuk halaman Web Settings baru
Route::get('/settings', fn () => Inertia::render('Admin/WebSettings'))->name('settings');

// Route untuk halaman Chat
Route::get('/chat', fn () => Inertia::render('Chat/Chat'))->name('chat');
