{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title " id="myModalLabel">{{$role->display_name}}<br>
        <small>{{trans('admin/role.model.created_at')}}:{{$role->created_at}}</small>
    </h4>
</div>
<div class="modal-body ">
    <div class="row ">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >{{trans('admin/role.model.name')}}:{{$role->name}}<br>
        </div>
    </div>
    <div class="row">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >
            {{trans('admin/role.model.description')}}:
            <span class="text-danger">{{$role->description}}</span>
        </div>
    </div>
</div>
<div class="modal-footer">
        <small class="text-success">
            {{trans('admin/role.model.updated_at')}}:{{$role->updated_at}}
        </small>
</div>

