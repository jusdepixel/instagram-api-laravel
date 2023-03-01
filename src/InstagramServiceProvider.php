<?php

namespace Jusdepixel\InstagramApiLaravel;

use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/instagram.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../config/instagram.php' => config_path('instagram.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/instagram.php', 'instagram'
        );
    }
}
