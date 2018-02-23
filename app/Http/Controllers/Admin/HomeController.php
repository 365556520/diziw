<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{

    private $user;

    function __construct(UserRepository $user)
    {
        //添加自定义的权限限制中间件
        $this->middleware('check.permission:permission');
        //user
        $this->user = $user;


    }

    public function userdata(Request $request){
        //获取这个角色
        $user = $this->user->getUser($request->input('id'));
        return view('admin.home.userdata')->with(compact('user'));
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

