@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/user.title')}}</title>
@endsection
@section('css')
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
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>驾驶员<small>驾驶员管理页面</small></h2>
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
                                <li class="layui-this">驾驶员列表</li>
                                <li>添加驾驶员</li>
                            </ul>
                            {{--驾驶员列表--}}
                            <div class="layui-tab-content" >
                                @include('flash::message')
                                <div class="layui-tab-item layui-show">
                                    <table id="datatable-responsive" class="table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>驾驶员</th>
                                            <th>年龄</th>
                                            <th>准驾车型</th>
                                            <th>驾驶证档案号</th>
                                            <th>驾驶证号</th>
                                            <th>从业资格证号</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                {{--添加驾驶员--}}
                                <div class="layui-tab-item">
                                    <form class="layui-form " method="post" action="{{url('admin/driver')}}">
                                        {{csrf_field()}}
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">姓名</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="username" lay-verify="required" placeholder="请输入驾驶员姓名" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">年龄</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="username" lay-verify="required" placeholder="请输入年龄" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">单选框</label>
                                                    <div class="layui-input-block">
                                                        <input type="radio" name="sex" value="男" title="男" checked="">
                                                        <input type="radio" name="sex" value="女" title="女">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row" >
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                <div class="layui-upload-drag" id="upload">
                                                    <div id="uptitle">
                                                        <i class="layui-icon"></i>
                                                        <p>上传驾驶员头像</p>
                                                        <p>点击或将图片拖拽到此处</p>
                                                    </div>
                                                    <img class="layui-upload-img  img-responsive col-md-4 col-sm-4 col-xs-8 " alt="" id="demo1"/>
                                                    <input type="hidden" name="preview"  id="uploadimg" value="0">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="demo2">添加驾驶员</button>
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
    {{--bootstrap-tagsinput 插件 输入框带标签js--}}
    <script src="{{asset('backend/myvebdors/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
    {{--导入自己js--}}
    <script src="{{asset('backend/js/buses/driver-list.js')}}"></script>
    <script>
        $(function () {
            driverList.init();
        });
        layui.use(['element','upload','form'],function(){
            var $ = layui.jquery,
            form = layui.form,
            element = layui.element,//Tab的切换功能，切换事件监听等，需要依赖element模块
            upload = layui.upload;
            //拖拽上传
            upload.render({
                elem: '#upload'
                ,url: '/upload/'
                ,done: function(res){
                    console.log(res)
                }
            });
        });
    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
