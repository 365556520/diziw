<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        //添加自定义路由的权限控制中间件
        $this->middleware('check.permission:permission');
    }
}
