<?php

namespace Swapnil\ApiResponse;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

       $loader = \Illuminate\Foundation\AliasLoader::getInstance();
       $loader->alias('ApiResponse', 'Swapnil\ApiResponse\Facade');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

     $this->app['swapnil.api-response'] = $this->app->share(function($app) {
         return new ApiResponse();
     });
    }
}
