<?php

namespace App\Services;

use App\Enums\HttpStatus;

class ApiHttpResponseService {
    public function sendResponse(int $status = HttpStatus::OK, string $message = '', mixed $body = [])
    {
        return response()
            ->json([
                'status' => $status,
                'message' => $message,
                'body' => $body
            ], $status);
    }
}
