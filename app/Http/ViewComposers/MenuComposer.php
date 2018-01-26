<?php
namespace App\Http\ViewComposers;
use App\Repositories\Eloquent\MenuRepository;
use Illuminate\Contracts\View\View;


/**
 * 视图共享数据
 * User: 小强
 * 说明：
 */
class MenuComposer{
    /*实现仓库*/
    protected $menu;
    /*注入仓库*/
    public function __construct(MenuRepository $menu){
        $this->menu = $menu;
    }
    /*绑定数据到所有视图*/
    public function compose(View $view){
        $view->with('sidebarMenus',$this->menu->getMenuList());
    }
}