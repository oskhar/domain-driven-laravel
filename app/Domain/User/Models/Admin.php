<?php

namespace Domain\User\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends BaseModel
{
    use SoftDeletes;

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_title_id',
        'address',
    ];

    public static function getDetailedData()
    {
        return self::select(
            'admins.id',
            'users.full_name',
            'users.email',
            'users.gender',
            'job_titles.name as job_title',
            'users.profile_picture',
            'users.phone_number',
            'admins.address',
            'users.birth_date',
            'users.created_at',
            \DB::raw('COALESCE((
                    SELECT last_used_at
                    FROM personal_access_tokens
                    WHERE personal_access_tokens.tokenable_id = users.id
                    ORDER BY last_used_at DESC
                    LIMIT 1
                ),
                "Never logged in"
            ) as last_active_at')
        )
            ->join('users', 'users.id', '=', 'admins.user_id')
            ->join('job_titles', 'job_titles.id', '=', 'admins.job_title_id');
    }
}
