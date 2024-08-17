<?php

namespace Domain\User\Data;

use Domain\Shared\Transformers\UpperCaseTransformer;
use Domain\User\Models\Admin;
use Domain\User\Models\JobTitle;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AdminData extends Data
{
    public function __construct(
        readonly ?int $id,
        readonly string $full_name,
        readonly string|Optional $email,
        readonly string $gender,
        #[WithTransformer(UpperCaseTransformer::class)]
        readonly string $job_title,
        readonly string|Optional $job_title_id,
        readonly ?string $language,
        readonly ?string $profile_picture,
        readonly ?string $phone_number,
        readonly ?string $address,
        readonly ?string $birth_date,
        readonly ?string $created_at,
        readonly string|Optional $last_active_at,
    ) {
    }

    /**
     * Summary of fromAuth
     * @return \Domain\User\Data\AdminData
     */
    public static function fromAuth(): self
    {
        return self::from([
            "id" => Auth::user()->id,
            "full_name" => Auth::user()->full_name,
            "email" => Auth::user()->email,
            "gender" => Auth::user()->gender,
            "job_title" => JobTitle::findOrFail(
                Admin::where('user_id', Auth::user()->id)
                    ->pluck('job_title_id')
                    ->first()
            )->name,
            "language" => Auth::user()->language,
            "profile_picture" => Auth::user()->profile_picture,
            "phone_number" => Auth::user()->phone_number,
            "address" => Admin::where('user_id', Auth::user()->id)
                ->pluck('address')
                ->first(),
            "birth_date" => Auth::user()->birth_date,
            "created_at" => Auth::user()->created_at,
        ]);
    }
    public function toArrayUpdate(): array
    {
        return [
            "full_name" => $this->full_name,
            "gender" => $this->gender,
            "job_title_id" => JobTitle::where("name", $this->job_title)
                ->pluck("id")
                ->firstOrFail(),
            "language" => $this->language,
            "profile_picture" => $this->profile_picture,
            "phone_number" => $this->phone_number,
            "address" => $this->phone_number,
            "birth_date" => $this->birth_date,
        ];
    }
}
