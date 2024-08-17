<?php

namespace Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Lunarstorm\LaravelDDD\Factories\HasDomainFactory;

abstract class BaseModel extends Model
{
    use HasDomainFactory;

    protected $guarded = [];
}
