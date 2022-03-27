<?php

namespace App\Providers;

use App\Http\View\Composers\BeverageComposer;
use App\Models\Bevarage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
//        //for sharing with every view class -option 1
//        View::share('beverages', Bevarage::orderBy('id')->get());
//
//        //here we have selected who gets the beverage data option 2
//        View::composer(['beverage.index','beverage.index'],function ($view)
//        {
//           $view->with('beverages',Bevarage::orderBy('id')->get());
//        });
//
        //option 3
//        View::composer(['beverage.*',BeverageComposer::class]);

    }
}
