<?php

namespace App\Models\UsersModel\Articles;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class Articles extends Model
{
    //文章模型
    protected $table='articles';
    //这个表的路由的前缀
    private $action =  'articles';
    protected $fillable = [
        'id',
        'title',
        'tag',
        'description',
        'thumb',
        'view',
        'level',
        'state',
        'category_id',
        'user_id',
        'content',
    ];
    //获取文章作者
    public function getUser(){
        //反向关联
        return $this->belongsTo('App\User','user_id');
    }
    //获取文章评论
    public function getComments(){
        return $this->hasMany('App\Models\UsersModel\Articles\Comments', 'topic_id');
    }
}
