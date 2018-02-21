<?php
namespace App\Repositories\Eloquent\Admin;
/**
 * Created by
 * User: 小强
 * Date: 2018/1/19
 * Time: 15:55
 * 说明：
 */
use App\Models\Permission;
use App\Models\Permission_Role;
use App\Models\Role;
use App\Repositories\Eloquent\Repository;



class  RoleRepository extends Repository{
    public function model(){
        return Role::class;
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
        $role = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、display_name列
                $role = $role->where('name', 'like', "%{$search['value']}%")->orWhere('display_name','like', "%{$search['value']}%");
            }else{
                //精确查找name、display_name列
                $role = $role->where('name', $search['value'])->orWhere('display_name', $search['value']);
            }
        }
        $count = $role->count();//查出所有数据的条数
        $role = $role->orderBy($order['name'],$order['dir']);//数据排序
        $roles = $role->offset($start)->limit($length)->get();//得到分页数据
        if($roles){
            foreach ($roles as $v){
                //这里需要传入2个权限第一个修改权限第二个删除权限第三个是查看权限
                $v->actionButton = $v->getActionButtont(config('admin.permissions.role.show'),config('admin.permissions.role.edit'),config('admin.permissions.role.delete'));
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $roles,
        ];

    }
    //获取权限
    public function getAllPermissionList(){
        return Permission::all();
    }
    //添加角色
    public function createRole($attributes){

        $role = $this->model->create($attributes);
        if ($role){
            if (isset($attributes['permission'])) {
                /*添加权限*/
                $role->perms()->sync($attributes['permission']);
            }else{
                $role->perms()->sync([]);
            }
            flash(trans('admin/alert.role.create_success'),'success');
        }else{
            flash(trans('admin/alert.role.create_error'), 'error');
        }
        return $role;
    }
    //删除角色
    public function destroyRole($id){
        //删除排除超级管理员
        $this->isRoleAdmin($id);
        $result = $this->delete($id);
        if ($result) {
            flash(trans('admin/alert.role.destroy_success'),'success');
        } else {
            flash(trans('admin/alert.role.destroy_error'), 'error');
        }
        return $result;
    }
    // 修改权限视图数据
    public function editView($id)
    {
        $role = $this->find($id);
        //根据id获取角色所有权限
        $role['permission'] = $this->getRolePermission($id);
        if ($role) {
            return $role;
        }
        abort(404);
    }
    // 修改角色的权限数据
    public function updateRole($attributes,$id){
        //修改排除超级管理员
        $this->isRoleAdmin($id);
        // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.role_error'));
        }
        $result = $this->update($attributes,$id);
        if ($result) {
            /*获取角色*/
            $role =  Role::where('id',$id)->first();

            if (isset($attributes['permission'])) {
                /*添加权限*/
                $role->perms()->sync($attributes['permission']);
            }else{
                $role->perms()->sync([]);
            }
            flash(trans('admin/alert.role.edit_success'),'success');
        } else {
            flash(trans('admin/alert.role.edit_error'), 'error');
        }
        return $result;
    }
    /*获取角色数据*/
    public function getRole($id){
        $role = $this->model->find($id);
        //根据id获取角色所有权限
        $rolePermission =  $this->getRolePermission($id);
        $role['permission'] = Permission::whereIn('id',$rolePermission)->get();
        return $role;
    }
    //获取角色权限
    public function getRolePermission($id){
        return Permission_Role::where('role_id',$id)->pluck('permission_id');
    }
    /*管理员获取全部权限*/
    public function upadmin($name='name',$admin='admin'){
        $role = Role::where($name,$admin)->first();
        if ($role){
            /*获取所有权限返回数组然后用array_column提取数组中id这列*/
          $role->perms()->sync(array_column($this->getAllPermissionList()->toArray(),'id'));
        }
    }
    /*超级管理员拦截*/
    public function isRoleAdmin($id){
        //超级管理不能修改数据
        if ($this->model->where('id',$id)->first()->is_admin()){
            abort(500,trans('admin/errors.role_error'));
        }
    }
}