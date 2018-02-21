<?php
namespace App\Repositories\Eloquent\Admin;
use App\Models\Role;
use App\Models\Role_User;
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
        $user = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、display_name列
                $user = $user->where('name', 'like', "%{$search['value']}%")->orWhere('username','like', "%{$search['value']}%");
            }else{
                //精确查找name、display_name列
                $user = $user->where('name', $search['value'])->orWhere('username', $search['value']);
            }
        }
        $count = $user->count();//查出所有数据的条数
        $user = $user->orderBy($order['name'],$order['dir']);//数据排序
        $users = $user->offset($start)->limit($length)->get();//得到分页数据
        foreach ($users as $v){
            $v->password;
        }
        if($users){
            foreach ($users as $v){
                //这里需要传入2个权限第一个修改权限第二个删除权限第三个是查看权限
                $v->actionButton = $v->getActionButtont(config('admin.permissions.user.show'),config('admin.permissions.user.edit'),config('admin.permissions.user.delete'));
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $users,
        ];

    }
    /*添加用户*/
    public function createUser($formData){
        $result = $this->model->create([
            'name' => $formData['name'],
            'username' => $formData['username'],
            'email' => $formData['email'],
            'password' => bcrypt($formData['password']),
        ]);
        if ($result) {
            // 角色与用户关系
            if (isset($formData['role'])) {
                $result->roles()->sync($formData['role']);
            }else{
                $result->roles()->sync([]);
            }
            flash(trans('admin/alert.user.create_success'),'success');
        }else{
            flash(trans('admin/alert.user.create_error'),'error');
        }
        return $result;
    }
    /*删除用户*/
    public function destroyUser($id){
        $result = $this->delete($id);
        if ($result) {
            flash(trans('admin/alert.user.destroy_success'),'success');
        } else {
            flash(trans('admin/alert.user.destroy_error'),'error');
        }
        return $result;
    }
    // 修改角色的权限数据
    public function updateUser($attributes,$id){
        // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        //更新这个角色的数据
        $result = $this->update($attributes,$id);
        if ($result) {
            // 更新用户角色关系
            $user = User::where('id',$id)->first();
            if (isset($attributes['role'])) {
                $user->roles()->sync($attributes['role']);
            }else{
                $user->roles()->sync([]);
            }
            flash(trans('admin/alert.role.edit_success'),'success');
        } else {
            flash(trans('admin/alert.role.edit_error'), 'error');
        }
        return $result;
    }

    /*获取用户所有信息*/
    public function getUser($id){
       $user =  $this->model->where('id',$id)->first();
       if ($user){
           $user['role'] = Role::whereIn('id',$this->getRole($id))->get();
       }
       return $user;
    }
    /*得到用户角色*/
    public function getRole($id){
        return Role_User::where('user_id',$id)->pluck('role_id');
    }
}