<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Account;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('account', function() {
          return new Account;
        });
    }
}
