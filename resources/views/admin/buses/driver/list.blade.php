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
    <style>
        .layui-form-label{
            padding: 9px 9px;
        }
    </style>
@endsection
@section('content')
    <div class="">
        <br>
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
                                    <form class="layui-form layui-form-pane" method="post" action="{{url('admin/driver')}}">
                                        {{csrf_field()}}
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md8">
                                                <div class="layui-row">
                                                    {{--姓名--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">姓名</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_name" lay-verify="required" placeholder="请输入驾驶员姓名" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--电话--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">联系电话</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_phone" lay-verify="required|phone|number" placeholder="请输入联系电话" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="layui-row">
                                                    {{--年龄--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">年龄</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_age" lay-verify="required|number" placeholder="请输入年龄" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--性别--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">性别</label>
                                                            <div class="layui-input-block">
                                                                <input type="radio" name="driver_sex" value="男" title="男" checked="">
                                                                <input type="radio" name="driver_sex" value="女" title="女">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="layui-row">
                                                    {{--驾驶证号--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">驾驶证号</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_card" lay-verify="required|identity" placeholder="请输入驾驶证号" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--初领日期--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">初领日期</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_card_firstdata" lay-verify="required" placeholder="请输入初领日期" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                {{--上传图片--}}
                                                <div class="layui-row" >
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md12" style="margin-left: 15% ;">
                                                        <div class="layui-upload-drag" id="upload">
                                                            <div id="uptitle">
                                                                <i class="layui-icon"></i>
                                                                <p>上传驾驶员头像</p>
                                                                <p>点击或将图片拖拽到此处</p>
                                                            </div>
                                                            <img class="layui-upload-img  img-responsive col-md-4 col-sm-4 col-xs-8 " alt="" id="demo1"/>
                                                            <input type="hidden" name="driver_photo"  id="uploadimg" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                {{--驾驶证档案号--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style=" padding: 9px 3px;">驾驶证档案号</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_archive_number" lay-verify="required" placeholder="请输入证档案号" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md3">
                                                {{--准驾车型--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">准驾车型</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_permit" lay-verify="required" placeholder="准驾车型" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md5">
                                                {{--驾驶证审验有效时间--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style="width: 150px;padding:9px 2px;">驾驶证审验有效时间</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_card_date" lay-verify="required" placeholder="请输入驾驶证审验有效时间" autocomplete="off" class="layui-input" style="width: 67%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                {{--从业资格证号--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style=" padding: 9px 3px;">从业资格证号</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_qualification" lay-verify="required" placeholder="请输入从业资格证号" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                {{--从业资格证号--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style="width: 150px;padding:9px 2px;">资格证审验有效时间</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_qualification_date" lay-verify="required" placeholder="请输入资格证审验有效时间" autocomplete="off" class="layui-input" style="width: 67%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
                                                <div class="layui-form-item layui-form-text">
                                                    <label class="layui-form-label">驾驶信息</label>
                                                    <div class="layui-input-block">
                                                        <textarea placeholder="驾驶信息" name="driver_info" class="layui-textarea"></textarea>
                                                    </div>
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
                elem: '#upload',
                url: 'driver/upload',
                data: {'_token':'{{csrf_token()}}'},
                before: function(obj){
                    layer.load(); //上传loading
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#uptitle').hide();
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                },
                done: function(res){
                    layer.closeAll('loading'); //关闭loading
                    //status=0代表上传成功
                    if(res.status == 0){
                        $('#uploadimg').attr('value',res.path); //把连接放到隐藏输入框中
                        $('#demo1').attr('value',res.path); //把连接放到隐藏输入框中
                        layer.msg(res.message, {icon: 6});   //do something （比如将res返回的图片链接保存到表单的隐藏域）
                    }else {
                        layer.msg(res.message, {icon: 5});
                    }
                },
                error: function(index, upload){
                    layer.closeAll('loading'); //关闭loading
                }
            });
        });
    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
