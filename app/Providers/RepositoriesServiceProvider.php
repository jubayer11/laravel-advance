<?php

namespace App\Providers;

use App\Repositories\TodoListRepository;
use App\Repositories\TodoListRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(TodoListRepositoryInterface::class,TodoListRepository::class);
    }
}
