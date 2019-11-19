<?php

namespace JaymesKat\UgGeog;

use Illuminate\Support\ServiceProvider;

class UgGeogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes, migration files
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/seeds' => $this->app->databasePath() . '/seeds'], 'seeds');

        // Publish raw data file
        $this->publishes([__DIR__ . '/../data' => $this->app->storagePath() . '/'], 'storage');

        // Publish models
        $this->publishes([__DIR__ . '/models' => $this->app->basePath() . '/app'], 'app');
    }
}
