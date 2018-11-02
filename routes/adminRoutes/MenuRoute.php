<?php
//图标路由
Route::get('icons', 'MenuController@icons');
/*菜单路由*/
Route::resource('menu','MenuController');

