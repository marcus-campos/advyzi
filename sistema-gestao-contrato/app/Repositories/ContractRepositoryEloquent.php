<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Models\Contract;
use SgcAdmin\Validators\ContractValidator;

/**
 * Class ContractRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class ContractRepositoryEloquent extends BaseRepository implements ContractRepository
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
