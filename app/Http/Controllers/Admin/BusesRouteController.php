<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusesRouteRequest;
use App\Repositories\Eloquent\Admin\Buses\BusesRouteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusesRouteController extends CommonController
{
    private $busesroute;
    function __construct(BusesRouteRepository $busesroute)
    {
        //调用父累的构造方法
        parent::__construct('busesroute');
        $this->busesroute = $busesroute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //得到所有线路
        $pid = $this->busesroute->getpid();
        return view('admin.buses.busesroute.list')->with(compact('pid'));
    }


    //列表表DataTables
    public function ajaxIndex(){
        $result = $this->busesroute->ajaxIndex();
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
        $result = $this->busesroute->createBusesRoute($request->except('_token'));
        return redirect(url('admin/busesroute'));
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
        $busesroute = $this->busesroute->editView($id);
        $pid = $this->busesroute->getpid();
        return view('admin.buses.busesroute.edit')->with(compact('busesroute','pid'));
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
        $this->busesroute->updateBusesRoute($request->all(),$id);
        return redirect('admin/busesroute');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->busesroute->destroyBusesRoute($id);
        return redirect(url('admin/busesroute'));
    }
}
