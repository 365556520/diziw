<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *guest 中间件，该中间件的用途是登录用户访问该路由会跳转到指定认证后页面，而非登录用户访问才会显示登录页面。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //guest 中间件如果用户登录了就规定登录去向的页面
        if (Auth::guard($guard)->check()) {
            //判断登录用户是否有后台权限没有权限就退出登录
            if(Auth::user()->can(config('admin.permissions.system.login'))){
                return redirect('/admin/home');
            }else{
                // 用户已经登录了...
                Auth::logout();//不是管理员就退出登录
                abort(500,trans('admin/errors.permissions'));
            }
        }
        return $next($request);
    }
}
