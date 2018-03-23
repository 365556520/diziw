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
        return $this->hasOne('App\Models\VideoModel\Video');
    }
}
