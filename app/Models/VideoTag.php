<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class VideoTag extends Model{

    protected $table='videotags';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'videotag';
    protected $fillable = [
        'name',
    ];
}
