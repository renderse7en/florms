<?php

namespace Se7enet\Florms;

use Illuminate\Support\ServiceProvider;

class FlormsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('florm', function ($app) {
            return new Florm();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/florms.php',
            'florms'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/florms.php' => config_path('florms.php'),
        ], 'florms-config');
    }
}
