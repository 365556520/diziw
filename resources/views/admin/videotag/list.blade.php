@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/user.title')}}</title>
@endsection
@section('css')
    {{--layui-v2.2.5--}}
    <link href="{{ asset('/backend/myvebdors/layui-v2.2.5/layui/css/layui.css')}}" rel="stylesheet">
    {{--datatables 插件--}}
    <link href="{{asset('backend/vendors/DataTables-1.10.15/media/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!--或者下载到本地，下面有下载地址-->
@endsection
@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>视频标签管理<small>视频标签管理页面</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="layui-form layui-form-pane" method="post" action="{{url('admin/videotag')}}">
                            {{csrf_field()}}
                            <div class="layui-form-item">
                                <label class="layui-form-label">视频标签</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name"  required="required" autocomplete="off" placeholder="请输入视频标签" class="layui-input">
                                </div>
                                <div class="layui-inline">
                                    <button class="layui-btn" lay-submit="" lay-filter="demo2">添加标签</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                            {{--视频标签列表--}}
                                @include('flash::message')
                                <div>
                                    <table id="datatable-responsive" class="table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>标签</th>
                                            <th>操作</th>
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
            </div>
        </div>
    </div>
    {{--修改模态框--}}
    <div class="modal inmodal" id="eidtModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                {{--内容在edit.balde中--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('js')
    {{--layui-v2.2.5--}}
    <script src="{{asset('/backend/myvebdors/layui-v2.2.5/layui/layui.js')}}"></script>
    {{--datatables 插件--}}
    <script src="{{asset('backend/vendors/DataTables-1.10.15/media/js/jquery.dataTables.min.js')}}"></script>
    {{--导入自己js--}}
    <script src="{{asset('backend/js/videotag/videotag-list.js')}}"></script>
    <script>
        $(function () {
            videotagList.init();
        });
        layui.use('element', function(){
            var $ = layui.jquery
                ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        });
    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
