<?php

namespace SgcAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //User

        $this->app->bind(
            'SgcAdmin\Repositories\UserRepository',
            'SgcAdmin\Repositories\UserRepositoryEloquent'
        );
    }
}
