<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Repositories\Eloquent\Admin\RoleRepository;
use Illuminate\Http\Request;


class RoleController extends CommonController
{
    private $role;
    function __construct(RoleRepository $role){
        //调用父类的构造方法传
        parent::__construct('role');
        //role
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*更新管理员权限*/
//      $this->role->upadmin();
        return view('admin.role.list');
    }
//权限表DataTables
    public function ajaxIndex(Request $request){
        $result = $this->role->ajaxIndex($request->all());
        return response()->json($result);
    }

    /**
     * 添加视图
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * 添加表单逻辑
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request){
        $this->role->createRole($request->all());
        return redirect(url('admin/role'));
    }

    /**
     * Display the specified resource.
     *授权
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $role = $this->role->getRole($id);
        return view('admin.role.show')->with(compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $role = $this->role->editView($id);
        return view('admin.role.edit')->with(compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->role->updateRole($request->all(),$id);
        return redirect('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->role->destroyRole($id);
        return redirect('admin/role');
    }
    /*
     * 授权
     * */
    public function upPermission(Request $request){
        $data = $request->all();
        $this->role->setRolePermission(explode(",", $data["permission"]),$data["id"]);
        return redirect('admin/role');
    }
}
