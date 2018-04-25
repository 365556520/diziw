<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\Admin\VideoClassRepository;
use Illuminate\Http\Request;
use App\Facades\CosFacade;

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

    //权限表DataTables
    public function ajaxIndex(){
        $result = $this->video->ajaxIndex();
        return response()->json($result);
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

    /*
* 上传视频
* */
    public function uploadvideo(Request $request){

    /*    $video = $request->file;
        //获取文件名称
        $videoName = $video -> getClientOriginalName();
        //获取文件后缀
        $entension = $video -> getClientOriginalExtension();
        //生成新的文件名称
        $newName = md5(date("Y-m-d H:i:s").$videoName).".".$entension;
        if ($video->isValid()) {
            //使用cos上传
            $path =  CosFacade::putObject(config('admin.cos.bucket'),'video/'.$newName,$video);
            return ['status' => 0,'message' =>'上传成功','path' => $path['ObjectURL']];
        }
        return ['status' => 1,'message' => '上传失败'];*/
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
        $video = $this->video->editView($id);

        return view('admin.video.edit',compact('video'));
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
       $this->video->updateVideo($request->all(),$id);
        return redirect('admin/video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除视频
        $this->video->destroyVideo($id);
        return redirect('admin/video');
    }
}
