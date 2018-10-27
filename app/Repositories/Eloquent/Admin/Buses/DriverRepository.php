<?php
namespace App\Repositories\Eloquent\Admin\Buses;

use App\Models\UsersModel\Buses\Driver;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Storage;

/**
 * 仓库模式继承抽象类
 * 驾驶员仓库
 */
class DriverRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return Driver::class;
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
        $driver = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、驾驶证号列
                $driver = $driver->where('driver_card', 'like', "%{$search['value']}%")->orWhere('driver_name','like', "%{$search['value']}%");
            }else{
                //精确查找name、驾驶证号列
                $driver = $driver->where('driver_card', $search['value'])->orWhere('driver_name', $search['value']);
            }
        }
        $count = $driver->count();//查出所有数据的条数
        $driver = $driver->orderBy($order['name'],$order['dir']);//数据排序
        $drivers = $driver->offset($start)->limit($length)->get();//得到分页数据
        foreach ($drivers as $v){
            $v->password;
        }
        $userPermissions =  $this->getUserPermissions('permission'); //获取当前用户对该表的权限
        if($drivers){
            foreach ($drivers as $v){
                //这里需要传入2个权限第一个修改权限 第二个删除权限 第三个是查看权限
                $v->actionButton = $v->getActionButtont($userPermissions['show'],$userPermissions['edit'],$userPermissions['delete'],false);
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $drivers,
        ];
    }
    /*添加驾驶员*/
    public function createDriver($formData){
        $result = $this->model->create($formData);
        if ($result) {
            flash('驾驶员添加成功','success');
        }else{
            flash('驾驶员添加失败','error');
        }
        return $result;
    }
    /*删除驾驶员*/
    public function destroyDriver($id){
       $result = false;
       if ($this->deletephoto($id)){
            $result = $this->delete($id);
       }
        if ($result) {
            flash('删除成功','success');
        } else {
            flash('删除失败','error');
        }
       return $result;
    }
    /*删除图片*/
    public function deletephoto($id){
        $result = $this->find($id);
        $driver_photo = true;
        if(!empty($result->driver_photo)){
            $driver_photo = strrchr($result->driver_photo,'/');
            //删除视频图片
            $driver_photo = Storage::delete(config('admin.globals.img.driver_photo').$driver_photo);
        }
        return $driver_photo;
    }
    // 修改驾驶员视图数据
    public function editView($id)
    {
        $result = $this->find($id);
        if ($result) {
            return $result;
        }
        abort(404);
    }
    // 修改驾驶员数据
    public function updateDriver($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('驾驶员信息修改成功','success');
        }else{
            flash('驾驶员信息修改失败', 'error');
        }
        return $result;
    }
}