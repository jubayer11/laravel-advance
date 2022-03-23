<?php

namespace App\Providers;

use App\Services\PostCardSendingService;
use Illuminate\Support\ServiceProvider;

class facadeLearningProvider extends ServiceProvider
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
        $this->app->singleton('Postcard', function () {
            return new PostCardSendingService('us', 4, 6);
        });
    }
}
