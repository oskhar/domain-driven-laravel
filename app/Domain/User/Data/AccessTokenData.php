<?php

namespace Domain\User\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class AccessTokenData extends Data
{
    public function __construct(
        readonly ?string $access_token,
        readonly ?Carbon $expires_at,
    ) {
    }
}
