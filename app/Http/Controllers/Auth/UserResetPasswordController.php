<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserResetPasswordController extends Controller
{
    //修改密码视图
    public function resetPas(){
        return view('auth.adminData.resretpas');
    }
    //修改密码逻辑
    public function reset(UserRequest $request){
        echo 'asd';
    }

}
