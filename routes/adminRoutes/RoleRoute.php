<?php
/**
 * 权限路由
 */
Route::group(['prefix' => 'role'],function (){
    Route::get('ajaxIndex','RoleController@ajaxIndex');
    //授权
    Route::post('upPermission','RoleController@upPermission');
});
Route::resource('role','RoleController');