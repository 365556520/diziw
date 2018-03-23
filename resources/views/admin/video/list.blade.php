@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/user.title')}}</title>
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
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>视频管理<small>视频管理页面</small></h2>
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
                                <li class="layui-this">视频管理</li>
                                <li>添加视频</li>
                            </ul>
                            {{--视频标签列表--}}
                            <div class="layui-tab-content" >
                                @include('flash::message')
                                <div class="layui-tab-item layui-show">
                                    视频列表
                                </div>
                                {{--添加视频标签--}}
                                <div class="layui-tab-item">


                                    <form class="layui-form layui-form-pane" method="post" action="{{url('admin/videotag')}}">
                                        {{csrf_field()}}
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">视频名称</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="name"  required="required" autocomplete="off" placeholder="请输入视频标签" class="layui-input">
                                            </div>
                                        </div>

                                        <div class="layui-upload-drag" id="upload">
                                            <div id="uptitle">
                                                <i class="layui-icon"></i>
                                                <p>点击或将图片拖拽到此处上传</p>
                                            </div>
                                            <img class="layui-upload-img  img-responsive col-md-4 col-sm-4 col-xs-8 " alt="" id="demo1">
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">视频状态</label>
                                            <div class="layui-input-block">
                                                <input type="checkbox" name="like[write]" title="推荐">
                                                <input type="checkbox" name="like[read]" title="热门" checked="">
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">点击数</label>
                                            <div class="layui-input-block">
                                                <input type="text"  required="required" autocomplete="off" placeholder="请输入视频标签" class="layui-input">
                                            </div>
                                        </div>

                                        <div class="layui-form-item layui-form-text">
                                            <label class="layui-form-label">视频介绍</label>
                                            <div class="layui-input-block">
                                                <textarea placeholder="请输入内容" class="layui-textarea"></textarea>
                                            </div>
                                        </div>



                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="demo2">添加标签</button>
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
    {{--导入自己js--}}
    <script src="{{asset('backend/js/videotag/videotag-list.js')}}"></script>
    <script>

        layui.use(['element','upload','form'], function(){
            var form = layui.form
            var $ = layui.jquery
            ,element = layui.element //Tab的切换功能，切换事件监听等，需要依赖element模块
            ,upload = layui.upload //上传初始

            //拖拽上传
            upload.render({
                elem: '#upload'
                ,url: '/upload/'
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#uptitle').hide();
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    console.log(res)
                }
            });
        });

    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
