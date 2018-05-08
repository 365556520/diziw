<?php
/**
 * 手机版视频路由组
 * User: 小强
 * Date: 2018/5/8
 * Time: 11:43
 * 说明：
 */
Route::group(['namespace'=>'Api'],function(){
    Route::get('videoTags','ContentController@videoTags');
});