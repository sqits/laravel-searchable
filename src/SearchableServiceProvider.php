<?php

namespace Sqits\Searchable;

use Illuminate\Support\ServiceProvider;

class SearchableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot() : void
    {
        $this->publishes([
            __DIR__.'/../config/searchable.php' => config_path('searchable.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register() : void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/searchable.php',
            'searchable'
        );
    }
}
