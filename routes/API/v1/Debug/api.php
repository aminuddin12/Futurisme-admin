<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Debug\v1\DebugController;


// Saya ingin Menambahkan Gerbang sebelum mengakses Debug untuk Pengakses mendapatkan Token terlebih dahulu sebelum Membuka Rute API
Route::get('/', [DebugController::class, 'index']);
