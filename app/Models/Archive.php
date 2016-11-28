<?php

namespace SgcAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Archive extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'path',
        'contract_id',
        'directory'
    ];

}
