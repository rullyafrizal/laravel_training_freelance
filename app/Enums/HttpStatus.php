<?php

namespace App\Enums;

class HttpStatus {
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    CONST NOT_ACCEPTABLE = 406;
    const UNPROCESSABLE_ENTITY = 422;
}
