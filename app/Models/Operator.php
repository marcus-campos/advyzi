<?php

namespace SgcAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Operator extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name'
    ];

    public function contracts()
    {
        return $this->hasMany(CustomerContracts::class);
    }
}
