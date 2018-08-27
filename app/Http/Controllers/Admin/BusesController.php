<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusesRouteRequest;
use App\Models\UsersModel\Buses\BusesRoute;
use App\Models\UsersModel\Buses\Driver;
use App\Repositories\Eloquent\Admin\Buses\BusesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusesController extends CommonController
{
    private $buses;
    function __construct(BusesRepository $buses)
    {
        //调用父累的构造方法
        parent::__construct('buses');
        $this->buses = $buses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //得到所有驾驶员
        $driver = Driver::all();
        //得到所有线路
        $busesRoute =BusesRoute::all();
        return view('admin.buses.buses.list')->with(compact('driver','busesRoute'));
    }


    //列表表DataTables
    public function ajaxIndex(){
        $result = $this->buses->ajaxIndex();
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
    public function store(Request $request){
        //$request->except('_token')不获取_token的值，其他值正常获取
        $result = $this->buses->createBuses($request->except('_token'));
        return redirect(url('admin/buses'));
    }

    /**
     *显示视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buses = $this->buses->find($id);
        $buses['driver'] = $buses->getDriver;
        return view('admin.buses.buses.show')->with(compact('buses'));
    }

    /**
     * 显示修改班车线路视图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buses = $this->buses->editView($id);
        return view('admin.buses.buses.edit')->with(compact('buses'));
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
        $this->buses->updateBusesRoute($request->all(),$id);
        return redirect('admin/buses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->buses->destroyBusesRoute($id);
        return redirect(url('admin/buses'));
    }
}
