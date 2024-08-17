<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Data;

class ResponseMetaData extends Data
{
    public function __construct(
        readonly string $request_id,
        readonly string $response_size
    ) {
    }
}
