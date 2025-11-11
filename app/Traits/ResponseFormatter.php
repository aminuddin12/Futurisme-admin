<?php

namespace App\Traits;

use App\Exceptions\CustomResponseHandler;

trait ResponseFormatter
{
    protected function success($data = null, string $message = 'Success', int $code = 200)
    {
        return CustomResponseHandler::success($data, $message, $code);
    }

    protected function error(string $message = 'Error', int $code = 500, $data = null)
    {
        return CustomResponseHandler::error($message, $code, $data);
    }

    protected function respond(int $code, ?string $message = null, $data = null)
    {
        return CustomResponseHandler::respond($code, $message, $data, request());
    }
}
