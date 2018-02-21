<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Repositories\Eloquent\Admin\PermissionRepository;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\RoleRepository;


class PermissionController extends Controller
{
    private $permission;
    private $role;
    function __construct(PermissionRepository $permission,RoleRepository $role)
    {
        //添加自定义的权限限制中间件
        $this->middleware('check.permission:permission');
        $this->role = $role;
        //注入permission的model
        $this->permission = $permission;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.permission.list');
    }
//权限表DataTables
    public function ajaxIndex(){
        $result = $this->permission->ajaxIndex();
        return response()->json($result);
    }

    /**
     * 添加视图
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.permission.create');
    }

    /**
     * 添加内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = $this->permission->createPermission($request->all());
        if ($permission){
            /*添加成功后更新超级管理员的权限*/
            $this->role->upadmin(config('admin.globals.upadmin.name'),config('admin.globals.upadmin.admin'));
        }
        return redirect(url('admin/permission'));
    }

    /**
     * 显示内容查看的
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $permission = $this->permission->find($id);
         return view('admin.permission.show')->with(compact('permission'));
    }

    /**
     * 点击修改获取要这条记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $permission = $this->permission->editView($id);
        return view('admin.permission.edit')->with(compact('permission'));
    }

    /**
     * 修改内容提交到数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->permission->updatePermission($request->all(),$id);
        if ($permission){
            /*修改成功后更新超级管理员的权限*/
            $this->role->upadmin(config('admin.globals.upadmin.name'),config('admin.globals.upadmin.admin'));
        }
        return redirect('admin/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->destroyPermission($id);
        if ($permission){
            /*删除成功后更新超级管理员的权限*/
            $this->role->upadmin(config('admin.globals.upadmin.name'),config('admin.globals.upadmin.admin'));
        }
        return redirect('admin/permission');
    }
}
