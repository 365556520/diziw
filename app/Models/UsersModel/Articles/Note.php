<?php

namespace App\Models\UsersModel\Articles;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{
    //文章模型
    protected $table='note';
    //这个表的路由的前缀
    protected $fillable = [
        'id',
        'title',
        'content',
        'user_id',
        'created_at',
    ];
    //获取作者
    public function getUser(){
        //反向关联
        return $this->belongsTo('App\User','user_id');
    }

}
