<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RoleController extends Controller
{
    private $role;
    function __construct(RoleRepository $role)
    {
        //添加自定义的权限限制中间件
        $this->middleware('check.permission:permission');
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
        return view('admin.role.list');
    }
//权限表DataTables
    public function ajaxIndex(){
        $result = $this->role->ajaxIndex();
        return response()->json($result);
    }

    /**
     * 添加视图
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $permission =  $this->role->getAllPermissionList();
        return view('admin.role.create')->with(compact('permission'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->find($id);
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
    public function update(Request $request, $id)
    {
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
}
