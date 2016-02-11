<?php

namespace Cic\Providers;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Bus\Dispatcher $dispatcher
     */
    public function boot(Dispatcher $dispatcher)
    {
// @figure out where this goes
//        $dispatcher->mapUsing(function ($command) {
//            return Dispatcher::simpleMapping(
//                $command, 'Cic\Commands', 'Cic\Handlers\Commands'
//            );
//        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
