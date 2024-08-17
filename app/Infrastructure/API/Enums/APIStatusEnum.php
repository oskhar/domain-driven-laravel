<?php

namespace App\Infrastructure\API\Enums;

enum APIStatusEnum: int
{
    case SUCCESS = 200;
    case CREATED = 201;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case CONFLICT = 409;
    case UNPROCESSABLE_ENTITY = 422;
    case INTERNAL_SERVER_ERROR = 500;

    public function getMessage(): string
    {
        return match ($this) {
            self::SUCCESS => "Success! Your request has safely landed back to Earth.",
            self::CREATED => "New entity launched into the cosmos.",
            self::BAD_REQUEST => "Your request veered off course and couldn't escape Earth's gravity!",
            self::UNAUTHORIZED => "Your credentials don't pass the cosmic gatekeeper!",
            self::FORBIDDEN => "Your request violates the Sacred Timeline and cannot be fulfilled!",
            self::NOT_FOUND => "The data you're seeking is beyond the bounds of space!",
            self::CONFLICT => "Collision in the cosmic pathways! Your request encountered a space-time conflict.",
            self::UNPROCESSABLE_ENTITY => "Data anomaly detected. Unable to process your request in this dimension!",
            self::INTERNAL_SERVER_ERROR => "Galactic disruption. An unexpected cosmic event occurred!",
        };
    }
}
