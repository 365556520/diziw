<?php
/**
 * 权限路由
 */
Route::group(['prefix' => 'permission'],function (){
    Route::get('ajaxIndex','PermissionController@ajaxIndex');
});
Route::resource('permission','PermissionController');