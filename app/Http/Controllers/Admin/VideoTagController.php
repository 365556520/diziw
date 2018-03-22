<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\Admin\VideoTagRepository;
use Illuminate\Http\Request;


class VideoTagController extends CommonController
{
    private $videotag;
    function __construct(VideoTagRepository $videotag)
    {
        //调用父累的构造方法
        parent::__construct('user');
        $this->videotag = $videotag;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.videotag.list');
    }

    //权限表DataTables
    public function ajaxIndex(){
        $result = $this->videotag->ajaxIndex();
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
    public function store(Request $request)
    {
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
    public function update(Request $request, $id)
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
