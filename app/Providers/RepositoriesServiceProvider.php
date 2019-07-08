<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Contracts\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Contracts\CompanyRepositoryInterface', 'App\Repositories\CompanyRepository');
        $this->app->bind('App\Contracts\DocumentRepositoryInterface', 'App\Repositories\DocumentRepository');
    }
}