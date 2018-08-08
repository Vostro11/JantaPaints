<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //require_once('boot.php');  
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\AlbumImageRepository', 'App\Repositories\AlbumImageEloquent');

        $this->app->bind('App\Repositories\AlbumRepository', 'App\Repositories\AlbumEloquent');

        $this->app->bind('App\Repositories\PaintServiceRepository', 'App\Repositories\PaintServiceEloquent');

        $this->app->bind('App\Repositories\UserServiceRepository', 'App\Repositories\UserServiceEloquent');
    }
}