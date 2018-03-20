<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('text', function () {
/*    #这里请填写cos-autoloader.php该文件所在的相对路径这个地方说是需要但是目前没导入也没问题
    require(public_path().'/backend/myvebdors/cos-php-sdk-v5-master/cos-autoloader.php');*/
    $cosClient = new Qcloud\Cos\Client(array('region' => 'ap-beijing',
        'credentials'=> array(
            'appId' => '1251899486',
            'secretId'    => 'AKIDKYhkbIPLfnnaBb6obDielplkcIm32GED',
            'secretKey' => 'ylLn370jIjx1v23sUxFLEwRmvDM7lFXd')));

    #listObjects
    try {
        $result = $cosClient->listObjects(array(
            'Bucket' => 'diziw-1251899486'));
        dd($result);
    } catch (\Exception $e) {
        echo "$e\n";
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//修改密码视图
Route::get('resetPas','Auth\UserResetPasswordController@resetPas')->middleware(['auth'])->name('resetPas');
//修改密码逻辑
Route::post('resetPas','Auth\UserResetPasswordController@reset')->middleware(['auth'])->name('resetPas');

Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware' => ['auth']],function (){
        //后台页面__DIR__表示当前目录
        require(__DIR__.'/Routes/HomeRoute.php');
        //菜单路由
        require(__DIR__.'/Routes/MenuRoute.php');
        //权限路由
        require(__DIR__.'/Routes/PermissionRoute.php');
        //角色路由
        require(__DIR__.'/Routes/RoleRoute.php');
        //用户路由
        require(__DIR__.'/Routes/UserRoute.php');
});
