<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\CommonController;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Auth;

class PassportController extends CommonController
{
    public $successStatus = 200;  //信息状态码
    public function __construct()
    {
        $this->content = array();
    }
    //登录
    public function login(){
        //判断用户存在不
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')]))
        {
            $user = Auth::user();
            $this->content['token'] =  $user->createToken('Pi App')->accessToken; //创建令牌
            $this->content['userdata']= $user;//用户信息
            $this->successStatus = 200;
        } else {
            $this->content['error'] = "未授权";
            $this->successStatus = 401;
        }
        return response()->json($this->content, $this->successStatus);
    }
    /**
     * 注册Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {   //验证注册数据
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        //验证失败返回失败信息
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        //验证成功
        $input = $request->all();
        $input['password'] = bcrypt($input['password']); //密码加密后存储
        $user = User::create($input); //在数据库中创建该用户
        //下面是注册成功会返回的信息
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    //返回用户信息
    public function passport()
    {
        return response()->json(['user' => Auth::user()],$this->successStatus);
    }
}
