<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\BusinessUnitRepository;
use SgcAdmin\Models\BusinessUnit;
use SgcAdmin\Validators\BusinessUnitValidator;

/**
 * Class BusinessUnitRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class BusinessUnitRepositoryEloquent extends BaseRepository implements BusinessUnitRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessUnit::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
