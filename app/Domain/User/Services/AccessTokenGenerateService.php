<?php

namespace Domain\User\Services;

use Carbon\Carbon;
use Domain\User\Data\AccessTokenData;
use Domain\User\Models\User;

class AccessTokenGenerateService
{
    /**
     * Service main program.
     *
     * @return mixed
     */
    public function __invoke(User $user, bool $remember_me = false): AccessTokenData
    {
        return AccessTokenData::from([
            "access_token" => $user->createToken(
                'personal_access_tokens',
                ['*'],
                $expiresAt = Carbon::now()->addMinutes(
                    config("sanctum." . ($remember_me ? "long_lived_expiration" : "short_lived_expiration"))
                )
            )->plainTextToken,
            "expires_at" => $expiresAt,
        ]);
    }
}
