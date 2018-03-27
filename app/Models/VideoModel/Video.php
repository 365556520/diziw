<?php

namespace App\Models\VideoModel;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class Video extends Model
{
    protected $table='videos';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'video';
    protected $fillable = [
        'name',
        'path',
        'videoclass_id'
    ];
}
