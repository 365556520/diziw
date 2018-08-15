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
                                <li><a href="{{ url('/admin/driver')}}">驾驶员列表</a></li>
                                <li  class="layui-this">修改驾驶员</li>
                            </ul>
                            {{--驾驶员列表--}}
                            <div class="layui-tab-content" >
                                @include('flash::message')
                                <div class="layui-tab-item">
                                </div>
                                {{--添加驾驶员--}}
                                <div class="layui-tab-item layui-show">
                                    <form class="layui-form layui-form-pane " method="post" action="{{url('admin/driver/'.$driver->id)}}">
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <input type="hidden" value="{{$driver->id}}" name="id">
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md8">
                                                <div class="layui-row">
                                                    {{--姓名--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">姓名</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_name" value="{{$driver->driver_name}}" lay-verify="required" placeholder="请输入驾驶员姓名" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--电话--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">联系电话</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_phone" value="{{$driver->driver_phone}}"  lay-verify="required" placeholder="请输入联系电话" autocomplete="off" class="layui-input">
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
                                                                <input type="text" name="driver_age" value="{{$driver->driver_age}}"  lay-verify="required" placeholder="请输入年龄" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--性别--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">性别</label>
                                                            <div class="layui-input-block">
                                                                <input type="radio" name="driver_sex" value="男" title="男"  @if($driver->driver_sex == '男')checked=""@endif>
                                                                <input type="radio" name="driver_sex" value="女" title="女"  @if($driver->driver_sex == '女')checked=""@endif>
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
                                                                <input type="text" name="driver_card" value="{{$driver->driver_card}}"  lay-verify="required" placeholder="请输入驾驶证号" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--初领日期--}}
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                        <div class="layui-form-item">
                                                            <label class="layui-form-label">初领日期</label>
                                                            <div class="layui-input-block">
                                                                <input type="text" name="driver_card_firstdata" value="{{$driver->driver_card_firstdata}}"  lay-verify="required" placeholder="请输入初领日期" autocomplete="off" class="layui-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md4">
                                                {{--上传图片--}}
                                                <div class="layui-row" >
                                                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md12" style="margin-left: 15% ;">
                                                        <div class="layui-upload-drag" style="border: 1px dashed #e2e2e2; padding: 2px; text-align: center;" id="upload">
                                                            <div id="uptitle" hidden>
                                                                <i class="layui-icon"></i>
                                                                <p>上传驾驶员头像</p>
                                                                <p>点击或将图片拖拽到此处</p>
                                                            </div>
                                                            <img class="layui-upload-img  img-responsive col-md-4 col-sm-4 col-xs-8 " style="min-width: 150px;min-height: 150px;max-width: 150px;max-height: 150px"  @if(empty($driver->driver_photo)) src="{{url('/backend/images/default/default_zhaopian.jpg')}}"@else src={{url($driver->driver_photo)}}@endif  alt="" id="demo1"/>
                                                            <input type="hidden" value="{{$driver->driver_photo}}"  name="driver_photo"  id="uploadimg" >
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
                                                        <input type="text" name="driver_archive_number" value="{{$driver->driver_archive_number}}"  lay-verify="required" placeholder="请输入证档案号" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md3">
                                                {{--准驾车型--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">准驾车型</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_permit" value="{{$driver->driver_permit}}"  lay-verify="required" placeholder="准驾车型" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md5">
                                                {{--驾驶证审验有效时间--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style="width: 150px;padding:9px 2px;">驾驶证审验有效时间</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_card_date" value="{{$driver->driver_card_date}}"  lay-verify="required" placeholder="请输入驾驶证审验有效时间" autocomplete="off" class="layui-input" style="width: 67%">
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
                                                        <input type="text" name="driver_qualification" value="{{$driver->driver_qualification}}"  lay-verify="required" placeholder="请输入从业资格证号" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
                                                {{--从业资格证号--}}
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label" style="width: 150px;padding:9px 2px;">资格证审验有效时间</label>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="driver_qualification_date" value="{{$driver->driver_qualification_date}}"  lay-verify="required" placeholder="请输入资格证审验有效时间" autocomplete="off" class="layui-input" style="width: 67%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-row">
                                            <div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
                                                <div class="layui-form-item layui-form-text">
                                                    <label class="layui-form-label">驾驶信息</label>
                                                    <div class="layui-input-block">
                                                        <textarea placeholder="驾驶信息"  name="driver_info" class="layui-textarea">{{$driver->driver_info}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="demo2">修改驾驶员</button>
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
    {{--layui-v2.2.5--}}
    <script src="{{asset('/backend/myvebdors/layui-v2.2.5/layui/layui.js')}}"></script>
    {{--datatables 插件--}}
    <script src="{{asset('backend/vendors/DataTables-1.10.15/media/js/jquery.dataTables.min.js')}}"></script>
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
