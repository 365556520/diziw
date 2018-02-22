
    {{--添加模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('auth/login.register.title')}}</h4>
</div>
<form id="demo-form2" class="form-horizontal form-label-left "  method="post" action="{{ route('register') }}">
    {{csrf_field()}}
    <div class="modal-body">
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                <input  id="name" type="text" class="form-control has-feedback-left"  name="name" value="{{ old('name') }}"  placeholder="{{trans('auth/login.register.name')}}" required autofocus>
                <span class="fa fa-user form-control-feedback left" ></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="username" type="text" class="form-control has-feedback-left" name="username" value="{{ old('username') }}" placeholder="{{trans('auth/login.register.username')}}" required  >
                <span class="fa fa-user-secret form-control-feedback left" ></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control has-feedback-left" name="email" value="{{ old('email') }}"  placeholder="{{trans('auth/login.register.email')}}" required  >
                <span class="fa fa-envelope form-control-feedback left" ></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control has-feedback-left" name="password"  placeholder="{{trans('auth/login.register.password')}}" required>
                <span class="fa fa-lock form-control-feedback left" ></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                 <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12  has-feedback">
                <input id="password-confirm" type="password" class="form-control has-feedback-left"  placeholder="{{trans('auth/login.register.confirmPassword')}}"  name="password_confirmation" required>
                <span class="fa fa fa-unlock-alt form-control-feedback left" ></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-6 {{ $errors->has('captcha') ? ' has-error' : '' }} ">
                <input type="text" id="captcha" class="form-control "  placeholder="{{trans('auth/login.captcha')}}"  name="captcha" >
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
    </div>

    <div class="modal-footer">
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">{{trans('auth/login.register.submit')}}</button>
            </div>
        </div>
    </div>
</form>

