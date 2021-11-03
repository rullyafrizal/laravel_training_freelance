<?php

use App\Enums\HttpStatus;

if (!function_exists('working_hours'))
{
    /**
     * @param int $status
     * @param string $message
     * @param mixed|array $body
     * @return \Illuminate\Http\JsonResponse
     */
    function sendResponse(int $status = HttpStatus::OK, string $message = '', mixed $body = []): \Illuminate\Http\JsonResponse
    {
        return response()
            ->json([
                'status' => $status,
                'message' => $message,
                'body' => $body
            ], $status);
    }
}
