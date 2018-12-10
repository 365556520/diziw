<?php
/**
 * 文章管理
 */
//文章
Route::group(['prefix' => 'articles'],function (){
    //列表数据
    Route::get('ajaxIndex','ArticlesController@ajaxIndex');
    //上传图片
    Route::post('upload','ArticlesController@upload');
});
Route::resource('articles','ArticlesController');
//文章分类
Route::group(['prefix' => 'categorys'],function (){
    //列表数据
    Route::get('ajaxIndex','CategorysController@ajaxIndex');
    Route::get('destroys/{data}','CategorysController@destroys');
});
Route::resource('categorys','CategorysController');
