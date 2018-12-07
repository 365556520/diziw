@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="layui-row" style="padding: 2px 15px 2px 15px">
        <br>
        <div style="color: #ec162d;size: 28px">@include('flash::message')</div>
        <form class="layui-form layui-form-pane" lay-filter="add" method="post" action="{{url('admin/articles')}}">
            {{csrf_field()}}
            {{--作者id--}}
            <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            <div class="layui-form-item">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">缩略图</label>
                <div class="layui-input-inline">
                    <input type="text" name="thumb" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>


            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">文章分类</label>
                    <div class="layui-input-inline">
                        <input type="text" name="category_id"  lay-verify="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">浏览次数</label>
                    <div class="layui-input-inline">
                        <input type="text" name="cate_view"  lay-verify="" autocomplete="off" class="layui-input" disabled="">
                    </div>
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">文章级别</label>
                <div class="layui-input-block">
                    <input type="radio" name="level" value=0 title="置顶" checked="">
                    <input type="radio" name="level" value=1 title="推荐">
                    <input type="radio" name="level" value=2 title="热门" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">文章状态</label>
                <div class="layui-input-block">
                    <input type="checkbox" value="1" name="state" lay-skin="switch" lay-filter="state" lay-text="通过|审核中">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">文章关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="tag" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">文章描述</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" name="description" class="layui-textarea"></textarea>
                </div>
            </div>


            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <textarea  name="content" id="content"></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo2">发布文章</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
   {{--查看本编辑中查看源码需要用到ace插件--}}
    <script src="{{asset('/backend/myvebdors/layui/ace/ace.js')}}"></script>
    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit;
            //自定义验证规则
            form.verify({
                cate_view: [/^[0-9]{1,7}$/, '必须数字但不能大于7位']
            });
            //监听提交
            form.on('submit(demo2)', function(data){
           /*     layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                })*/
                return true;
            });
            //监听指定开关
            form.on('switch(state)', function(data){
                layer.tips('温馨提示：'+ (this.checked != 0 ? '直接通过审核！' : '不审核该文章！'), data.othis)
            });
            //初始只
            form.val("add", {
                "cate_view":0
                ,"state": 0
            })
            //富文本框
            layui.use(['layedit', 'layer', 'jquery'], function () {
                var $ = layui.jquery;
                var layedit = layui.layedit;
                layedit.set({
                    //暴露layupload参数设置接口 --详细查看layupload参数说明
                    uploadImage: {
                        url: 'your url',
                        accept: 'image',
                        acceptMime: 'image/*',
                        exts: 'jpg|png|gif|bmp|jpeg',
                        size: 1024 * 10,
                        done: function (data) {
                            console.log(data);
                        }
                    }

             /*     // 需要在tool加入'video'
               , uploadVideo: {
                        url: 'your url',
                        accept: 'video',
                        acceptMime: 'video/!*',
                        exts: 'mp4|flv|avi|rm|rmvb',
                        size: 1024 * 10 * 2,
                        done: function (data) {
                            console.log(data);
                        }
                    }
                    //需要在tool加入'attachment'
                    , uploadFiles: {
                        url: 'your url',
                        accept: 'file',
                        acceptMime: 'file/!*',
                        size: '20480',
                        done: function (data) {
                            console.log(data);
                        }
                    }*/
                    //右键删除图片/视频时的回调参数，post到后台删除服务器文件等操作，
                    //传递参数：
                    //图片： imgpath --图片路径
                    //视频： filepath --视频路径 imgpath --封面路径
                    , calldel: {
                        url: 'your url',
                        done: function (data) {
                            console.log(data);
                        }
                    }
                    //开发者模式 --默认为false
                    , devmode: true
                    //插入代码设置 --hide:true 等同于不配置codeConfig
                    , codeConfig: {
                        hide: false,  //是否显示编码语言选择框
                        default: 'javascript' //hide为true时的默认语言格式
                    }
                    //新增iframe外置样式和js
                    //, quote:{
                    //    style: ['/Content/Layui-KnifeZ/css/layui.css','/others'],
                    //    js: ['/Content/Layui-KnifeZ/lay/modules/jquery.js']
                    //}
                    //自定义样式-暂只支持video添加
                    //, customTheme: {
                    //    video: {
                    //        title: ['原版', 'custom_1', 'custom_2']
                    //        , content: ['', 'theme1', 'theme2']
                    //        , preview: ['', '/images/prive.jpg', '/images/prive2.jpg']
                    //    }
                    //}
                    //插入自定义链接
                    , customlink:{
                        title: '插入layui官网'
                        ,href: ''
                        ,onmouseup:''
                    }
                    , facePath:'http://knifez.gitee.io/kz.layedit/Content/Layui-KnifeZ/' //这个是表情地址
                    , tool: [
                        'html', 'undo', 'redo', 'code', 'strong', 'italic', 'underline', 'del', 'addhr', '|', 'fontFomatt','fontfamily', 'fontBackColor', 'colorpicker', 'face'
                        , '|', 'left', 'center', 'right', '|', 'link', 'unlink', 'images', 'image_alt', 'anchors'
                        , '|'
                        , 'table','customlink'
                        , 'fullScreen'
                    ]
                    , height: '90%'
                });
                var ieditor = layedit.build('content');
                //设置编辑器内容
                layedit.setContent(ieditor, '<font color="#fe5824">美好的一天，就这样开始了！ <img src="http://knifez.gitee.io/kz.layedit/Content/Layui-KnifeZ/images/face/1.gif" alt="[嘻嘻]"></font>', false);
            })

        });
    </script>
@endsection