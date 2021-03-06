<?php

namespace App\Models\UsersModel\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsOrder extends Model
{
    //模型
    protected $table='goodsorder';
    //这个表的路由的前缀
    private $action =  'goodsorder';
    protected $fillable = [
        'user_id',
        'goods_id',
        'remark',
        'buycount',
        'state',
        'totalprices',
    ];
    //获取商品
    public function getGoods(){
        //反向关联
        return $this->belongsTo('App\Models\UsersModel\Goods\Goods','goods_id');
    }
}
