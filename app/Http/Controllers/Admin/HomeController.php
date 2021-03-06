<?php

namespace App\Http\Controllers\Admin;


use App\Models\UsersModel\User_Data;
use App\Repositories\Eloquent\Admin\HomeRepository;
use App\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends CommonController{

    private $user;
    private $home;
    function __construct(UserRepository $user,HomeRepository $home){
        //调用父类的构造方法传
        parent::__construct('system.login');
        //user
        $this->user = $user;
        $this->home = $home;
    }
    //头像图片渲染
    public function showheadimg(Request $request){
        //防止重复提交
        $request->session()->put('register',time());
        return view('auth.adminData.headimg');
    }
    //头像图片修改
    public function headimg(Request $request){
        if($request->session()->has('register')){
            //存在则表示是首次提交，清空session中的'register'
            $request->session()->forget('register');
            $imgname = $this->home->upimgage($request->all());
//        更新数据库图片名称
            User_Data::Where('user_id',$request->all()['user_data_img'])->update(["headimg" => $imgname]);
        }else{
            //否则抛http异常，跳转到403页面
            flash("不能重复提交",'error');
        }
        return view('auth.adminData.headimg');
    }
    //欢迎页面
    public function welcome(){
        return view('admin.home.index');
    }

    public function index(){
        return view('admin.layouts.nav');
    }
    public function store(Request $request){

    }

    public function show($id){

    }
    /**/
    public function edit(Request $request,$id){
        //防止重复提交
        $request->session()->put('register',time());
        return view('auth.adminData.userdata');
    }

    /**
     *
     */
    public function update(Request $request,$id){
        if($request->session()->has('register')){
            //存在则表示是首次提交，清空session中的'register'
            $request->session()->forget('register');
            //        修改信息
            $this->home->updateUser($request->all(),$id);
        }else{
            //否则抛http异常，跳转到403页面
            flash("不能重复提交",'error');
        }
        return view('auth.adminData.userdata');
    }

    /**
     *
     */
    public function destroy($id){

    }
    public function getobjkey(){
        if(Auth::user()->can(config('admin.permissions.system.login'))){// 如果有后台权限就登录到后台
            $data =  array(
                'region' => config('admin.cos.region'),
                'credentials'=> array(
                    'appId' => config('admin.cos.credentials.appId'),
                    'secretId' => config('admin.cos.credentials.secretId'),
                    'secretKey' => config('admin.cos.credentials.secretKey')
                )
            );
            return response()->json($data);
        }else{ // 创建用户个人 token api
            return '大爷你有不是管理员瞎搞个啥';
        }
    }
}

