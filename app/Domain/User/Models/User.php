<?php

namespace Domain\User\Models;

use Domain\Shared\Casts\DateCast;
use Domain\Shared\Models\BaseModel;
use Domain\User\Casts\GenderCast;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends BaseModel
{
    use SoftDeletes, HasApiTokens, Notifiable;

    /**
     * Costuming cast atribute
     * @var array
     */
    protected $casts = [
        'gender' => GenderCast::class,
    ];

    /**
     * Summary of hidden
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'gender',
        'language',
        'profile_picture',
        'phone_number',
        'birth_date',
    ];
}
