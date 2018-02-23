<?php
/**
 * 存档home的路由
 */
Route::get('/','HomeController@index');
//个人信息
Route::get('userdata','HomeController@userdata')->name('userdata');
Route::resource('home','HomeController');