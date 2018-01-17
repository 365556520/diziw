<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserInterface; //引入自定义服务
use UserRepository;//引入门面
use App\Repositories\Eloquent\UserRepository as UserPepo; //仓库模式引入因为和门面名字相同重复了所以as UserPepo起一个别名
class HomeController extends Controller
{   private $user;
    private $userPepo;
    //服务把接口进行依赖注入
    public function __construct(UserInterface $user,UserPepo $userPepo){
        $this->user = $user;
        $this->userPepo = $userPepo;
        $this->middleware('auth');
    }
    public function index(){
/*//        判断当前用户有没有管理权限
        dd(auth()->user()->hasRole('admin'));
//        判断用户是否有相应的权限
        dd(auth()->user()->can('create users'));
//      匹配模式
        dd(auth()->user()->can('*users'));
//        多个权限判断
//        判断只有一个通过就返回真
       dd(auth()->user()->can(['edit users', 'create users']));
//        判断两个都通过就返回真 在后面加true
        dd(auth()->user()->can(['edit users', 'create users'], true));
//            多个角色判断
//        判断只有一个通过就返回真
         dd(auth()->user()->hasRole(['admin', 'user']));
//        判断两个都通过就返回真 在后面加true
        dd(auth()->user()->hasRole(['admin', 'user'], true));
//        判断角色有多少权限
        dd( auth()->user()->ability(array('admin', 'user'), array('edit users', 'create users')));
//        还可以这样写能列出哪些角色有哪些权限
        dd( auth()->user()->ability(array('admin', 'user'), array('edit users', 'create users'),[
            'validate_all' => true,
             'return_type'  =>  'both'
        ]));*/
       //服务使用这里用实现类里面的那个方法
//        dd($this->user->findBy(2)->toArray());
//        使用门面
//        dd(UserRepository::findBy(1)->toArray());
        //仓库模式使用
//       dd($this->userPepo->findBy(1));
        return view('admin.home.index');
    }
}
