<?php

use App\Enums\HttpStatus;
use Illuminate\Http\JsonResponse;

if (!function_exists('sendResponse'))
{
    function sendResponse(int $status = HttpStatus::OK, string $message = '', mixed $body = []): JsonResponse
    {
        return response()
            ->json([
                'status' => $status,
                'message' => $message,
                'body' => $body
            ], $status);
    }
}
