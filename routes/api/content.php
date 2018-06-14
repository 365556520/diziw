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
    //获取该线路汽车
    Route::get('buses/{id}','usersdata\BusesController@getBuses');
    //获取所有线路
    Route::get('getBusesRouteall','usersdata\BusesController@getBusesRouteall');

    Route::get('getBusesRouteId','usersdata\BusesController@getBusesRouteId');

});