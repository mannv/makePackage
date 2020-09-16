<?php

namespace Plum\LaravelPermission;

use Illuminate\Support\ServiceProvider;

class LaravelPermissionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'plum');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'plum');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-permission.php', 'laravel-permission');

        // Register the service the package provides.
        $this->app->singleton('laravel-permission', function ($app) {
            return new LaravelPermission;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-permission'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-permission.php' => config_path('laravel-permission.php'),
        ], 'laravel-permission.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/plum'),
        ], 'laravel-permission.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/plum'),
        ], 'laravel-permission.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/plum'),
        ], 'laravel-permission.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
