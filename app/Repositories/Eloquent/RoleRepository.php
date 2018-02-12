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
        $result = $this->create($attributes);
        if ($result){
            flash('角色添加成功', 'success');
        }else{
            flash('角色添加失败', 'error');
        }
        return $result;
    }
    public function destroyRole($id){
        $result = $this->delete($id);
        if ($result) {
            flash('删除角色成功');
        } else {
            flash('删除角色失败', 'error');
        }
        return $result;
    }
    // 修改权限视图数据
    public function editView($id)
    {
        $role = $this->find($id);
        if ($role) {
            return $role;
        }
        abort(404);
    }
    // 修改权限数据
    public function updateRole($attributes,$id)
    {
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('修改角色成功');
        }else{
            flash('修改角色失败','error');
        }
        return $result;
    }

}