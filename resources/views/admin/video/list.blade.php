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
                    <div class="x_content" id="video">
                        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                            <ul class="layui-tab-title">
                                <li class="layui-this">视频管理</li>
                                <li>添加视频</li>
                            </ul>

                            <div class="layui-tab-content" >
                                @include('flash::message')
                                {{--视频列表--}}
                                <div class="layui-tab-item layui-show">
                                    视频列表
                                </div>
                                {{--添加视频--}}
                                <div class="layui-tab-item">

                                    <form class="layui-form layui-form-pane" method="post" action="{{url('admin/video')}}">
                                        {{csrf_field()}}
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">视频标题</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="title"  required="required" autocomplete="off" placeholder="请输入视频标签" class="layui-input">
                                            </div>
                                        </div>

                                        <div class="layui-upload-drag" id="upload">
                                            <div id="uptitle">
                                                <i class="layui-icon"></i>
                                                <p>点击或将图片拖拽到此处上传</p>
                                            </div>
                                            <img class="layui-upload-img  img-responsive col-md-4 col-sm-4 col-xs-8 " alt="" id="demo1"/>
                                            <input type="hidden" name="preview"  id="uploadimg">
                                        </div>
                                        <br><br>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">视频状态</label>
                                            <div class="layui-input-inline">
                                                <input type="checkbox"   name="like[iscommend]" title="推荐" >
                                                <input type="checkbox"   name="like[ishot]" title="热门" checked="">
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">点击数</label>
                                            <div class="layui-input-inline">
                                                <input type="text"  required="required" name="click" value="0" autocomplete="off" placeholder="请输入视频标签" class="layui-input">
                                            </div>
                                        </div>

                                        <div class="layui-form-item layui-form-text">
                                            <label class="layui-form-label">视频介绍</label>
                                            <div class="layui-input-block">
                                                <textarea placeholder="请输入内容" name="introduce" class="layui-textarea"></textarea>
                                            </div>
                                        </div>


                                        <div class="x_panel" v-for="(v,k) in videos">
                                            <div class="x_title">
                                                <h2>添加视频</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li>&nbsp;&nbsp;&nbsp;</li>
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <li><a class="close-link"  @click="del"><i class="fa fa-close"></i></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                  {{--                              <div class="layui-form-item">
                                                    <label class="layui-form-label">视频名称</label>
                                                    <div class="layui-input-block">
                                                        <input type="text"  v-model="v.name" autocomplete="off" placeholder="请输入标题" class="layui-input">
                                                    </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <button class="layui-form-label btn btn-default"  type="button">视频URL</button>
                                                    <div class="layui-input-block">
                                                        <input type="text" v-model="v.path" autocomplete="off" placeholder="请输入标题" class="layui-input">
                                                    </div>
                                                </div>--}}

                                                <div class="layui-upload">
                                                    <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button>
                                                    <div class="layui-upload-list">
                                                        <table class="layui-table">
                                                            <thead>
                                                            <tr><th>文件名</th>
                                                                <th>大小</th>
                                                                <th>状态</th>
                                                                <th>操作</th>
                                                            </tr></thead>
                                                            <tbody id="demoList"></tbody>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="layui-btn" id="testListAction">开始上传</button>
                                                </div>

                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" @click="add"><i class="fa fa-plus">添加视频</i></button>
                                        <textarea name="videos" hidden >@{{videos}}</textarea>
                                        <hr class="layui-bg-green">
                                        <div class="layui-form-item">
                                            <button class="layui-btn pull-right" lay-submit="" lay-filter="demo2">提交视频</button>
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
    <script>


        layui.use(['element','upload','form'], function(){
            var form = layui.form
            var $ = layui.jquery
            ,element = layui.element //Tab的切换功能，切换事件监听等，需要依赖element模块
            ,upload = layui.upload //上传初始
            //拖拽上传
            //图片上传
            upload.render({
                elem: '#upload',
                url: 'video/upload',
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
            //多文件上传
            //多文件列表示例
            var demoListView = $('#demoList')
                ,uploadListIns = upload.render({
                elem: '#testList'
                ,url: '/upload/'
                ,accept: 'file'
                ,multiple: true
                ,auto: false
                ,bindAction: '#testListAction'
                ,choose: function(obj){
                    var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
                    //读取本地文件
                    obj.preview(function(index, file, result){
                        var tr = $(['<tr id="upload-'+ index +'">'
                            ,'<td>'+ file.name +'</td>'
                            ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
                            ,'<td>等待上传</td>'
                            ,'<td>'
                            ,'<button class="layui-btn layui-btn-mini demo-reload layui-hide">重传</button>'
                            ,'<button class="layui-btn layui-btn-mini layui-btn-danger demo-delete">删除</button>'
                            ,'</td>'
                            ,'</tr>'].join(''));
                        //单个重传
                        tr.find('.demo-reload').on('click', function(){
                            obj.upload(index, file);
                        });

                        //删除
                        tr.find('.demo-delete').on('click', function(){
                            delete files[index]; //删除对应的文件
                            tr.remove();
                            uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
                        });

                        demoListView.append(tr);
                    });
                }
                ,done: function(res, index, upload){
                    if(res.code == 0){ //上传成功
                        var tr = demoListView.find('tr#upload-'+ index)
                            ,tds = tr.children();
                        tds.eq(2).html('<span style="color: #5FB878;">上传成功</span>');
                        tds.eq(3).html(''); //清空操作
                        return delete this.files[index]; //删除文件队列已经上传成功的文件
                    }
                    this.error(index, upload);
                }
                ,error: function(index, upload){
                    var tr = demoListView.find('tr#upload-'+ index)
                        ,tds = tr.children();
                    tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
                    tds.eq(3).find('.demo-reload').removeClass('layui-hide'); //显示重传
                }
            });


        });
        //vuejs
        var app = new Vue({
            el: '#video',
            data:{
                videos: [{name:'',path:''}]
            },
            methods:{
                //添加视频事件
                add:function () {
                    this.videos.push({name:'',path:''});
                },
                //删除视频事件
                del:function (k) {
                    this.videos.splice(k,1);
                }
            }
        })

    </script>
    {{--提示代码--}}
    @include('component.errorsLayer')
@endsection
