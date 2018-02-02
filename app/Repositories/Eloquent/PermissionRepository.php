<?php
namespace App\Repositories\Eloquent;
/**
 * Created by
 * User: 小强
 * Date: 2018/1/19
 * Time: 15:55
 * 说明：
 */
use App\Models\Permission;
use App\Repositories\Eloquent\Repository;



class  PermissionRepository extends Repository{
    public function model(){
        return Permission::class;
    }
    /*添加全选*/
    public function createPermission($attributes)
    {
      $result = $this->create($attributes);
      if ($result){
          flash('权限添加成功', 'success');
      }else{
          flash('权限添加失败', 'error');
      }
      return $result;
    }

}