<?php

namespace SgcAdmin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SgcAdmin\Repositories\UserRepository;
use SgcAdmin\Models\User;
use SgcAdmin\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace SgcAdmin\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
