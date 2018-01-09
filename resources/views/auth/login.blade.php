@extends('layouts.auth')

@section('content')
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>后台系统登录</h1>
                            <div class="row">
                                <div class="row form-group">
                                    {{--帐号密码和ciook--}}
                                    <div class="col-md-12 col-sm-12 col-xs-12  has-feedback ">
                                        <input type="text" id="username" class="form-control has-feedback-left {{ $errors->has('username') ? ' has-error' : '' }}"  placeholder="username" required name="username" value="{{ old('username') }}">
                                        <span class="fa fa-user form-control-feedback left" ></span>
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12  has-feedback ">
                                    <input type="password" id="password" class="form-control has-feedback-left {{ $errors->has('password') ? ' has-error' : '' }}"  placeholder="Password"  name="password" >
                                    <span class="fa fa-lock form-control-feedback left" ></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-6 col-xs-7 ">
                                    <input type="text" id="captcha" class="form-control {{ $errors->has('captcha') ? ' has-error' : '' }}"  placeholder="captcha"  name="captcha" >
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <img src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()">
                                </div>
                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12  checkbox">
                                    <label class="left">
                                        <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        <br>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <button class="btn btn-default submit" type="submit" >Login</button>
                                    <a class="reset_pass" href="{{ route('password.request') }}">
                                        Lost your password?
                                    </a>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">New to site?
                                <a class="to_register" href="{{ route('register') }}">Create Account</a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

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

@endsection
