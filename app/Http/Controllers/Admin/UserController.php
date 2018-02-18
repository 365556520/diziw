<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $user;
    private $role;
    private $permisssion;
    function __construct(UserRepository $user,RoleRepository $role,PermissionRepository $permisssion)
    {
        //添加自定义的权限限制中间件
        $this->middleware('check.permission:permission');
        //user
        $this->user = $user;
        $this->role = $role;
        $this->permisssion = $permisssion;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }
//权限表DataTables
    public function ajaxIndex(){
        $result = $this->user->ajaxIndex();
        return response()->json($result);
    }
    /**
     * 添加用户界面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //获取所有角色
        $role = $this->role->all();
        return view('admin.user.create')->with(compact('role'));
    }

    /**
     * 添加用户逻辑
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request){
        $this->user->createUser($request->all());
        return redirect(url('admin/user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //获取这个账号信息
        $user = $this->user->getUser($id);
        //获取所有角色
        $role = $this->role->all();
        return view('admin.user.edit')->with(compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

    }

    /**
     * 删除角色
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->user->destroyUser($id);
        return redirect(url('admin/user'));
    }
}
