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

Route::group(['namespace'=>'Auth'],function () {

//修改密码视图
    Route::get('resetPas','UserResetPasswordController@resetPas')->middleware(['auth'])->name('resetPas');
//修改密码逻辑
    Route::post('resetPas','UserResetPasswordController@reset')->middleware(['auth'])->name('resetPas');
//成功页面
    Route::get('auth/success/{massage}', 'UserResetPasswordController@success');
    // 引导用户到新浪微博的登录授权页面
    Route::get('auth/weibo', 'LoginController@weibo');
// 用户授权后新浪微博回调的页面
    Route::get('auth/weibocallback', 'LoginController@weibocallback');
});
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
        //文章管理
        require(__DIR__.'/adminRoutes/articles.php');
        //商品管理
        require(__DIR__.'/adminRoutes/goods.php');
});
