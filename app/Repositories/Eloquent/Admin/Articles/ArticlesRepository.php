<?php
namespace App\Repositories\Eloquent\Admin\Articles;

use App\Models\UsersModel\Articles\Articles;
use App\Repositories\Eloquent\Repository;


/**
 * 仓库模式继承抽象类
 */
class ArticlesRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return Articles::class;
    }

    /*权限表显示数据*/
    public function ajaxIndex($data){
        //得到模型
        $articles = $this->model;
        $length = $data['limit']; //查询得条数
        $start = $data['page'] -1;//查询的页数 开始查询数据从0开始所以要减去1
        if ($start!=0){
            $start = $start*$length; //得到查询的开始的id
        }
        if($data['category_id'] != null){
            $articless = $articles->where('category_id',$data['category_id'])->offset($start)->limit($length)->get();//得到分页数据
            $count = $articles->where('category_id',$data['category_id'])->count();//查出所有数据的条数
        }else{
            $articless = $articles->offset($start)->limit($length)->get();//得到全部数据
            $count = $articles->count();//查出所有数据的条数
        }
        // datatables固定的返回格式
        return [
            'code' => 0,
            'msg' => '',//消息
            'count' => $count,//总条数
            'data' => $articless,//数据
        ];
    }
    /*添加班车*/
    public function createArticle($formData){
        $img ='';
        foreach ($formData['thumb'] as $v){
            $img .= strrchr($v,'/'); //获取图片名字
        }
        //把图片名字以字符串行式存到数组
        $formData['thumb']= $img;
        $result = $this->model->create($formData);
        if ($result) {
            flash('文章添加成功','success');
        }else{
            flash('文章添加失败','error');
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