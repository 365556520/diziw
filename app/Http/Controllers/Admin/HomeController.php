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

    public function headimg(Request $request){
        $imgname = $this->home->upimgage($request->all());
//        更新数据库图片名称
        User_Data::Where('id',$request->all()['user_data_img'])->update(["headimg" => $imgname]);
        return view('admin.home.userdata');
    }

    public function index(){
        return view('admin.home.index');
    }
    public function store(Request $request){

    }

    public function show($id){

    }
    /**/
    public function edit($id){
        //获取这个角色
        $user = $this->user->getUser($id);
        return view('admin.home.userdata')->with(compact('user'));
    }

    /**
     *
     */
    public function update(Request $request)
    {
    }

    /**
     *
     */
    public function destroy($id){

    }

}

