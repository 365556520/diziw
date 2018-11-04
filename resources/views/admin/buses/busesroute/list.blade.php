@extends('admin.layouts.bootstrapcontent')
@section('title')
    <title>{{ trans('admin/user.title')}}</title>
@endsection
@section('css')
    {{--layui-v2.2.5--}}
    <link href="{{ asset('/backend/myvebdors/layui-v2.2.5/layui/css/layui.css')}}" rel="stylesheet">
    {{--datatables 插件--}}
    <link href="{{asset('backend/vendors/DataTables-1.10.15/media/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    {{--bootstrap-tagsinput 插件 输入框带标签--}}
    <link href="{{asset('backend/myvebdors/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}" rel="stylesheet">
    {{--导出excel插件cs--}}
    <link href="{{asset('backend/vendors/DataTables-1.10.15/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet">
    {{--导出excel插件csend--}}
    <!--或者下载到本地，下面有下载地址-->
@endsection
@section('content')
    <div class="">
        <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>班车线路<small>班车线路管理页面</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                            <ul class="layui-tab-title">
                                <li class="layui-this">班车线路列表</li>
                                <li>添加班车线路</li>
                            </ul>
                            {{--班车线路列表--}}
                            <div class="layui-tab-content" >
                                @include('flash::message')
                                <div class="layui-tab-item layui-show">
                                    <table id="datatable-responsive" class="table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>起点</th>
                                            <th>途径</th>
                                            <th>终点</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                {{--添加班车线路--}}
                                <div class="layui-tab-item">
                                    <form class="layui-form " method="post" action="{{url('admin/busesroute')}}">
                                        {{csrf_field()}}
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">起点</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="buses_start"  required="required" autocomplete="off" placeholder=""class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">途经</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="buses_midway" value="" data-role="tagsinput" >
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">终点</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="buses_end"  required="required" autocomplete="off" placeholder=""class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="demo2">添加班车线路</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('js')
    {{--layui-v2.2.5--}}
    <script src="{{asset('/backend/myvebdors/layui-v2.2.5/layui/layui.js')}}"></script>
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
    {{--bootstrap-tagsinput 插件 输入框带标签js--}}
    <script src="{{asset('backend/myvebdors/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
    {{--导入自己js--}}
    <script src="{{asset('backend/js/buses/busesroute-list.js')}}"></script>
    <script>
        $(function () {
            busesrouteList.init();
        });
        layui.use('element', function(){
            var $ = layui.jquery
                ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        });

    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
