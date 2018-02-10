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
        $start = request('start',config('admin.globals.list.start'));
        // 每页显示数目
        $length = request('length',config('admin.globals.list.length'));
        // 排序
        $order['name'] = request('columns')[request('order')[0]['column']]['name']; //获取排序那一列name
        $order['dir'] = request('order')[0]['dir']; //按什么排序
        //得到permission模型
        $permission = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、display_name列
                $permission = $permission->where('name', 'like', "%{$search['value']}%")->orWhere('display_name','like', "%{$search['value']}%");
            }else{
                //精确查找name、display_name列
                $permission = $permission->where('name', $search['value'])->orWhere('display_name', $search['value']);
            }
        }
        $count = $permission->count();//查出所有数据的条数
        $permission = $permission->orderBy($order['name'],$order['dir']);//数据排序
        $permissions = $permission->offset($start)->limit($length)->get();//得到分页数据
        if($permissions){
            foreach ($permissions as $v){
                //这里需要传入2个权限第一个修改权限第二个删除权限第三个是查看权限
                $v->actionButton = $v->getActionButtont(config('admin.permissions.permission.show'),config('admin.permissions.permission.edit'),config('admin.permissions.permission.delete'));
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $permissions,
        ];

    }
// 修改权限视图数据
    public function editView($id)
    {
        $permission = $this->find($id);
        if ($permission) {
            return $permission;
        }
        abort(404);
    }
    // 修改权限数据
    public function updatePermission($attributes,$id)
    {
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('修改权限成功');
        }else{
            flash('修改权限失败','error');
        }
        return $result;
    }
    /*删除权限*/
    public function destroyPermission($id)
    {
        $result = $this->delete($id);
        if ($result) {
            flash('删除权限成功');
        } else {
            flash('删除权限失败', 'error');
        }
        return $result;
    }
}