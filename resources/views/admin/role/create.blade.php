@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="layui-row" style="padding: 2px 15px 2px 15px">
        <br>
        @include('flash::message')
        <form class="layui-form layui-form-pane" method="post" action="{{url('admin/role')}}">
            {{csrf_field()}}
            <div class="layui-form-item">
                <label class="layui-form-label">{{trans('admin/role.model.name')}}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">{{trans('admin/role.model.display_name')}}</label>
                <div class="layui-input-inline">
                    <input type="text" name="display_name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item  layui-form-text">
                <label class="layui-form-label">{{trans('admin/role.model.description')}}</label>
                <div class="layui-input-block">
                    <textarea  name="description" class="layui-textarea"></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo2">添加分类</button>
            </div>
        </form>

    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'layer',], function(){
            var form = layui.form
                ,layer = layui.layer;
            //监听提交
            form.on('submit(demo2)', function(data){
                /*     layer.alert(JSON.stringify(data.field), {
                 title: '最终的提交信息'
                 })*/
                return true;
            });


        });
    </script>
@endsection



