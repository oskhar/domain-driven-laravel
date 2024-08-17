<?php

namespace Domain\User\Data;

use Domain\User\Models\Member;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Data;

class MemberData extends Data
{
    public function __construct(
        readonly ?int $id,
        readonly string $full_name,
        readonly ?string $email,
        readonly string $gender,
        readonly string $poin,
        readonly ?string $language,
        public ?string $profile_picture,
        readonly ?string $phone_number,
        readonly ?string $birth_date,
        readonly ?string $created_at,
    ) {
    }

    public static function fromAuth(): self
    {
        return self::from([
            "id" => Auth::user()->id,
            "full_name" => Auth::user()->full_name,
            "email" => Auth::user()->email,
            "gender" => Auth::user()->gender,
            "poin" => Member::where('user_id', Auth::user()->id)
                ->pluck('poin')
                ->first(),
            "language" => Auth::user()->language,
            "profile_picture" => Auth::user()->profile_picture,
            "phone_number" => Auth::user()->phone_number,
            "birth_date" => Auth::user()->birth_date,
            "created_at" => Auth::user()->created_at,
        ]);
    }
}
