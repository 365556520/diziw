<?php

namespace App\Http\Controllers\Api\usersdata;


use App\Models\UsersModel\Buses\BusesRoute;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CommonController;
use DB;

class BusesController extends CommonController
{

    /*
     * 获取该线路所有车辆first 和find都是返回给模型
     * */
    public function getBuses($id){
        $data = BusesRoute::where('id',$id)->first()->getBuses;
        return $this->response($data);
    }

}
