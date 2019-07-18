<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\UserFacade;
use App\Http\Controllers\Api\CommonController;
use App\Models\Role;
use App\Models\UsersModel\User_Data;
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
        $this->content =  UserFacade::userLogin(request('username'),request('password'));
        if($this->content['code'] == 200)
        {
            $this->successStatus = 200;
        } else {
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
            'name' =>'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        //验证失败返回失败信息
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'code'=>401]);
        }
        //验证成功
        $input = $request->all();
        $pasd = $input['password'];
        $input['password'] = bcrypt($input['password']); //密码加密后存储
        $user = User::create($input); //在数据库中创建该用户
        if($user){
            //判断用户存在不
            $this->content =  UserFacade::userLogin($input['username'],$pasd);
            if($this->content['code']== 200)
            {
                //默认添加普通用户的权限
                $userRole = Role::where('name','user')->first();
                $user = Auth::user();
                $user->roles()->attach($userRole->id);
                //关联用户数据
                $user->getUserData()->save(new User_Data(['user_id' => $user->id]));
                $this->successStatus = 200;
            } else {
                $this->successStatus = 401;
            }
        }
        return response()->json(['data'=>$this->content,'code'=> $this->successStatus]);
    }

    //返回用户信息
    public function passport()
    {
        $userdata = User::select('id','name')->where('id',Auth::user()->id)->with('getUserData')->get();
        return response()->json(['user' => $userdata],$this->successStatus);
    }

    /**
     * 退出登录 删除用户令牌
     */
    public function logout()
    {
        if (Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->delete();
        }
        return response()->json(['message' => '登出成功', 'status_code' =>  $this->successStatus, 'data' => null]);
    }
}
