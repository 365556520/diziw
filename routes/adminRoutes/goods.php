<?php
/**
 * 商品管理
 */
//商品分类
Route::group(['prefix' => 'goodscategorys'],function (){
    //列表数据
    Route::get('ajaxIndex','GoodsCategorysController@ajaxIndex');
});
Route::resource('goodscategorys','GoodsCategorysController');
//商品管理
Route::group(['prefix' => 'goods'],function (){
    //列表数据
    Route::get('ajaxIndex','GoodsController@ajaxIndex');
});
Route::resource('goods','GoodsController');