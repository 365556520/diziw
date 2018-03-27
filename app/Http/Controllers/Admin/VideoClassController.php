<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\Admin\VideoClassRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoClassController extends CommonController
{

    private $video;
    function __construct(VideoClassRepository $video)
    {
/*        //调用父累的构造方法
        parent::__construct('video');*/
        $this->video = $video;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.video.list');
    }

    /*
 * 上传图片
 * */
    public function upload(Request $request){
        $upload = $request->file;
        if ($upload->isValid()) {
            //把图片放到临时文件家下面
           $path =  $upload->store('backend/images/temp');
            return ['status' => 0,'message' =>'上传成功','path' => $path];
        }
        return ['status' => 1,'message' => '上传失败'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * 添加视频
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->video->createVideoClass($request->all());
        return view('admin.video.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
