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
}