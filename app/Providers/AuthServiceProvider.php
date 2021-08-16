<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        // AuthServiceProvider 中，设置 token 过期时间
        Passport::tokensExpireIn(now()->addDays(15)); // access_token 过期时间
        Passport::refreshTokensExpireIn(now()->addDays(60)); // refresh_token 过期时间
//        Passport::$ignoreCsrfToken = true;
//        Passport::tokensExpireIn(now()->addDays(15)); // access_token 过期时间
//        Passport::refreshTokensExpireIn(now()->addDays(60)); // refresh_token 过期时间
        //
    }
}
