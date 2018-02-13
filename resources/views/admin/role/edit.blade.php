{{--<!-- 添加全选模态框（Modal） -->--}}
{{--下拉菜单--}}
<link href="{{ asset('/backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
{{--下拉菜单js--}}
<script src="{{ asset('/backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('admin/permission.edit')}}</h4>
</div>
<form id="demo-form2" class="form-horizontal form-label-left"  action="{{url('admin/role',[$role->id])}}" method="post" >
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$role->id}}">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{trans('admin/role.model.name')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" name="name" class="form-control col-md-7 col-xs-12" value="{{$role->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{trans('admin/role.model.display_name')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="display_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$role->display_name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('admin/role.model.permission')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_multiple form-control" name="permission[]" multiple="multiple" size="4">
                    <option value="0">超级管理员</option>
                    @foreach($permission as $v)
                        <option value="{{$v->id}}">{{$v->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('admin/role.model.description')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea cols="30" rows="10" class="form-control col-md-7 col-xs-12" type="text" name="description">{{$role->description}}</textarea>
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

            maximumSelectionLength: 8,
            placeholder: "最多能添加8个",
            allowClear: true
        });
        var v = [];
        /*把权限数组遍历到js数据中*/
        @foreach($role->permission as $k =>$v)
            v['{{$k}}'] = '{{$v}}';
        @endforeach
        /*添加下拉列表所有的值*/
        $('.select2_multiple').val(v).trigger('change');//这个就是select2的赋值方式。而val里的就是opt;


    });
</script>


