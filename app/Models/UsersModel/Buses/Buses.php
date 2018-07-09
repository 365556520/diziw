<?php

namespace App\Models\UsersModel\Buses;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class Buses extends Model
{
    //班车模型
    protected $table='buses';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;

}
