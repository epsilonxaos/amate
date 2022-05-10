<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_ENV') == 'desarrollo' || env('APP_ENV') == 'production') {
            Schema::defaultStringLength(191);
        }
        if(env('APP_ENV') == 'production') {
            URL::forceScheme('https');
        }
       /* $this->app->bind('path.public', function() {
            return base_path('../public_html/');
        });
        URL::forceScheme('https');*/
    }
}
