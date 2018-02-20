<?php

namespace App\Models;

use App\Traits\ActionButtonTrait;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'role';
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
    //默认超级管理员角色
    public function is_admin(){
        return $this->name == 'admin'?true:false;
    }
}
