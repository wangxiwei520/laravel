<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        $this->registerPolicies();

        Passport::routes();
        //
    }
}
