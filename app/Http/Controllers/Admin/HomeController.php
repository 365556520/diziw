<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{

    private $user;

    function __construct(UserRepository $user)
    {

        //user
        $this->user = $user;


    }

    public function headimg(Request $request){


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

