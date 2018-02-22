

{{--添加模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('auth/login.email.title')}}</h4>
</div>
<form id="demo-form2" class="form-horizontal form-label-left "  method="post" action="{{ route('password.email') }}">
    {{csrf_field()}}
    <div class="modal-body">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{trans('auth/login.email.email')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-6  has-feedback">
                <input id="email" type="email" class="form-control has-feedback-left" name="email" value="{{ old('email') }}"  placeholder="{{trans('auth/login.email.email')}}" required>
                <span class="fa fa-envelope form-control-feedback left" ></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">{{trans('auth/login.email.submit')}}</button>
            </div>
        </div>
    </div>
</form>



