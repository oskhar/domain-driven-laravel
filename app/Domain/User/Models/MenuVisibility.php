<?php

namespace Domain\User\Models;

use Domain\Shared\Models\BaseModel;

class MenuVisibility extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_visibilities';

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_title_id',
        'menu_id',
    ];
}
