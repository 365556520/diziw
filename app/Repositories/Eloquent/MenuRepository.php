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
use Illuminate\Support\Facades\Cache;


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
    /*查出菜单并排序子菜单*/
    public function  sortMenuSetCahche(){
        //从查出菜单数据得到数组
        $menus = $this->model->orderBy('sort','desc')->get()->toArray();
        if ($menus){
            //得到菜单的层级关系
            $menusList = $this->sortMenus($menus);
            //对子菜单进行排序
            foreach ($menusList as $key => &$v){
                if($v['child']){
                    //提取子菜单的sort的所有列
                    $sort = array_column($v['child'],'sort');
                    //array_multisort是php的排序方法
                    array_multisort($sort,$v['child'],SORT_DESC);
                }
            }
            //添加到redios缓存
            Cache::forever(config('admin.globals.cache.menusList'),$menusList);
           return $menusList;
        }
        return '';
    }
    /*得到成品的排过序的子菜单和菜单*/
    public function getMenuList(){
        //判断是否有缓存如果有缓存直接从缓存里拿数据
        if(Cache::has(config('admin.globals.cache.menusList'))){
            return Cache::get(config('admin.globals.cache.menusList'));
        }
        return $this->sortMenuSetCahche();
    }
}