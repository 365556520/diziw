<?php
namespace App\Repositories\Eloquent\Admin\Goods;


use App\Models\UsersModel\Goods\Goods;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Storage;


/**
 * 仓库模式继承抽象类
 */
class GoodsRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return Goods::class;
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
        if($data['goodscategorys_id'] != null){
            $articless = $articles->where('goodscategorys_id',$data['goodscategorys_id'])->offset($start)->limit($length)->get();//得到分页数据
            $count = $articles->where('goodscategorys_id',$data['goodscategorys_id'])->count();//查出所有数据的条数
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

    /*添加商品*/
    public function createGoods($formData){
        $result = $this->model->create($formData);
        if ($result) {
            flash('商品添加成功','success');
        }else{
            flash('商品添加失败','error');
        }
        return $result;
    }
    /*删除商品
    */
    public function destroyGoods($id){
       //删除数据库数据
        $result = $this->delete($id);
        if ($result) {
            flash('删除成功','success');
        } else {
            flash('删除失败','error');
        }
    }
    //得到图片删除图片
    public function getImg($thumb){
        $result =  false;
        $thumbs = '';
        if(is_array($thumb)){
            $thumbs = implode($thumb); //把图片数组转换成字符串
        } else {
            $thumbs =  $thumb;
        }
       $imgs = array_filter(explode("/", $thumbs));//以/为分割符转换为数组    array_filter去掉数组中值为空的
       foreach ($imgs as $v){
           $result =  $this->deImg($v);
       }
       return $result;
    }
    // 修改商品视图数据
    public function editView($id)
    {
        //得到修改的数据
        $articlesEdit = $this->find($id);
        if ($articlesEdit) {
            return $articlesEdit;
        }
        abort(404);
    }
    // 修改商品信息
    public function updateGoods($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('商品信息修改成功','success');
        }else{
            flash('商品信息修改失败', 'error');
        }
        return $result;
    }
    //修改文章审核
    public function setState($state,$id){
        $result = $this->update($state,$id);
        return $result;
    }
    //删除服务器图片
    public function deImg($img){
        return Storage::delete('backend/images/articleImages/'.$img);
    }
    //获取图片名字，并转换成字符串
    public function getImgArr($imgs){
        $img ='';
        foreach ($imgs as $v){
            $img .= strrchr($v,'/'); //获取图片名字
        }
        //把图片名字以字符串行式存到数组
        return $img;
    }
    /**
     * 提取文章内容的图片
     * @param $content
     * @return null
     *  从HTML文本中提取所有图片
     */
    function get_images_from_html($content)
    {
        $pattern = "/<img.*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, htmlspecialchars_decode($content), $match);
        if (!empty($match[1])) {
            return $match[1];
        }
        return null;
    }
}