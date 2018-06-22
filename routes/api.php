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
header('Access-Control-Allow-Origin:*');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

include __DIR__.'/api/content.php';