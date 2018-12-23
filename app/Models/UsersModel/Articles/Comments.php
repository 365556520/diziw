<?php

namespace App\Models\UsersModel\Articles;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //文章分类模型
    protected $table='comments';
    //这个表的路由的前缀
    private $action =  'comments';
    protected $fillable = [
        'topic_id',
        'topic_type',
        'content',
        'from_uid',
        'to_uid',
    ];
    //得到评论的文章
    public function getArticles(){
        //反向关联
        return $this->belongsTo('App\Models\UsersModel\Articles\Articles','topic_id');
    }
}
