<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {

                // Pakai handler custom kita
                if ($e instanceof NotFoundHttpException) {
                    return CustomResponseHandler::respond(
                        404,
                        'Resource not found.',
                        null,
                        $request
                    );
                }

                if ($e instanceof MethodNotAllowedHttpException) {
                    return CustomResponseHandler::respond(
                        405,
                        'Method not allowed.',
                        null,
                        $request
                    );
                }

                // Ambil kode dari HttpException kalau ada
                $code = $e instanceof HttpExceptionInterface
                    ? $e->getStatusCode()
                    : 500;

                $message = $e->getMessage() ?: (Response::$statusTexts[$code] ?? 'Internal Server Error');

                return CustomResponseHandler::respond($code, $message, null, $request);
            }

            // Non-API → fallback ke tampilan default Laravel
            return null;
        });
    }
}
