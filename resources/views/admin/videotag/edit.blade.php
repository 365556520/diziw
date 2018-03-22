

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('admin/permission.edit')}}</h4>
</div>
<form id="demo-form2" class="form-horizontal form-label-left"  action="{{url('admin/videotag',[$videotag->id])}}" method="post" >
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$videotag->id}}">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">视频标签名<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" name="name" class="form-control col-md-7 col-xs-12" value="{{$videotag->name}}">
            </div>
        </div>

    <div class="modal-footer">
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="submit" class="btn btn-success">确认修改</button>
            </div>
        </div>
    </div>
</form>


