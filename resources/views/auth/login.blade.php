@extends('layouts.auth')
@section('title')
    <title>{{trans('auth/login.title.admin')}}</title>
@endsection
@section('content')
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                {{--找回密码信息--}}
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                {{--登录和注册账号信息--}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <section class="login_content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>{{trans('auth/login.title.admin')}}</h1>

                            <div class="form-group">
                                {{--帐号密码和ciook--}}
                                <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has(config('admin.globals.username')) ? ' has-error' : '' }}">
                                    <input type="text" id="config('admin.globals.username')" class="form-control has-feedback-left "  placeholder="{{trans('auth/login.loginform.username')}}" required name="{{config('admin.globals.username')}}" value="{{ old(config('admin.globals.username')) }}">
                                    <span class="fa fa-user form-control-feedback left" ></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" id="password" class="form-control has-feedback-left "  placeholder="{{trans('auth/login.loginform.password')}}"  name="password" >
                                    <span class="fa fa-lock form-control-feedback left" ></span>

                                </div>
                            </div>

                        <div class="form-group ">
                            <div class="col-md-7 col-sm-7 col-xs-7 {{ $errors->has('captcha') ? ' has-error' : '' }} ">
                                <input type="text" id="captcha" class="form-control "  placeholder="{{trans('auth/login.captcha')}}"  name="captcha" >

                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <img src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12  checkbox">
                                <label class="pull-left">
                                    <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> {{trans('auth/login.loginform.rememberPassword')}}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <button class="btn btn-dar btn-sm submit" type="submit" >{{trans('auth/login.loginform.submit')}}</button>
                                <a class="reset_pass" data-toggle="modal" data-target="#resetModal" href="{{ route('password.request') }}">
                                    {{trans('auth/login.loginform.Lost_your_password')}}
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">
                                <a class="to_register"  data-toggle="modal" data-target="#registerModal" href="{{ route('register') }}"> {!! trans('auth/login.loginform.createAccount') !!}</a>
                            </p>

                            <div class="clearfix"></div>
                            <br/>

                            <div>
                                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
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
