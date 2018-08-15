<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Repositories\Eloquent\Admin\Buses\DriverRepository;

class DriverController extends CommonController
{
    /*驾驶员控制器*/
    private $driver;
    function __construct(DriverRepository $driver)
    {
        //调用父累的构造方法
        parent::__construct('driver');
        $this->driver = $driver;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.buses.driver.list');
    }


    //列表表DataTables
    public function ajaxIndex(){
        $result = $this->driver->ajaxIndex();
        return response()->json($result);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 添加驾驶员
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$request->except('_token')不获取_token的值，其他值正常获取
        $result = $this->driver->createDriver($request->except('_token','field'));
        return redirect(url('admin/driver'));
    }

    /**
     *显示视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * 显示修改驾驶员路视图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = $this->driver->editView($id);
        return view('admin.buses.driver.edit')->with(compact('driver'));
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
        $this->driver->updateDriver($request->all(),$id);
        return redirect('admin/driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->driver->destroyDriver($id);
        return redirect(url('admin/driver'));
    }
}
