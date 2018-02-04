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
    /*权限表显示数据*/
    public function ajaxIndex(){

        // datatables请求次数
        $draw = request('draw', 1);
        // 开始条数
        $start = request('start', config('admin.globals.list.start'));
        // 每页显示数目
        $length = request('length', config('admin.globals.list.length'));

        // 排序
        $order['name'] = request('columns')[request('order')[0]['column']]['name']; //获取排序那一列name
        $order['dir'] = request('order')[0]['dir']; //按什么排序


        $permission = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                $permission = $permission->where('name', 'like', "%{$search['value']}%")->orWhere('display_name','like', "%{$search['value']}%");
            }else{
                $permission = $permission->where('name', $search['value'])->orWhere('display_name', $search['value']);
            }
        }

        $count = $permission->count();

        $permission = $permission->orderBy($order['name'],$order['dir']);

        $permissions = $permission->offset($start)->limit($length)->get();
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $permissions,
        ];

    }

}