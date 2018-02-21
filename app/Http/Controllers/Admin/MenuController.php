<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Repositories\Eloquent\Admin\MenuRepository;
use App\Http\Controllers\Controller;

class MenuController extends Controller{
    private $menu;
    public function __construct(MenuRepository $menuRepository){
        //添加自定义的权限限制中间件
             $this->middleware('check.permission:permission');
            $this->menu = $menuRepository;
    }

    public function index(){
        //查出顶级菜单
        $menu = $this->menu->findByField('parent_id',0);
        //按照层级关系得到所有菜单
        $menuList = $this->menu->getMenuList();
        //进入的时候刷新缓存
        $this->menu->sortMenuSetCache();
        return view('admin.menu.list')->with(compact('menu','menuList'));
    }
    /*添加菜单
     * */
    public function store(MenuRequest $request){
        $request = $this->menu->create($request->all());
        // 刷新缓存
        $this->menu->sortMenuSetCache();
        if($request){
            flash(trans('admin/alert.menu.create_success'),'success');
        }else{
            flash(trans('admin/alert.menu.create_error'), 'error');
        }
        return redirect('admin/menu');
    }
    /*修改菜单*/
    public function edit($id){
        $menu = $this->menu->editMenu($id);
        return response()->json($menu);
    }

    /**
     * 修改菜单数据
     */
    public function update(MenuRequest $request)
    {
        $this->menu->updateMenu($request);
        return redirect('admin/menu');
    }

    /**
     * 删除菜单
     */
    public function destroy($id){
        $this->menu->destroyMenu($id);
        return redirect('admin/menu');
    }
}
