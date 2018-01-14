<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserInterface; //引入自定义服务
class HomeController extends Controller
{
    private $user;
    //把接口进行依赖注入
    public function __construct(UserInterface $user)
    {   $this->user = $user;
        $this->middleware('auth');
    }
    public function index()
    {
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
       //这里用实现类里面的那个方法
        dd($this->user->findBy(2)->toArray());
        return view('home');
    }
}
