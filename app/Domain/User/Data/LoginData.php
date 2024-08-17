<?php

namespace Domain\User\Data;

use App\Infrastructure\Exceptions\APIResponseException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        readonly string $email,
        readonly string $password,
        readonly ?bool $remember_me
    ) {
    }

    public function validateUser(string $role): User
    {
        $user = User::where("role", $role)
            ->where("email", $this->email)
            ->first();

        if (!$user)
            throw new APIResponseException(["Email or password does not match!"]);

        if (!Hash::check($this->password, $user->password))
            throw new APIResponseException(["Email or password does not match!"]);

        return $user;
    }
}
