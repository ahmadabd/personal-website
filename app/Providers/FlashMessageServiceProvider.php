<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FlashMessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Controllers\FlashMessage\FlashMessage',
            'App\Http\Controllers\FlashMessage\Failed'
        ); 
        $this->app->bind(
            'App\Http\Controllers\FlashMessage\FlashMessage',
            'App\Http\Controllers\FlashMessage\Success'
        );     
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
