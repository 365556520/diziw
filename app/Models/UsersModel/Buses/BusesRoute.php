<?php

namespace App\Models\UsersModel\Buses;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class BusesRoute extends Model
{
    //线路模型
    protected $table='busesroute';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    /**
     * 获取营运线路的车辆
     */
    public function getBuses()
    {
        return $this->hasMany('App\Models\UsersModel\Buses\Buses','busesroute_id');
    }
}
