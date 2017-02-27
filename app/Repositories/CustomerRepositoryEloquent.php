<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\CustomerRepository;
use SgcAdmin\Models\Customer;
//use SgcAdmin\Validators\CustomerContractsValidator;

/**
 * Class CustomerContractsRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
