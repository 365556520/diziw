<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware' => ['auth']],function (){
        //后台页面__DIR__表示当前目录
        require(__DIR__.'/Routes/HomeRoute.php');
        //菜单路由
        require(__DIR__.'/Routes/MenuRoute.php');
        //权限路由
        require(__DIR__.'/Routes/PermissionRoute.php');
        //角色路由
        require(__DIR__.'/Routes/RoleRoute.php');
});
