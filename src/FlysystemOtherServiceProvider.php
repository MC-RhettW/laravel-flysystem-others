<?php

namespace MCDev\Flysystem;

use Danhunsaker\Laravel\Flysystem\FlysystemServiceProvider;


class FlysystemSupportServiceProvider extends FlysystemServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot ()
    {
        foreach ( (array)$this->app['config']['filesystems.autowrap'] as $drive ) {
            $this->app['filesystem']->disk( $drive );
        }
    }

    /**
     * Register the filesystem manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('filesystem', function () {
            return new FlysystemSupportManager( $this->app );
        });
    }

    /**
     * Register the expanded configuration.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([realpath(__DIR__ . '/../config/filesystems.php') => config_path('filesystems.php')]);
    }
}
