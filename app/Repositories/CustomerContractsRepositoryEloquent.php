<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\CustomerContractsRepository;
use SgcAdmin\Models\CustomerContracts;
use SgcAdmin\Validators\CustomerContractsValidator;

/**
 * Class CustomerContractsRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class CustomerContractsRepositoryEloquent extends BaseRepository implements CustomerContractsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CustomerContracts::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
