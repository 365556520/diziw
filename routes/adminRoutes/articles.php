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
    //删除图片
    Route::post('calldel','ArticlesController@calldel');
    //批量删除文章
    Route::post('destroys/{id}','ArticlesController@destroys');
});
Route::resource('articles','ArticlesController');
//文章分类
Route::group(['prefix' => 'categorys'],function (){
    //列表数据
    Route::get('ajaxIndex','CategorysController@ajaxIndex');
    //删除文章分类
    Route::get('destroys/{data}','CategorysController@destroys');
});
Route::resource('categorys','CategorysController');
