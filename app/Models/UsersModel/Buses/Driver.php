<?php

namespace App\Models\UsersModel\Buses;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class Driver extends Model
{
    //驾驶员模型
    protected $table = 'driver';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action = 'driver';
    //获取驾驶的车辆
     public function getBuses()
     {
          return $this->hasOne('App\Models\UsersModel\Buses\Buses', 'buses_driver_id');
     }
}
