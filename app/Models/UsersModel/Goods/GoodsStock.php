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

}
