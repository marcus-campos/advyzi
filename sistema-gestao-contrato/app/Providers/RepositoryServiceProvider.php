<?php

namespace SgcAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {

        //Contracts

        $this->app->bind(
            'SgcAdmin\Repositories\ContractsRepository',
            'SgcAdmin\Repositories\ContractsRepositoryEloquent'
        );

        //CustomerContracts

        $this->app->bind(
            'SgcAdmin\Repositories\CustomerContractsRepository',
            'SgcAdmin\Repositories\CustomerContractsRepositoryEloquent'
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
