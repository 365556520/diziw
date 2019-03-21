<?php
namespace App\Repositories\Eloquent\Admin\Goods;


use App\Models\UsersModel\Goods\GoodsStock;
use App\Repositories\Eloquent\Repository;


/**
 * 仓库模式继承抽象类
 */
class GoodsStockRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return GoodsStock::class;
    }

    /*显示数据*/
    public function ajaxIndex($data){
        //得到模型
        $goodsstock = $this->model;
        $length = $data['limit']; //查询得条数
        $start = $data['page'] -1;//查询的页数 开始查询数据从0开始所以要减去1
        if ($start!=0){
            $start = $start*$length; //得到查询的开始的id
        }
        $count = $goodsstock->count();//查出所有数据的条数
        $goodsstocks = $goodsstock->with('getGoods:id,goods_name')->offset($start)->limit($length)->get();//得到分页数据
        foreach ($goodsstocks as &$v){ //把名字添加到内容对象里
            $v->goods_name = $v->getGoods->goods_name;
        }
        // datatables固定的返回格式
        return [
            'code' => 0,
            'msg' => '',//消息
            'count' => $count,//总条数
            'data' => $goodsstocks,//数据
        ];
    }


    /*添加商品进货*/
    public function createGoodsStock($formData){
        $result = $this->model->create($formData);
        if ($result) {
            flash('商品进货添加成功','success');
        }else{
            flash('商品进货添加失败','error');
        }
        return $result;
    }
    /*删除商品进货*/
    public function destroyGoodsStock($id){
        $result = $this->delete($id);
        if ($result) {
            flash('删除成功','success');
        } else {
            flash('删除失败','error');
        }
        return $result;
    }

    // 修改商品进货视图数据
    public function editView($id)
    {
        $result = $this->find($id);
        if ($result) {
            return $result;
        }
        abort(404);
    }
    // 修改商品进货
    public function updateGoodsStock($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('修改成功','success');
        }else{
            flash('修改失败', 'error');
        }
        return $result;
    }
}