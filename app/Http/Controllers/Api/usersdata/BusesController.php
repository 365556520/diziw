<?php

namespace App\Http\Controllers\Api\usersdata;


use App\Models\UsersModel\Buses\BusesRoute;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CommonController;
use DB;

class BusesController extends CommonController
{
    /*
     * 获取所有开始站点和终点（包括途径）
     * */
    public function getBusesRouteall(){
        $data =  BusesRoute::get();
        $newdata = [];
        foreach ($data as $k=>$v){
            $newdata['buses_start'][$k] = $v->buses_start;
            $newdata['buses_midway'][$k] = $v->buses_midway;
            $newdata['buses_end'][$k] = $v->buses_end;
        }
        //去出重复的始发地（array_unique去出数组中重复）
        $newdata['buses_start'] = array_unique($newdata['buses_start']);
        //终点和途经合并去重 (array_filter()去除数组中的空，用implode把路径数组转换成以点分割的字符串，然后在用explode以点分割转换成数组最后用array_merge把2个数组合并)
        $newdata['buses_end'] = array_filter(array_unique(array_merge($newdata['buses_end'],explode(",", implode(",", $newdata['buses_midway'])))));
        return $this->response($newdata);
    }
    /*
     * 获取该线路所有车辆first 和find都是返回给模型
     * */
    public function getBuses($id){
        $data = BusesRoute::where('id',$id)->first()->getBuses;
        return $this->response($data);
    }
    /*
     * 起点和终点查出线路id
     * */
    public function getBusesRouteId(){
        $buses_start = '西峡' ;
        $buses_end = '西坪';
        $data = BusesRoute::whereRaw('buses_start =? and buses_end = ?',[$buses_start,$buses_end])->first();
        return $this->response($data);
    }
}
