<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\Repository;
use App\User;

/**
 * 仓库模式继承抽象类
 */
class UserRepository extends Repository {
    public function model()
    {
        return User::class;
    }
    //重写findBy
    public function findBy($id)
    {
        return $this->model->where('id',$id)->first()->toArray();
    }
}