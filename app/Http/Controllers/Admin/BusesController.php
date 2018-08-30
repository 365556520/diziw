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
    //得到所有驾驶员
    private $driver;
    //得到所有线路
    private $busesRoute;
    function __construct(BusesRepository $buses)
    {
        //调用父累的构造方法
        parent::__construct('buses');
        $this->buses = $buses;
        $this->driver = Driver::all();
        $this->busesRoute = BusesRoute::all();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //得到所有驾驶员
        $driver =   $this->driver;
        //得到所有线路
        $busesRoute = $this->busesRoute;
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
        $buses['busesroute'] = $buses->getBusesRoute;
        return view('admin.buses.buses.show')->with(compact('buses'));
    }

    /**
     * 显示修改班车视图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //得到所有驾驶员
        $driver =   $this->driver;
        //得到所有线路
        $busesRoute = $this->busesRoute;
        $buses = $this->buses->editView($id);
        return view('admin.buses.buses.edit')->with(compact('buses','driver','busesRoute'));
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
