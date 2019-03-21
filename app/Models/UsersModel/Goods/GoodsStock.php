<?php

namespace App\Models\UsersModel\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsStock extends Model
{
    //模型
    protected $table='goodsstock';
    //这个表的路由的前缀
    private $action =  'goodsstock';
    protected $fillable = [
        'user_id',
        'goods_id',
        'remark',
        'count',
        'type',
        'price',
    ];
    //获取商品
    public function getGoods(){
        //反向关联
        return $this->belongsTo('App\Models\UsersModel\Goods\Goods','goods_id');
    }
}
