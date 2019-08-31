@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{trans('auth/login.title.admin')}}</title>
@endsection
@section('css')
    {{--登录页面css--}}
    <link href="{{ asset('/backend/css/Auth/login.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="layadmin-user-login-main" style="margin-top: 30px">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
               <div class="layadmin-user-login-box layadmin-user-login-header">
                    <h2>{{trans('auth/login.title.admin')}}</h2>
                    <p>笛子网后台管理系统</p>
                </div>
               <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                        <input type="text" id="config('admin.globals.username')" placeholder="{{trans('auth/login.loginform.username')}}"  name="{{config('admin.globals.username')}}" value="{{ old(config('admin.globals.username')) }}" lay-verify="required"  class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                        <input type="password" name="password" id="password" lay-verify="required" placeholder="{{trans('auth/login.loginform.password')}}"  class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs7">
                                <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                                <input type="text" id="captcha" lay-verify="required"  placeholder="{{trans('auth/login.captcha')}}"  name="captcha" class="layui-input">
                            </div>
                            <div class="layui-col-xs5">
                                <div style="margin-left: 10px;">
                                    <img class="layadmin-user-login-codeimg" src="{{captcha_src('flat')}}" style="cursor: pointer;" onclick="this.src='{{captcha_src('flat')}}'+Math.random()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-bottom: 20px;">
                        <input type="checkbox"  name="remember"  {{ old('remember') ? 'checked' : '' }} lay-skin="primary" title="记住密码">
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><span>{{trans('auth/login.loginform.rememberPassword')}}</span><i class="layui-icon layui-icon-ok"></i></div>
                        <a href="{{ route('password.request') }}"  class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">{{trans('auth/login.loginform.Lost_your_password')}}</a>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="LAY-user-login-submit">{{trans('auth/login.loginform.submit')}}</button>
                    </div>
                    <div class="layui-trans layui-form-item layadmin-user-login-other">
                        <label>社交账号登入</label>
                        <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                        <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                        <a href="{{ route('register') }}" class="layadmin-user-jump-change layadmin-link">{!! trans('auth/login.loginform.createAccount') !!}</a>
                    </div>
               </div>
            </form>
        </div>
        <div>
            {{ $errors->has(config('admin.globals.username')) ? '用户名错误' : '' }}
            {{ $errors->has('password') ? '密码错误' : '' }}
            {{ $errors->has('captcha') ? '验证码错误' : '' }}
        </div>
    </div>
{{--注册密码modal--}}
    <div class="modal inmodal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
            </div>
        </div><!-- /.modal -->
    </div>
{{--忘记密码modal--}}
    <div class="modal inmodal" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
            </div>
        </div><!-- /.modal -->
    </div>
@endsection
@section('js')
    <script>
    {{--找回密码信息--}}
    @if (session('status'))
        layer.msg('{{ session('status') }}',function () {
            // 关闭后这里操作
        });
     @endif
    {{--登录和注册账号信息--}}
    @if (count($errors) > 0)
         layer.msg('@foreach ($errors->all() as $error){{ $error }}<br> @endforeach',function () {
            // 关闭后这里操作
         });
    @endif

    //form提交
    layui.use('form', function(){
        var form = layui.form;

    });



    </script>
@endsection