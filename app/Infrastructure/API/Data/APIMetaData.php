<?php

namespace App\Infrastructure\API\Data;

use Spatie\LaravelData\Data;

class APIMetaData extends Data
{
    public function __construct(
        readonly string $request_id,
        readonly string $response_size,
    ) {
    }
}
