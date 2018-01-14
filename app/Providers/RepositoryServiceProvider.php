<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//         单例绑定:第一个接口的第二个是实现类
//         $this->app->singleton('App\Repositories\Contracts\UserInterface', function ($app) {
//             return new \App\Repositories\Eloquent\UserServiceRepository();
//         });
//        // 绑定:第一个接口的第二个是实现类
        $this->app->bind('App\Repositories\Contracts\UserInterface', 'App\Repositories\Eloquent\UserServiceRepository');
    }
}
