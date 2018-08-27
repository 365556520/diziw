@extends('layouts.admin')
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
    <style>
        .layui-form-label{
            padding: 9px 9px;
        }
    </style>
@endsection
@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>班车<small>班车管理页面</small></h2>
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
                                <li class="layui-this">班车列表</li>
                                <li>添加班车</li>
                            </ul>
                            {{--班车列表--}}
                            <div class="layui-tab-content" >
                                @include('flash::message')
                                <div class="layui-tab-item layui-show">
                                    <table id="datatable-responsive" class="table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>车号</th>
                                            <th>车型</th>
                                            <th>核载</th>
                                            <th>车辆审验时间</th>
                                            <th> 保险期限</th>
                                            <th>车主</th>
                                            <th> 随车电话</th>
                                            <th> 发车时间</th>
                                            <th> 返回时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                {{--添加班车--}}
                                <div class="layui-tab-item">
                                    <form class="layui-form layui-form-pane" method="post" action="{{url('admin/buses')}}">
                                        {{csrf_field()}}
                                        <div class="layui-form-item">
                                                {{--车牌号--}}
                                                <div class="layui-inline">
                                                    <label class="layui-form-label" style=" padding: 9px 3px;">车牌号</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="buses_name" lay-verify="required" placeholder="请输入车牌号" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                                {{--车型--}}
                                                <div class="layui-inline">
                                                    <label class="layui-form-label">车型</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="buses_type" lay-verify="required" placeholder="请输入车型" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                                {{--核载--}}
                                                <div class="layui-inline">
                                                    <label class="layui-form-label">核载</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="buses_sit" lay-verify="required" placeholder="请输入核载人数" autocomplete="off" class="layui-input" style="width: 67%">
                                                    </div>
                                                </div>
                                        </div>
                                        <div  class="layui-form-item">
                                            {{--保险期限--}}
                                            <div class="layui-inline">
                                                <label class="layui-form-label" style=" padding: 9px 3px;">保险期限</label>
                                                <div class="layui-input-block">
                                                    <input type="text" name="buses_insurance_date" lay-verify="required"  placeholder="请输入保险期限" autocomplete="off" class="layui-input">
                                                </div>
                                            </div>
                                            {{--保险期限--}}
                                            <div class="layui-inline">
                                                <label class="layui-form-label" style="padding:9px 2px;">车辆审验时间</label>
                                                <div class="layui-input-block">
                                                    <input type="text" name="buses_approve_date" lay-verify="required"  placeholder="请输入车辆审验时间" autocomplete="off" class="layui-input" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <div class="layui-inline">
                                                <label class="layui-form-label">发车时间</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="buses_start_date" lay-verify="required" autocomplete="off" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-inline">
                                                <label class="layui-form-label">返回时间</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="buses_end_date" lay-verify="required" autocomplete="off" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">往返时间填写格式例如时间多的用,号隔开（发车时间;6:20,12:10返回时间:9:10,5:20）</div>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <div class="layui-inline">
                                                <label class="layui-form-label">车主</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="buses_boss" lay-verify="required" autocomplete="off" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-inline">
                                                <label class="layui-form-label">车主电话</label>
                                                <div class="layui-input-inline" style="width:300px;">
                                                    <input type="text" name="buses_phone" lay-verify="required" autocomplete="off" class="layui-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <div class="layui-inline">
                                                <label class="layui-form-label">驾驶员</label>
                                                <div class="layui-input-inline">
                                                    <select name="buses_driver_id">
                                                        <option value="">选择驾驶员</option>
                                                        @foreach($driver as $d)
                                                            <option value="{{$d->id}}">{{$d->driver_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="layui-inline">
                                                <label class="layui-form-label">营运线路</label>
                                                <div class="layui-input-inline">
                                                    <select name="busesroute_id">
                                                        <option value="">选择营运线路</option>
                                                        @foreach($busesRoute as $routes)
                                                            <option value="{{$routes->id}}">{{$routes->buses_start}}-{{$routes->buses_end}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="demo2">添加班车</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{asset('backend/js/buses/buses-list.js')}}"></script>
    <script>
        $(function () {
            busesList.init();
        });
        layui.use(['element','upload','form'],function(){
            var $ = layui.jquery,
            form = layui.form,
            element = layui.element;//Tab的切换功能，切换事件监听等，需要依赖element模块
        });
    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
