<?php

namespace App\Http\Controllers\API\App\v1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    /**
     * Menampilkan pesan sukses. untuk Test Sementara
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'selamat kamu dapat mengakses kode ini'
        ]);
    }
}
