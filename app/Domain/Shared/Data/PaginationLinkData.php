<?php

namespace Domain\Shared\Data;

use Spatie\LaravelData\Data;

class PaginationLinkData extends Data
{
    public function __construct(
        readonly ?string $next,
        readonly ?string $prev,
        readonly string $first,
        readonly string $last,
    ) {
    }
}
