<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Stripe\Stripe::setApiKey("sk_test_eah7qeJhlMmOlsNPS6CHsxUX");
        //Openpay
        // \Openpay::setId('mk5lculzgzebbpxpam6x');
        // \Openpay::setApiKey('sk_d90dcb48c665433399f3109688b76e24');
        \Openpay::setSandBoxMode(true);
        \Openpay::setProductionMode(false);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
