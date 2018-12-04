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
                <label class="layui-form-label">文章内容</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" name="content" class="layui-textarea"></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo2">发布文章</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
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

        });
    </script>
@endsection