<?php

namespace Domain\User\Models;

use Domain\Shared\Models\BaseModel;

class Menu extends BaseModel
{
    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'route',
        'icon',
        'parent_id',
    ];
}
