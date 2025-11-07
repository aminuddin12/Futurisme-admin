<?php

namespace App\Http\Controllers\API\Debug\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class DebugController extends Controller
{
    /**
     * Menampilkan informasi debug dasar.
     * dan sebagai pusat pengetesan API
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'debug',
            'environment' => App::environment(),
            'app_name' => config('app.name'),
            'maintenance_mode' => App::isDownForMaintenance(),
            'timestamp' => now()
        ]);
    }
}
