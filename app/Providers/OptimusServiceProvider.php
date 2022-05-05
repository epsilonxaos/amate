<?php

namespace App\Providers;

use Jenssegers\Optimus\Optimus;
use Illuminate\Support\ServiceProvider;

class OptimusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Optimus::class, function ($app) {
            return new Optimus(1434691241, 1951817113, 2097974067, 31);

        });
    }
}
