@extends('layouts.auth')
@section('content')
    <div class="row login_wrapper">
        <div class="col-md-12 col-sm-12 col-xs-12 animate form login_form">
            <div class="x_panel" >
                <div class="x_title">
                    <h2>用户注册</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row login_content">
                    <form id="demo-form2" method="POST" action="{{ route('register') }}" class="form-horizontal form-label-left" >
                        {{ csrf_field() }}
                        {{--用户名--}}
                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input  id="name" type="text" class="form-control has-feedback-left"  name="name" value="{{ old('name') }}"  placeholder="name" required autofocus>
                                <span class="fa fa-user form-control-feedback left" ></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username" type="text" class="form-control has-feedback-left" name="username" value="{{ old('username') }}" placeholder="userid" required  >
                                <span class="fa fa-user-secret form-control-feedback left" ></span>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control has-feedback-left" name="email" value="{{ old('email') }}"  placeholder="Email" required  >
                                <span class="fa fa-envelope form-control-feedback left" ></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                               <input id="password" type="password" class="form-control has-feedback-left" name="password"  placeholder="Password" required>
                                <span class="fa fa-lock form-control-feedback left" ></span>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                 <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback">
                                <input id="password-confirm" type="password" class="form-control has-feedback-left"  placeholder="Confirm Password"  name="password_confirmation" required>
                                <span class="fa fa fa-unlock-alt form-control-feedback left" ></span>
                            </div>


                                <div class="col-md-6 col-sm-6 col-xs-6 {{ $errors->has('captcha') ? ' has-error' : '' }} ">
                                    <input type="text" id="captcha" class="form-control "  placeholder="captcha"  name="captcha" >
                                    @if ($errors->has('captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <img src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()">
                                </div>

                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
