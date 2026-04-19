<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        
        Auth::extend('completeprofile', function ($app, $name, array $config) {
            return new \App\Guards\AdminGuard(
                Auth::createUserProvider($config['provider']),
                $app->make('request')
            );
        });

        
     
        
        Auth::extend('publisher', function ($app, $name, array $config) {
            return new \App\Guards\ModeratorGuard(
                Auth::createUserProvider($config['provider']),
                $app->make('request')
            );
        });

        // Register the pending guard
        Auth::extend('advertiser', function ($app, $name, array $config) {
            return new \App\Guards\ModeratorGuard(
                Auth::createUserProvider($config['provider']),
                $app->make('request')
            );
        });

        // Register the teacher guard
        Auth::extend('suspended', function ($app, $name, array $config) {
            return new \App\Guards\ModeratorGuard(
                Auth::createUserProvider($config['provider']),
                $app->make('request')
            );
        });
        
    }

}
