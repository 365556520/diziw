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

Route::resource('video','VideoController');