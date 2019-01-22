<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //公共控制器
    public function response($data,$msg = "",$code = 200){
        return['code' => $code,'msg'=>$msg,'data' => $data];
    }
}
