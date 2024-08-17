<?php

namespace App\Infrastructure\API\Data;

use Domain\Shared\Transformers\StringArrayCast;
use Domain\Shared\Data\PaginationData;
use Domain\Shared\Data\ResponseMetaData;
use Domain\User\Data\AccessTokenData;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class APIMetaData extends Data
{
    public function __construct(
        readonly string $request_id,
        readonly string $response_size,
    ) {
    }
}
