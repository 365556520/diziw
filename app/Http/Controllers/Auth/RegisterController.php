<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\UsersModel\User_Data;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    //返回主页逻辑 这里优先级大于变量
    protected function redirectTo(){
        /*添加权限和关联用户数据*/
        //默认添加普通用户的权限
        $userRole = Role::where('name','user')->first();
        Auth::user()->roles()->attach($userRole->id);
        //关联用户数据
        $auth =  Auth::user();
        $auth->getUserData()->save( new User_Data(['user_id' => Auth::user()->id]));
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            //这里是添加自定义字段规则
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //captcha是扩展验证码里面的他自定义的验证验证码的验证规则
            'captcha' => 'required|captcha'
        ],[
            //定义验证码的语言required为空captcha填写错误
            'captcha.required' => trans('validation.required'),
            'captcha.captcha' => trans('validation.captcha'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            //这里是添加自定义字段
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
