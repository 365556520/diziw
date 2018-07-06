<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*跨域接口响应*/
// 指定允许其他域名访问
header('Access-Control-Allow-Origin: *');
// 响应类型
header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
// 响应头设置 lavarel响应头要和vue中设置的响应头对应都不可缺（要不存在响应头错误）
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//导入路由文件
include __DIR__.'/api/content.php';