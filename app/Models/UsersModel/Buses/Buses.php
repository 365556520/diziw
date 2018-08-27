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
    //这个表的路由的前缀
    private $action =  'buses';
    protected $fillable = [
        'buses_name',
        'busesroute_id',
        'buses_type',
        'buses_sit',
        'buses_approve_date',
        'buses_insurance_date',
        'buses_driver_id',
        'buses_boss',
        'buses_phone',
        'buses_start_date',
        'buses_end_date',
    ];
    //获取驾驶员
    public function getDriver()
    {
        return $this->belongsTo('App\Models\UsersModel\Buses\Driver', 'buses_driver_id');
    }
}
