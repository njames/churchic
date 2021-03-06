<?php

namespace sc\cic\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'sc\cic\Services\Registrar'
        );


        if ($this->app->environment('local')) {
            // register the service provider
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // register an alias
            $this->app->booting(function()
            {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
            });
        }


    }
}
