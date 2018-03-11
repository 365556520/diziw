<?php

namespace App\Http\Controllers\Admin;


use App\Models\UsersModel\User_Data;
use App\Repositories\Eloquent\Admin\HomeRepository;
use App\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{

    private $user;
    private $home;
    function __construct(UserRepository $user,HomeRepository $home){
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

    public function index(){
        return view('admin.home.index');
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

}

