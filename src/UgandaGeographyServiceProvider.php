<?php

namespace JaymesKat\UgandaGeography;

use Illuminate\Support\ServiceProvider;

class UgandaGeographyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // register controllers
        $this->app->make('JaymesKat\UgandaGeography\DistrictsController');
        $this->app->make('JaymesKat\UgandaGeography\RegionsController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes, migration files
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        // Publish seeds
        $this->publishes([ __DIR__ . '/seeds' => $this->app->databasePath() . '/seeds' ], 'seeds');

        // Publish raw data file
        $this->publishes([ __DIR__ . '/../data' => $this->app->storagePath() . '/' ], 'storage');
    }
}
