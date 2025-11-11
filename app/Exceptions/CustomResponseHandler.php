<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomResponseHandler
{
    /**
     * Generate standardized JSON or HTML response for all HTTP status codes.
     */
    public static function respond(int $code, ?string $message = null, $data = null, ?Request $request = null)
    {
        $statusTexts = Response::$statusTexts;

        // Ambil teks bawaan HTTP jika pesan tidak diberikan
        $message = $message ?? ($statusTexts[$code] ?? 'Unknown Status');

        // Jika request adalah API (expects JSON)
        if ($request && $request->expectsJson()) {
            return response()->json([
                'status'  => $code,
                'success' => $code >= 200 && $code < 300,
                'message' => $message,
                'data'    => $data,
            ], $code);
        }

        // Jika bukan API, render view error
        $viewPath = "errors.$code";
        if (view()->exists($viewPath)) {
            return response()->view($viewPath, [
                'code' => $code,
                'message' => $message,
            ], $code);
        }

        // Fallback generic
        return response()->make("<h1>$code - $message</h1>", $code);
    }

    /**
     * Helper untuk respon sukses.
     */
    public static function success($data = null, string $message = 'OK', int $code = 200)
    {
        return response()->json([
            'status' => $code,
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Helper untuk respon error.
     */
    public static function error(string $message = 'Error', int $code = 500, $data = null)
    {
        return response()->json([
            'status' => $code,
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
