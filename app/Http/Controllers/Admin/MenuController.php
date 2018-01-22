<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Repositories\Eloquent\MenuRepository;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{   private $menu;
    public function __construct(MenuRepository $menuRepository){
            $this->menu = $menuRepository;
    }

    public function index(){
        //查出顶级菜单
        $menu = $this->menu->findByField('parent_id',0);
        //按照层级关系得到所有菜单
        $menuList = $this->menu->getMenuList();
        return view('admin.menu.list')->with(compact('menu','menuList'));
    }
    /*添加菜单
     * */
    public function store(MenuRequest $request){
        $request = $this->menu->create($request->all());
        if($request){
            flash('菜单添加成功')->success();

        }else{
            flash('菜单添加失败')->error();
        }
        return redirect('admin/menu');
    }

}
