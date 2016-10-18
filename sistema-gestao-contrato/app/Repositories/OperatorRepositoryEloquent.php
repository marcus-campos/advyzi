<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\OperatorRepository;
use SgcAdmin\Models\Operator;
use SgcAdmin\Validators\OperatorValidator;

/**
 * Class OperatorRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class OperatorRepositoryEloquent extends BaseRepository implements OperatorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Operator::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
