<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';
    //登录逻辑 这里优先级大于变量
    protected function redirectTo(){
//        如果有后台权限就登录到后台没有就登录到前台
        if(Auth::user()->can(config('admin.permissions.system.login'))){
            return 'admin/home';
        }
        return 'home';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //自定义用户登录字段
    public function username()
    {
        //这里这里填写数据库用来登录的字段可以设置如id等后再login页面要设置这个登录字段
        return config('admin.globals.username');
    }
    //验证码重写AuthenticatesUsers类里面的这个validateLogin方法，增加验证码判断
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            //captcha是扩展验证码里面的他自定义的验证验证码的验证规则
            'captcha' => 'required|captcha'
        ],[
            //定义验证码的语言required为空captcha填写错误
            'captcha.required' => trans('validation.required'),
            'captcha.captcha' => trans('validation.captcha'),
        ]);
    }
}
