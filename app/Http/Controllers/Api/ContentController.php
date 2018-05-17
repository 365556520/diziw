<?php

namespace App\Http\Controllers\Api;

use App\Models\VideoModel\Video;
use App\Models\VideoModel\VideoClass;
use App\Models\VideoModel\VideoTag;
use Illuminate\Http\Request;
use DB;

class ContentController extends CommonController
{
    //获取视频标签
    public function videoTags(){
        return $this->response(VideoTag::get());
    }
    //获取视频类
    public function videoclasss($id){
        if($id){
            //多表关联查询
            $data = DB::table('videoclasss')
                ->select('videoclasss.*')//查询videoclasss的所有列
                //join 第一个参数是2个表的关联表 第二个参数是主表.id 等于 关联表对应这个表的id
                ->join('videotagsid_videoclasssids', 'videoclasss.id', '=', 'videotagsid_videoclasssids.videoclasss_id')
                //关联视频标签的id
                ->where('videotags_id',$id)
                ->get();
        }else{
            $data = VideoClass::get();
        }
        return $this->response($data);
    }
    //获取推荐视频
    public function commendvideoclass($row){
        $data = VideoClass::where('iscommend',1)->limit($row)->get();
        return $this->response($data);
    }
    //获取热门视频
    public function hotvideoclass($row){
        $data = VideoClass::where('ishot',1)->limit($row)->get();
        return $this->response($data);
    }
    //获取视频
    public function videos($videoClasssId){
        $data = Video::where('videoclass_id',$videoClasssId)->get();
        return $this->response($data);
    }

}
