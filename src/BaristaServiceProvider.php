<?php

namespace Barista;

use Barista\Commands\PrepareAPI;
use Barista\Commands\UndoAPI;
use Illuminate\Support\ServiceProvider;

class BaristaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            PrepareAPI::class,
            UndoAPI::class,
            ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/barista.php' => config_path('barista.php'),
        ], 'config');
    }
}
