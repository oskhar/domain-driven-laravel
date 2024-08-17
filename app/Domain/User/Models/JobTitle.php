<?php

namespace Domain\User\Models;

use Domain\Shared\Models\BaseModel;

class JobTitle extends BaseModel
{
    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
