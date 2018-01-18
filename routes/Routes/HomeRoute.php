<?php
/**
 * 存档home的路由
 * User: 小强
 * Date: 2018/1/18
 * Time: 15:33
 * 说明：
 */
Route::get('/','HomeController@index');
Route::resource('home','HomeController');