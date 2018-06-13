<?php

namespace App\Models\UsersModel\Buses;

use Illuminate\Database\Eloquent\Model;

class BusesRoute extends Model
{
    //线路模型
    protected $table='busesroute';
    /**
     * 获取营运线路的车辆
     */
    public function getBuses()
    {
        return $this->hasMany('App\Models\UsersModel\Buses\Buses','busesroute_id');
    }
}
