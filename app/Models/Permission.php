<?php

namespace App\Models;

use App\Traits\ActionButtonTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'permission';
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
}
