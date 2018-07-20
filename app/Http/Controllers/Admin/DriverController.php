<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusesRouteRequest;
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
     * 添加班车线路
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusesRouteRequest $request){
        //$request->except('_token')不获取_token的值，其他值正常获取
        $result = $this->driver->createBusesRoute($request->except('_token'));
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
     * 显示修改班车线路视图
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
    public function update(BusesRouteRequest $request, $id)
    {
        $this->driver->updateBusesRoute($request->all(),$id);
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
        $this->driver->destroyBusesRoute($id);
        return redirect(url('admin/driver'));
    }
}
