<?php

namespace App;

use App\Traits\ActionButtonTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\RestPassword as RestPasswordNotification;  //修改密码自定义邮箱
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    use EntrustUserTrait; //entrust权限扩展

    //通过Traits获取查看删除修改按钮
    use ActionButtonTrait;
    //这个表的路由的前缀
    private $action =  'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','provider_id','provider',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //自定义修改密码邮件
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RestPasswordNotification($token));
    }
    /**
     * 获得与用户关联的个人信息。
     */
    public function getUserData()
    {
        return $this->hasOne('App\Models\UsersModel\User_Data');
    }
}
