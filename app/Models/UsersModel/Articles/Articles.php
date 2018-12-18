<?php

namespace App\Models\UsersModel\Articles;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonTrait;

class Articles extends Model
{
    //文章模型
    protected $table='articles';
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'articles';
    protected $fillable = [
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
}
