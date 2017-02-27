<?php

namespace SgcAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {

        //Archives

        $this->app->bind(
            'SgcAdmin\Repositories\ArchiveRepository',
            'SgcAdmin\Repositories\ArchiveRepositoryEloquent'
        );

        //Contracts

        $this->app->bind(
            'SgcAdmin\Repositories\ContractRepository',
            'SgcAdmin\Repositories\ContractRepositoryEloquent'
        );

        //Customer

        $this->app->bind(
            'SgcAdmin\Repositories\CustomerRepository',
            'SgcAdmin\Repositories\CustomerRepositoryEloquent'
        );

        //Operator

        $this->app->bind(
            'SgcAdmin\Repositories\OperatorRepository',
            'SgcAdmin\Repositories\OperatorRepositoryEloquent'
        );

        //User

        $this->app->bind(
            'SgcAdmin\Repositories\UserRepository',
            'SgcAdmin\Repositories\UserRepositoryEloquent'
        );
    }
}
