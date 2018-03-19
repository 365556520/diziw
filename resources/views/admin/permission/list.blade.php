@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/permission.title')}}</title>
@endsection
@section('css')
    {{--datatables 插件--}}
    <link href="{{asset('backend/vendors/DataTables-1.10.15/media/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    {{--导出excel插件cs--}}
    <link href="{{asset('backend/vendors/DataTables-1.10.15/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet">
    {{--导出excel插件csend--}}
    <!--或者下载到本地，下面有下载地址-->
@endsection
@section('content')
    <div class="">
        <div class="page-title">

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ trans('admin/permission.desc')}} <small>{{trans('admin/permission.action.createDescription')}}</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                           <li>
                               @permission(config('admin.permissions.permission.add'))
                                <div class="title">
                                    <div class="col-md-12 col-sm-12 col-xs-12  pull-left top_search">
                                        <a class="btn btn-round btn-warning" data-toggle="modal" data-target="#createModal" href="{{url('admin/permission/create')}}">
                                            {!!trans('admin/permission.action.create')!!}
                                        </a>
                                    </div>
                                </div>
                               @endpermission
                           </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @include('flash::message')
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{trans('admin/permission.model.id')}}</th>
                                <th>{{trans('admin/permission.model.name')}}</th>
                                <th>{{trans('admin/permission.model.display_name')}}</th>
                                <th>{{trans('admin/permission.model.description')}}</th>
                                <th>{{trans('admin/permission.model.operate')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--添加模态框--}}
    <div class="modal inmodal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                {{--内容在show.balde中--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    {{--修改模态框--}}
    <div class="modal inmodal" id="eidtModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                {{--内容在edit.balde中--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    {{--查看模态框--}}
    <div class="modal inmodal" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                {{--内容在show.balde中--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('js')
    {{--datatables 插件--}}
    <script src="{{asset('backend/vendors/DataTables-1.10.15/media/js/jquery.dataTables.min.js')}}"></script>
    {{--导出excel插件js--}}
    <script src="{{asset('backend/vendors/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/vendors/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/js/permission/jszip.min.js')}}"></script>
    {{--导出excel插件jsend--}}
    {{--打印 js--}}
    <script src="{{asset('backend/vendors/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js')}}"></script>
    {{--打印 jsend--}}
    <script src="{{asset('backend/js/permission/permission-list.js')}}"></script>
    {{--提示代码--}}
    @include('component.errorsLayer')
    <script >
        $(function () {
            PermissionList.init();
        });
    </script>
@endsection
