<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\App\v1\Controller;

Route::get('/', [Controller::class, 'index']);
// Tambahkan rute mobile API lainnya di sini
