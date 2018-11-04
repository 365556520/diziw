<?php

namespace App\Http\Controllers;


use App\Facades\CosFacade;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserInterface; //引入自定义服务
use App\Repositories\Eloquent\Admin\UserRepository as UserPepo; //仓库模式引入因为和门面名字相同重复了所以as UserPepo起一个别名
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
        return view('admin.layouts.nav');
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

        /*判断用户是否有权限登录后台*/
/*        if(Auth::user()->can(config('admin.permissions.system.login'))){// 如果有后台权限就登录到后台
            return view('admin.home.index');
        }else{ // 创建用户个人 token api
            return '大爷你有不是管理员瞎搞个啥的这里是home路由在 App\Http\Controllers这里';
        }*/
    }
}
