<?php
/**
 * 存档home的路由
 */
//欢迎页面
Route::get('welcome','HomeController@welcome');
//修改图像
Route::get('showheadimg','HomeController@showheadimg')->name('showheadimg');
//上传图片
Route::post('headimg','HomeController@headimg')->name('headimg');


Route::resource('home','HomeController');