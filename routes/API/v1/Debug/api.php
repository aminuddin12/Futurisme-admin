<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Debug\v1\DebugController;

Route::get('/', [DebugController::class, 'index']);
