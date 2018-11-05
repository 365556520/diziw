<?php
/**
 * 文章管理
 */
//文章
Route::resource('articles','ArticlesController');
//文章分类
Route::resource('categorys','CategorysController');
