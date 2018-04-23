<?php
namespace App\Repositories\Eloquent\Admin;

use App\Models\VideoModel\VideoClass;
use App\Repositories\Eloquent\Repository;


/**
 * 仓库模式继承抽象类
 */
class VideoClassRepository extends Repository {
    //重写父类的抽象方法
    public function model(){
        return VideoClass::class;
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
        $vidos = $this->model;
        // datatables是否启用模糊搜索
        $search['regex'] = request('search')['regex'];
        // 搜索框中的值
        $search['value'] = request('search')['value'];
        // 搜索框中的值
        if ($search['value']) {
            if($search['regex'] == 'true'){
                //模糊查找name、id列
                $vidos = $vidos->where('id', 'like', "%{$search['value']}%")->orWhere('title','like', "%{$search['value']}%");
            }else{
                //精确查找name、id列
                $vidos = $vidos->where('id', $search['value'])->orWhere('title', $search['value']);
            }
        }
        $count = $vidos->count();//查出所有数据的条数
        $vidos = $vidos->orderBy($order['name'],$order['dir']);//获取表格数据并且排过序
        $vidoss = $vidos->offset($start)->limit($length)->get();//得到分页数据
        if($vidoss){
            foreach ($vidoss as $v){
                $v->videomun = $v->getVideo()->count();//获取视频的个数并且添加上（这是用关联查询然后直接传给新增的这个属性）
                    //这里需要传入2个权限第一个修改权限第二个删除权限第三个是查看权限
                $v->actionButton = $v->getActionButtont(config('admin.permissions.video.show'),config('admin.permissions.video.edit'),config('admin.permissions.video.delete'),false);
            }
        }
        // datatables固定的返回格式
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $vidoss,
        ];
    }

    /*上传图片*/
    public function upload(){

    }
    /*添加视频*/
    public function createVideoClass($formData){
       // 添加到视频类表
        $result = $this->model->create([
            'title' => $formData['title'],
            'introduce' => $formData['introduce'],
            'preview' => $formData['preview'],
            'iscommend' => array_key_exists('iscommend',$formData['like'])?1:0,
            'ishot' => array_key_exists('ishot',$formData['like'])?1:0,
            'click' => $formData['click'],
        ]);
        //添加关联的视频表
        $videos = json_decode($formData['videos'],true);
        foreach ($videos as $v){
            $v['videoclass_id'] = $result->id;
            $result->getVideo()->create($v);
        }
        if ($result) {
            flash('添加成功','success');
        }else{
            flash('添加失败','error');
        }
        return $result;
    }
}