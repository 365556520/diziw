<?php
/**
 * 存档home的路由
 */
Route::get('/','HomeController@index');
Route::resource('home','HomeController');