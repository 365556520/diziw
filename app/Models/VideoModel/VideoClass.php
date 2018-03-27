<?php

namespace App\Models\VideoModel;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class VideoClass extends Model
{
    protected $table='videoclasss';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'videoclass';
    protected $fillable = [
        'title',
        'introduce',
        'preview',
        'iscommend',
        'ishot',
        'click',
    ];
    /**
     * 获得与视频类关联的视频。
     */
    public function getVideo()
    {
        //第二个参数是自定义外键的名字不用的话默认是video_class_id
        return $this->hasMany('App\Models\VideoModel\Video','videoclass_id');
    }
}
