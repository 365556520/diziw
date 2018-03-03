<?php
namespace App\Repositories\Eloquent\Admin;
use App\Repositories\Eloquent\Repository;
use App\User;

/**
 * 仓库模式继承抽象类
 */
class HomeRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return User::class;
    }
//        上传图片
    public function upimgage($img){
        if(empty($img)){
            flash("上传失败",'error');
            return view('admin.home.userdata');
        }else{
              header('Content-type:text/html;charset=utf-8');
             $base64_image_content = $img['icon'];
            //将base64编码转换为图片保存
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
                $type = $result[2];
                //绝对路径
                $new_file = "".public_path()."/backend/images/uploads/";
                if (!file_exists($new_file)) {
                    //检查是否有该文件夹，如果没有就创建，并给予最高权限
                    mkdir($new_file, 0700);
                }
                $imgname="img".time() . ".{$type}";
                $new_file = $new_file . $imgname;
                //将图片保存到指定的位置
                if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                    flash("上传成功",'success');
                    //保存成功返回这个相对路径和图片名字
                    return '/backend/images/uploads/'.$imgname;
                }else{
                    return 'false';
                }
            }else{
                return 'false';
            }
        }
    }


}