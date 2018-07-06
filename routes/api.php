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
// 响应头设置
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

include __DIR__.'/api/content.php';