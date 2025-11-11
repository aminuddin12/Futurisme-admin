<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    // …

    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            // Cek jika request menuju API (contoh: prefix api/ atau expectsJson)
            if ($request->is('api/*') || $request->expectsJson()) {
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Resource not found.'
                    ], 404);
                }
                if ($e instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Method not allowed.'
                    ], 405);
                }
                // Untuk error internal server
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Internal Server Error.'
                ], 500);
            }

            // Kalau bukan API, fallback ke parent
            return null;
        });
    }
}
