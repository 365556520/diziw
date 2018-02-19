{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title " id="myModalLabel">{{trans('admin/user.model.name')}}:{{$user->name}} {{trans('admin/user.model.username')}}:<span class="text">{{$user->username}}</span><br>
        <small>{{trans('admin/user.model.created_at')}}:{{$user->created_at}}</small>
    </h4>
</div>
<div class="modal-body ">
    <div class="row">
        <div class="control-label col-md-12 col-sm-12 col-xs-12 " >
            <h4>{{trans('admin/user.role')}}:</h4>
            <div class="panel-group" id="accordion">
                @foreach($user->role as $value)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#{{$value->id}}">
                                     <span class="text-danger">{{$value->display_name}}</span>
                                </a>
                            </h4>
                        </div>
                        <div id="{{$value->id}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                {{trans('admin/user.permission')}}:<br>
                                @foreach($value->permission as $v)
                                    {{$v->display_name}}→<small class="text-danger">{{$v->description}}</small><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
        <small class="text-success">
            {{trans('admin/user.model.updated_at')}}:{{$user->updated_at}}
        </small>
</div>

