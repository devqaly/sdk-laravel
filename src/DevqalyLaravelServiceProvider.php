<?php

namespace Devqaly\DevqalyLaravel;

use Illuminate\Support\ServiceProvider;

class DevqalyLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/devqaly.php' => config_path('devqaly.php'),
        ], 'devqaly');
    }
}
