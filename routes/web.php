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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//修改密码视图
Route::get('resetPas','Auth\UserResetPasswordController@resetPas')->middleware(['auth'])->name('resetPas');
//修改密码逻辑
Route::post('resetPas','Auth\UserResetPasswordController@reset')->middleware(['auth'])->name('resetPas');

Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware' => ['auth']],function (){
        //后台页面__DIR__表示当前目录
        require(__DIR__.'/adminRoutes/HomeRoute.php');
        //菜单路由
        require(__DIR__.'/adminRoutes/MenuRoute.php');
        //权限路由
        require(__DIR__.'/adminRoutes/PermissionRoute.php');
        //角色路由
        require(__DIR__.'/adminRoutes/RoleRoute.php');
        //用户路由
        require(__DIR__.'/adminRoutes/UserRoute.php');
        //视频
        require(__DIR__.'/adminRoutes/VideoRoute.php');
        //班车
        require(__DIR__.'/adminRoutes/BusesRoute.php');
});
