<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*跨域接口响应*/
// 指定允许其他域名访问
header('Access-Control-Allow-Origin: *');
// 响应类型
header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
// 响应头设置 lavarel响应头要和vue中设置的响应头对应都不可缺（要不存在响应头错误）
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization");

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/* 巨坑  ：在运行路由缓存后 这里导入的路由文件不能用，因此api接口里面只能把路由写到一个文件里面（否则运行路由缓存api接口不识别，但是web文件的路由没问题）
 * //导入路由文件
require(__DIR__.'/api/content.php');*/

Route::group(['namespace'=>'Api'],function(){
    //视频标签接口
    Route::get('videoTags','ContentController@videoTags');
    //视频类接口
    Route::get('videoclasss/{id}','ContentController@videoclasss');
    //推荐视频接口
    Route::get('commendvideoclass/{row}','ContentController@commendvideoclass');
    //热门视频接口
    Route::get('hotvideoclass/{row}','ContentController@hotvideoclass');
    //视频接口
    Route::get('videos/{videoClasssId}','ContentController@videos');
    //班车接口
    Route::group(['namespace'=>'usersdata'],function() {
        //获取该线路汽车
        Route::get('buses/{id}', 'BusesController@getBuses');
        //获取所有线路
        Route::get('getBusesRouteall', 'BusesController@getBusesRouteall');
        //起点和终点查出线路id
        Route::get('getBusesRouteId', 'BusesController@getBusesRouteId');
    });
    //文章接口

    Route::group(['namespace'=>'Auth'],function() {
        //登录api
        Route::post('login', 'PassportController@login');
        // 注册
        Route::post('register', 'PassportController@register');
        //用户令牌认证过滤
        Route::group(['middleware' => 'auth:api'], function() {
            //获取用户信息
            Route::post('passport', 'PassportController@passport');
            //退出用户删除令牌
            Route::post('logout','PassportController@logout');
        });
    });
});