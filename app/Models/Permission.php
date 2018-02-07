<?php

namespace App\Models;

use App\Traits\ActionButtonTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'permission';
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
}
