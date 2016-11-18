<?php

namespace SgcAdmin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CustomerContracts extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'email',
        'address',
        'region',
        'city',
        'nif',
        'operator_id',
        'user_id'
    ];

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
