<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models;
use App\Services;
use App\Repositories;
use App\Contracts;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerRepositories()
    {
        $this->app->bind(Contracts\Repositories\UserRepositoryContract::class, function () {
            return new Repositories\UserRepository(new Models\User());
        });

        $this->app->bind(Contracts\Repositories\EmployeeRepositoryContract::class, function () {
            return new Repositories\EmployeeRepository(new Models\Employee());
        });
    }

    private function registerServices()
    {
        $this->app->bind(
            Contracts\Services\UserServiceContract::class,
            Services\UserService::class
        );

        $this->app->bind(
            Contracts\Services\EmployeeServiceContract::class,
            Services\EmployeeService::class
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
