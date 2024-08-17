<?php

namespace Domain\User\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ResetPasswordData extends Data
{
    public function __construct(
        readonly string $old_password,
        readonly string $new_password,
        readonly string $new_password_confirmation,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            "old_password" => [
                'required',
            ],
            "new_password" => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ];
    }

    public static function messages(...$args): array
    {
        return [
            'new_password.regex' => 'The password must contain at least one uppercase letter and a number',
        ];
    }
}
