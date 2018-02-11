<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;


class CheckPermission
{
    /**
     * 自定义中间件
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$model)
    {

        //获取当前用户路由名称
       $routeName = Route::currentRouteName();
        $permission = '';
        //用switch获取链接对应的权限
        switch ($routeName) {
            case $model.'.index':
            case $model.'.ajaxIndex':
                $permission = config('admin.permissions.'.$model.'.list','');
                break;

            case $model.'.create':
            case $model.'.store':
                $permission = config('admin.permissions.'.$model.'.add','');
                break;

            case $model.'.edit':
            case $model.'.update':
                $permission = config('admin.permissions.'.$model.'.edit','');
                break;
            case $model.'.show':
                $permission = config('admin.permissions.'.$model.'.show','');
                break;
            default:
                $permission = config('admin.permissions.'.$model,'');
                break;
        }
        //
        if (!$request->user()->can($permission)) {
            abort(500,trans('admin/errors.permissions'));
        }
        return $next($request);
    }
}
