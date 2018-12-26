<?php
/**
 * 商品管理
 */
//文章
Route::group(['prefix' => 'goodscategorys'],function (){
    //列表数据
    Route::get('ajaxIndex','GoodsCategorysController@ajaxIndex');
});
Route::resource('goodscategorys','GoodsCategorysController');
