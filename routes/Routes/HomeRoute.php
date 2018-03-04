<?php
/**
 * 存档home的路由
 */
Route::get('/','HomeController@index');
//修改图像
Route::get('showheadimg','HomeController@showheadimg')->name('showheadimg');
//上传图片
Route::post('headimg','HomeController@headimg')->name('headimg');
Route::resource('home','HomeController');