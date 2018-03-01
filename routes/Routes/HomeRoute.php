<?php
/**
 * 存档home的路由
 */
Route::get('/','HomeController@index');
//上传图片
Route::get('headimg','HomeController@headimg')->name('headimg');
Route::resource('home','HomeController');