<?php

namespace App\Providers;

use Fluent\Logger\FLuentLogger;
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
        $this->app->singleton(FluentLogger::class, function () {
            return new FluentLogger('localhost', 24224);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
