{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title " id="myModalLabel">{{$permission->display_name}}<br>
        <small>{{trans('admin/permission.model.created_at')}}:{{$permission->created_at}}</small>
    </h4>
</div>
<div class="modal-body ">
    <div class="row ">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >{{trans('admin/permission.model.name')}}:{{$permission->name}}<br>
        </div>
    </div>
    <div class="row">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >
            {{trans('admin/permission.model.description')}}:
            <span class="text-danger">{{$permission->description}}</span>
        </div>
    </div>
</div>
<div class="modal-footer">
        <small class="text-success">
            {{trans('admin/permission.model.updated_at')}}:{{$permission->updated_at}}
        </small>
</div>

