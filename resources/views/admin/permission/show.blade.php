{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{trans('admin/permission.show')}}</h4>
</div>
<div class="modal-body">
    <div class="row">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="first-name">{{trans('admin/permission.model.display_name')}}:{{$permission->display_name}}<br>
            <small>{{trans('admin/permission.model.created_at')}}：{{$permission->created_at}}</small>
        </label>
    </div>
    <div class="row">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="first-name">{{trans('admin/permission.model.name')}}:{{$permission->name}}<br>
        </label>
    </div>
    <div class="row">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="first-name">{{trans('admin/permission.model.description')}}:{{$permission->description}}<br>
        </label>
    </div>

<div class="modal-footer">
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-default" data-dismiss="modal" >关闭
            </button>
        </div>
    </div>
</div>

