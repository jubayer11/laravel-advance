<?php

namespace App\Providers;

use App\Billing\BankPaymentGateWay;
use App\Billing\CreditPaymentGateWay;
use App\Billing\PaymentGateWayContract;
use App\Mixins\StrMixins;
use App\Services\PostCardSendingService;
use Google\Client;
use http\Env\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Client::class, function () {
            $client = app(Client::class);
            $config = config('services.google');
            $client->setClientId($config['id']);
            $client->setClientSecret($config['secret']);
            $client->setRedirectUri($config['redirect_url']);
            return $client;
        });
//        $this->app->bind(BankPaymentGateWay::class, function ($app) {
//            return new BankPaymentGateWay('usd');
//        });
        //bind create new object for every dependency injection but singleton create only on object and save it.
//        $this->app->singleton(BankPaymentGateWay::class, function ($app) {
//            return new BankPaymentGateWay('usd');
//        });
        $this->app->singleton(PaymentGateWayContract::class, function ($app) {
            if (request()->has('credit')) {
                return new CreditPaymentGateWay('usd');

            } else {
                return new BankPaymentGateWay('usd');

            }

        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //facades

        //
        $this->app->singleton('Postcard', function () {
            return new PostCardSendingService('us', 4, 6);
        });

        //macros using return function --option 1

        Str::macro('partNumber', function ($part) {
            return 'AB-' . substr($part, 0, 3) . '-' . substr($part, 3);
        });


        ResponseFactory::macro('errorJson', function ($message='default error message') {
            return ['message' => $message,
                'errorcode' => 66];
        });

        //macros using class --option 2
        Str::mixin(new StrMixins());

    }
}
