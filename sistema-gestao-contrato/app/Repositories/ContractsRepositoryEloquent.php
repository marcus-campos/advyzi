<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Models\Contract;
use SgcAdmin\Repositories\ContractsRepository;
use SgcAdmin\Validators\ContractsValidator;

/**
 * Class ContractsRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class ContractsRepositoryEloquent extends BaseRepository implements ContractsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contract::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
