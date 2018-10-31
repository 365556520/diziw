<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        //把菜单数据共享给sidebar视图
        view()->composer(
            'layouts.sidebar', 'App\Http\ViewComposers\MenuComposer'
        );
        view()->composer(
            'admin.layouts.sidebar', 'App\Http\ViewComposers\MenuComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
