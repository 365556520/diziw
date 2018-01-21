<?php
namespace App\Repositories\Eloquent;
/**
 * Created by
 * User: 小强
 * Date: 2018/1/19
 * Time: 15:55
 * 说明：
 */
use App\Models\Menu;
use App\Repositories\Eloquent\Repository;

class  MenuRepository extends Repository{
    public function model(){
        return Menu::class;
    }
    /*递归菜单层级关系*/
    public function sortMenus($menus,$pid = 0){
        $arr = [];
        if (empty($menus)){
            return '';
        }
        foreach ($menus as  $key => $v){
            if($v['parent_id'] == $pid ){
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortMenus($menus,$v['id']);
            }
        }
        return $arr;
    }
}