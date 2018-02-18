
<!-- 添加全选模态框（Modal） -->
{{--下拉菜单--}}
<link href="{{ asset('/backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
{{--下拉菜单js--}}
<script src="{{ asset('/backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('admin/user.edit')}}</h4>
</div>
<form id="demo-form2" class="form-horizontal form-label-left"  action="{{url('admin/user',[$user->id])}}" method="post" >
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="modal-body">

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{trans('admin/user.model.name')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" name="name" class="form-control col-md-7 col-xs-12" value="{{$user->name}}"       placeholder="{{trans('admin/user.model.name')}}" >
            </div>
            @if ($errors->has('name'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{trans('admin/user.model.username')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="username" required="required" value="{{$user->username}}" placeholder="{{trans('admin/user.model.username')}}"  class="form-control col-md-7 col-xs-12">
            </div>
            @if ($errors->has('username'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('admin/user.model.email')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input cols="30" rows="10" class="form-control col-md-7 col-xs-12" type="email" name="email"  value="{{$user->email}}" placeholder="{{trans('admin/user.model.email')}}">
            </div>
            @if ($errors->has('email'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('admin/user.role')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_multiple form-control" name="role" multiple="multiple" size="4">
                    @foreach($role as $v)
                        <option value="{{$v->id}}">{{$v->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="submit" class="btn btn-success">{{trans('admin/role.edit')}}</button>
            </div>
        </div>
    </div>
</form>
<script>
    /*   下拉菜单*/
    $(document).ready(function() {
        $(".select2_multiple").select2({
            maximumSelectionLength: 5,
            placeholder: "最多能添加5个角色",
            allowClear: true
        });
        var v = [];
        /*把权限数组遍历到js数据中*/
        @foreach($user->role as $k =>$v)
            v['{{$k}}'] = '{{$v["id"]}}';
        @endforeach
        /*添加下拉列表所有的值*/
        $('.select2_multiple').val(v).trigger('change');//这个就是select2的赋值方式。而val里的就是opt;
    });
</script>

