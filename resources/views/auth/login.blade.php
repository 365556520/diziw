@extends('layouts.auth')

@section('content')
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>后台系统登录</h1>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            {{--帐号密码和ciook--}}
                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                                <input type="username" id="username" class="form-control has-feedback-left"  placeholder="username" required name="username" value="{{ old('username') }}">
                                <span class="fa fa-user form-control-feedback left" ></span>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" id="password" class="form-control has-feedback-left"  placeholder="Password"  name="password" >
                                <span class="fa fa-lock form-control-feedback left" ></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12  checkbox">
                                <label class="left">
                                    <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <button class="btn btn-default submit" type="submit" >Login</button>
                            <a class="reset_pass" href="{{ route('password.request') }}">
                                Lost your password?
                            </a>
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
