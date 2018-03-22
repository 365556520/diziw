<?php
/**
 * 权限路由
 */
Route::group(['prefix' => 'role'],function (){
    Route::get('ajaxIndex','RoleController@ajaxIndex');
});
Route::resource('role','RoleController');