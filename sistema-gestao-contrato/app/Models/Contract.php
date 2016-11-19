<?php

namespace SgcAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contract extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'which_hired',
        'description',
        'start_date',
        'end_date',
        'customer_contracts_id'
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerContracts::class);
    }
}
