<?php
namespace App\Repositories\Eloquent;
/**
 * 门面模式
 * User: admin
 * Date: 2018/1/14
 * Time: 9:43
 */
use App\User;
use App\Repositories\Contracts\UserInterface;

class UserFacadeRepository implements UserInterface {
    /*根据用户id查找用户信息
    */
    public function findBy($id){
        return User::find($id);
    }
}