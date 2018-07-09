<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.buses.busesroute.list');
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
     * 添加视频标签
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoTagRequest $request){
        $this->videotag->createVideoTag($request->all());
        return redirect(url('admin/videotag'));
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
     * 显示修改标签视图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videotag = $this->videotag->editView($id);
        return view('admin.videotag.edit')->with(compact('videotag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoTagRequest $request, $id)
    {
        $videotag = $this->videotag->updateVideoTagr($request->all(),$id);
        return redirect('admin/videotag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->videotag->destroyVideoTagr($id);
        return redirect(url('admin/videotag'));
    }
}
