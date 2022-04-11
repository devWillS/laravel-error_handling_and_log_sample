<?php

namespace App\Providers;

use Fluent\Logger\FLuentLogger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\ElasticsearchHandler;
use App\Foundation\ElasticsearchClient;

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
        $this->app->singleton(
            ElasticsearchHandler::class,
            function (Application $app) {
                return new ElasticsearchHandler(
                    $app->make(ElasticsearchClient::class)->client()
                );
            }
        );
    }
}
