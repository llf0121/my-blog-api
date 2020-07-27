<?php

namespace App\Providers;

use Dingo\Api\Provider\DingoServiceProvider as DingoServiceProviders;
use App\Exceptions\DingoExceptionHandler as ExceptionHandler;

class DingoServiceProvider extends DingoServiceProviders
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    protected function registerExceptionHandler()
    {
        $this->app->singleton('api.exception', function ($app) {
            return new ExceptionHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'], $this->config('errorFormat'), $this->config('debug'));
        });
    }
}