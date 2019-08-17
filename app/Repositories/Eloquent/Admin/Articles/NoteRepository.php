<?php
namespace App\Repositories\Eloquent\Admin\Articles;

use App\Models\UsersModel\Articles\Note;
use App\Repositories\Eloquent\Repository;
use Mews\Purifier\Facades\Purifier;


/**
 * 仓库模式继承抽象类
 */
class NoteRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return Note::class;
    }

    /*权限表显示数据*/
    public function ajaxIndex($data){
        //得到模型
        $comments = $this->model;
        $length = $data['limit']; //查询得条数
        $start = $data['page'] -1;//查询的页数 开始查询数据从0开始所以要减去1
        if ($start!=0){
            $start = $start*$length; //得到查询的开始的id
        }
        $count = $comments->count();//查出所有数据的条数
        $commentss = $comments->offset($start)->limit($length)->get();//得到分页数据
     //   $commentss = $this->getTreeOne($commentss,'to_uid','to_uid','from_uid','');
        // datatables固定的返回格式
        return [
            'code' => 0,
            'msg' => '',//消息
            'count' => $count,//总条数
            'data' => $commentss,//数据
        ];
    }


    /*添加备忘录*/
    public function createNote($formData){
        //防止xxs攻击过滤
        $formData['content'] = Purifier::clean($formData['content'],array('Attr.EnableID' => true));
        $result = $this->model->create($formData);
        if ($result) {
            flash('评论添加成功','success');
        }else{
            flash('评论添加失败','error');
        }
        return $result;
    }
    /*删除备忘录*/
    public function destroyNote($id){
        //删除备忘录
        $result =  $this->delete($id);
        if ($result) {
            flash('删除成功','success');
        } else {
            flash('删除失败','error');
        }
        return $result;
    }


    // 修改备忘录视图数据
    public function editView($id)
    {
        $result = $this->find($id);
        if ($result) {
            return $result;
        }
        abort(404);
    }
    // 修改备忘录
    public function updateNote($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        //防止xxs攻击过滤
        $attributes['content'] =Purifier::clean($attributes['content']);
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('修改成功','success');
        }else{
            flash('修改失败', 'error');
        }
        return $result;
    }

    //api
    //获取某月的备忘录date_format(datetime,'%Y-%m-%d')
    public function getMonthNote($date){
        $result = $this->model->select('title as price','content as data','created_at as date')->whereDate('created_at',$date)->get();
        return $result;
    }

}