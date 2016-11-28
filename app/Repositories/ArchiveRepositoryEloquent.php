<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\ArchiveRepository;
use SgcAdmin\Models\Archive;
use SgcAdmin\Validators\ArchiveValidator;

/**
 * Class ArchiveRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class ArchiveRepositoryEloquent extends BaseRepository implements ArchiveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Archive::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
