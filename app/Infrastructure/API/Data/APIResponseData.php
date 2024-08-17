<?php

namespace App\Infrastructure\API\Data;

use Domain\Shared\Data\PaginationData;
use Spatie\LaravelData\Data;

class APIResponseData extends Data
{
    public function __construct(
        readonly mixed $data = null,
        readonly ?string $message,
        /** @var array<string> */
        readonly ?array $errors,
        readonly ?PaginationData $pagination,
        readonly ?APIMetaData $meta,
        readonly ?bool $status = true,
    ) {
    }
}
