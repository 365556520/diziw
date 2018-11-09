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
    public function ajaxIndex($data){
        //得到permission模型
        $categorys = $this->model;
        $length = $data['limit']; //查询得条数
        $start = $data['page'] -1;//查询的页数 开始查询数据从0开始所以要减去1
        if ($start!=0){
            $start = $start*$length; //得到查询的开始的id
        }
        $count = $categorys->count();//查出所有数据的条数
        $categoryss = $categorys->offset($start)->limit($length)->get();//得到分页数据
        $categoryss = $this->getTree($categoryss,'cate_name','id','cate_pid',0);
        // datatables固定的返回格式
        return [
            'code' => 0,
            'msg' => '',//消息
            'count' => $count,//总条数
            'data' => $categoryss,//数据
        ];
    }
    //获取所有的分类树形结构
    public function getCategorysTree(){
        //根据 cate_order排序
        $categorys =  $this->model->orderBy('cate_order','asc')->get();
        $categorys = $this->getTree($categorys,'cate_name','id','cate_pid',0);
        return $categorys;
    }
    //这个类处理树型列表参数说明：$date数据，$field_id父数据表头名,$field_pid子数据表头名，$pid父数据中的pid的值
    public function getTree($date,$field_name,$field_id='id',$field_pid='pid',$pid=0){
        $arr = array();
        //遍历数据
        foreach ($date as $k=>$v){
            if($v->$field_pid==$pid) {
                $date[$k]["_".$field_name] =  $date[$k][$field_name];
                //如果该数据的cate_pid=0也就是总栏目的时候就把该数据添加在$arr[]
                $arr[] = $date[$k];
                //然后从新遍历数据
                foreach ($date as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $date[$m]["_".$field_name] ='├─ '.$date[$m][$field_name];
                        //如果该数据的cate_pid=cate_id也就是子栏目cate_pid等于总栏目的cate_id的时候就把该数据添加在$arr[]
                        $arr[] = $date[$m];
                    }
                }
            }
        }
        return $arr;
    }
    //得到分两类列表
    public function getCategorysTreeArry(){
       $categorys = $this->getCategorysTree();

    }
    //得到的分类这个只能迭代2层分类
    public function getCategorysList(){
        $arr = array();
        $date = $this->model->orderBy('cate_order','asc')->get();
        //遍历数据
        foreach ($date as $k => $v){
            $arr[$k]['id'] = $v->id;
            $arr[$k]['cate_name'] = $v->cate_name;
            if($v->cate_pid == 0){
                $arr[$k]['children'] = $this->getCategorysList($v->id);
            }
        }
        return $arr;
    }
    public function getChildren($id){
        $arr = array();
        $date = $this->model->where('cate_pid','id')->orderBy('cate_order','asc')->get();
        //遍历数据
        foreach ($date as $k => $v){
            $arr[$k]['id'] = $v->id;
            $arr[$k]['cate_name'] = $v->cate_name;
        }
        return $arr;
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