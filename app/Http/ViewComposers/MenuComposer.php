<?php
namespace App\Http\ViewComposers;

use App\Repositories\Eloquent\Admin\MenuRepository;
use App\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;


/**
 * 视图共享数据
 * User: 小强
 * 说明：
 */
class MenuComposer{
    /*实现仓库*/
    protected $menu;
    protected $user;
    /*注入仓库*/
    public function __construct(MenuRepository $menu,UserRepository $user){
        $this->menu = $menu;
        $this->user = $user;
    }
    /*绑定数据到所有视图*/
    public function compose(View $view){
        $view->with('sidebarMenus',$this->menu->getMenuList());
        //$view->with('isUserPermissions',$this->user->getPermissions(Auth::user()->id)); //共享所有视图该用户的权限
    }

}