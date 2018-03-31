<?php
/**
 * 视频标签
 */
Route::group(['prefix' => 'videotag'],function (){
    Route::get('ajaxIndex','VideoTagController@ajaxIndex');
});
Route::resource('videotag','VideoTagController');
/*
 * 视频路由
 * */
Route::group(['prefix' => 'video'],function () {
    //上传图片
    Route::post('upload', 'VideoClassController@upload');
    //上传视频
    Route::post('uploadvideo', 'VideoClassController@uploadvideo');
});
Route::resource('video','VideoClassController');