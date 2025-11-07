<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Web\v1\Controller;

Route::get('/', [Controller::class, 'index']);
// Tambahkan rute web API lainnya di sini dan saya ingin nantinya menambahkan config terlebih dahulu

