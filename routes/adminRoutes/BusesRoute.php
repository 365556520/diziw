<?php
/**
 * 班车和班车线路路由
 */
Route::group(['prefix' => 'busesroute'],function (){
    //列表数据
    Route::get('ajaxIndex','BusesRouteController@ajaxIndex');
});
Route::resource('busesroute','BusesRouteController');


/**
 * 驾驶员
 */
Route::group(['prefix' => 'driver'],function (){
    //列表数据
    Route::get('ajaxIndex','DriverController@ajaxIndex');
});
Route::resource('driver','DriverController');

/*
 * 视频路由
 * */
Route::group(['prefix' => 'video'],function () {
    Route::get('ajaxIndex','VideoClassController@ajaxIndex');
    //上传图片
    Route::post('upload','VideoClassController@upload');
    //上传视频
    Route::get('uploadvideo','VideoClassController@uploadvideo');
});
Route::resource('video','VideoClassController');