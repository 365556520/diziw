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

    /*添加文章*/
    public function createArticle($formData){
        $img =[];
        //把文章中的图片提取出来
        $imgs = $this->get_images_from_html($formData['content']);
        if($imgs != null){
            foreach ($imgs as $k => $v){
                //判断图片地址是否是本地的如果不是可能不是图片
                if(stripos($v,"diziw.cn/backend/images/articleImages")!== false){
                    $img[$k] = $v;
                }
            }
        }
        //把图片名字以字符串行式存到数组
        $formData['thumb']= $this->getImgArr($img);
        $result = $this->model->create($formData);
        if ($result) {
            flash('文章添加成功','success');
        }else{
            flash('文章添加失败','error');
        }
        return $result;
    }
    /*删除文章
    参数 1、$thumb图片的名称
         2、文章的id
    */
    public function destroyArticles($thumb,$id){
        //删除图片
        $this->getImg($thumb);
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
    // 修改文章视图数据
    public function editView($id)
    {
        //得到修改的数据
        $articlesEdit = $this->find($id);
        $img = array_filter(explode("/", $articlesEdit->thumb)); //得到图片名字存到数组中
        $imgs = [];
        //图片加上路径
        foreach ($img as $v){
            array_push($imgs,'backend/images/articleImages/'.$v);
        }
        $articlesEdit->thumb=$imgs;
        if ($articlesEdit) {
            return $articlesEdit;
        }
        abort(404);
    }
    // 修改文章
    public function updateArticles($attributes,$id)
    {    // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($attributes['id'] != $id) {
            abort(500,trans('admin/errors.user_error'));
        }
        $img =[];
        //提取出文章图片
        $imgs = $this->get_images_from_html($attributes['content']);
        if($imgs != null){
            foreach ($imgs as $k => $v){
                //取出上传的图片
                if(stripos($v,"diziw.cn/backend/images/articleImages")!== false){
                    $img[$k] = $v;
                }
            }
        }
        $attributes['thumb'] = $this->getImgArr($img);
        $result = $this->update($attributes,$id);
        if ($result) {
            flash('文章修改成功','success');
        }else{
            flash('文章修改失败', 'error');
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