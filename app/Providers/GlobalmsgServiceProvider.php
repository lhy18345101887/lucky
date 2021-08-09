<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalmsgServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('globalmsg',\App\Utils\GlobalMsg::class);
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
    }
}
