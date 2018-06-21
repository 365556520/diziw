<?php
/**
 * 手机版视频路由组
 * User: 小强
 * Date: 2018/5/8
 * Time: 11:43
 * 说明：
 */
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

    Route::group(['namespace'=>'usersdata'],function() {
        //获取该线路汽车
        Route::get('buses/{id}', 'BusesController@getBuses');
        //获取所有线路
        Route::get('getBusesRouteall', 'BusesController@getBusesRouteall');
        //起点和终点查出线路id
        Route::get('getBusesRouteId', 'BusesController@getBusesRouteId');
    });
    Route::group(['namespace'=>'Auth'],function() {
        //登录api
        Route::post('login', 'LoginController@login');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('passport', 'LoginController@passport');
        });
    });
});