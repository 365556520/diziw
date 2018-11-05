<?php
namespace App\Repositories\Eloquent\Admin\Articles;

use App\Models\UsersModel\Articles\Categorys;
use App\Repositories\Eloquent\Repository;


/**
 * 仓库模式继承抽象类
 */
class CategorysRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return Categorys::class;
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
        $buses = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、id列
                $buses = $buses->where('buses_name', 'like', "%{$search['value']}%")->orWhere('buses_boss','like', "%{$search['value']}%");
            }else{
                //精确查找name、id列
                $buses = $buses->where('buses_name', $search['value'])->orWhere('buses_boss', $search['value']);
            }
        }
        $count = $buses->count();//查出所有数据的条数
        $buses = $buses->orderBy($order['name'],$order['dir']);//数据排序
        $busess = $buses->offset($start)->limit($length)->get();//得到分页数据
        foreach ($busess as $v){
            $v->password;
        }
        $userPermissions =  $this->getUserPermissions('buses'); //获取当前用户对该表的权限
        if($busess){
            foreach ($busess as $v){
                //这里需要传入2个权限第一个修改权限 第二个删除权限 第三个是查看权限
                $v->actionButton = $v->getActionButtont($userPermissions['show'],$userPermissions['edit'],$userPermissions['delete'],false);
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $busess,
        ];
    }

    /*添加班车*/
    public function createBuses($formData){
        $result = $this->model->create($formData);
        if ($result) {
            flash('班车添加成功','success');
        }else{
            flash('班车添加失败','error');
        }
        return $result;
    }
    /*删除班车线路*/
    public function destroyBusesRoute($id){
        $result = $this->delete($id);
        if ($result) {
            flash('删除成功','success');
        } else {
            flash('删除失败','error');
        }
        return $result;
    }

    // 修改班车线路视图数据
    public function editView($id)
    {
        $result = $this->find($id);
        if ($result) {
            return $result;
        }
        abort(404);
    }
    // 修改班车
    public function updateBusesRoute($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('班线修改成功','success');
        }else{
            flash('班线修改失败', 'error');
        }
        return $result;
    }
}