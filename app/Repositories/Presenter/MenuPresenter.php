<?php
namespace App\Repositories\Presenter;
/**
 * Presenter 模式辅助 View
 * User: 小强
 * Date: 2018/1/20
 * Time: 16:14
 * 说明：
 */
class MenuPresenter {
//   添加菜单下拉列表渲染
    public function getMenu($menus){
        if ($menus){
            $option = '<option value="0">顶级</option>';
            foreach ($menus as $v) {
                $option .=   '<option value="'.$v->id.'">'.$v->name.'</option>';
            }
            return $option;
        }
        return '<option value="0">顶级</option>';
    }
    //得到菜单列表
    public function getMenuList($menus){
        if($menus){
            $item ='';
            foreach ($menus as $v){
                $item .= $this->getNestableItem($v['id'],$v['name'],$v['child']);
            }
            return $item;
        }
        return '暂无菜单';
    }

    /**
     * 返回菜单HTML代码
     * @author 晚黎
     * @date   2016-08-10
     */
    protected function getNestableItem($id,$name,$child)
    {//            判断是否有子集
        if ($child) {
            return $this->getHandleList($id,$name,$child);
        }
        return '<li class="dd-item dd3-item" data-id="'.$id.'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content"> '.$name.' </div></li>';
    }
    /**
     * 得到有子集菜单
     * @author 晚黎
     * @date   2016-08-10
     */
    protected function getHandleList($id,$name,$child)
    {   //这是父级
        $handle = '<li class="dd-item dd3-item" data-id="'.$id.'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content"> '.$name.' </div><ol class="dd-list">';
        //遍历子集调用了上面的方法
        foreach ($child as $v) {
            $handle .= $this->getNestableItem($v['id'],$v['name'],$v['child']);
        }
        $handle .= '</ol></li>';
        return $handle;
    }

}