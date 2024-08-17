<?php

namespace Domain\User\Data;

use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use Domain\User\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UserData extends Data
{
    public function __construct(
        readonly string $full_name,
        readonly string $gender,
        readonly string $language,
        readonly string|Optional $password,
        readonly string|Optional $email,
        readonly ?string $profile_picture,
        readonly ?string $phone_number,
        readonly ?string $birth_date,
    ) {
    }
    public static function rules(ValidationContext $context): array
    {
        return [
            'full_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/'],
            'gender' => ['required'],
            'language' => ['required', 'in:id,en'],
            'birth_date' => ['date'],
        ];
    }

    public function availableEmailValidation(): self
    {
        $existingAdmin = User::onlyTrashed()
            ->where('email', $this->email)
            ->where('role', 'admin')
            ->first();

        if ($existingAdmin) {
            throw new APIResponseException([
                'Email already exists in deleted records for an admin account!',
                'You can either delete the data from the trash and add new data, or directly recover the existing data.'
            ], APIStatusEnum::CONFLICT);
        }

        $existingMember = User::onlyTrashed()
            ->where('email', $this->email)
            ->where('role', 'member')
            ->first();

        if ($existingMember) {
            throw new APIResponseException([
                'Email already exists in deleted records for a member account!',
                'You can either delete the data from the trash and add new data, or directly recover the existing data.'
            ], APIStatusEnum::CONFLICT);
        }

        $activeUser = User::where('email', $this->email)->first();

        if ($activeUser) {
            throw new APIResponseException([
                'Email already in use by an active account!',
                'Please use a different email address or contact support for assistance.'
            ]);
        }

        return $this;
    }

}
