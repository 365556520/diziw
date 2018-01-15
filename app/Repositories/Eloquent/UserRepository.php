<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\Repository;
use App\User;

/**
 * 仓库模式继承抽象类
 */
class UserRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return User::class;
    }
    //重写接口findBy
    public function findBy($id){
        return $this->model->where('id',$id)->first()->toArray();
    }
}