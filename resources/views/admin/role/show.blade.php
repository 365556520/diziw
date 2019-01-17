@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="layui-container" style="margin-top: 15px;">
        <div id="root"></div>
        <div class="layui-btn-group">
            <button class="layui-btn right">确认授权</button>
        </div>
        @include('flash::message')
    </div>
@endsection
@section('js')
    <script>
        layui.config({
            base: '/backend/myvebdors/layui/layui_ext/transfer/'
        }).use(['transfer'],function () {
            var transfer = layui.transfer,
                $ = layui.$;
            //数据源
            var data1 =[@foreach($role->notpermission as $v){'id':'{{$v->id}}','display_name':'{{$v->display_name}}','name':'{{$v->name}}'},@endforeach];
            var data2 = [@foreach($role->permission as $v){'id':'{{$v->id}}','display_name':'{{$v->display_name}}','name':'{{$v->name}}'},@endforeach];
            //表格列
            var cols = [{type: 'checkbox', fixed: 'left'},{field: 'id', title: 'ID', width: 60, sort: true},{field: 'display_name', title: '权限名'},{field: 'name', title: '权限', width: 150}]
            //表格配置文件
            var tabConfig = {'page':{groups: 1,first: false,last: false},'limits':[10,50,100],'height':400}
            var tb1 = transfer.render({
                elem: "#root", //指定元素
                cols: cols, //表格列  支持layui数据表格所有配置
                data: [data1,data2], //[左表数据,右表数据[非必填]]
                tabConfig: tabConfig //表格配置项 支持layui数据表格所有配置
            })

            //transfer.get(参数1:初始化返回值,参数2:获取数据[all,left,right,l,r],参数:指定数据字段)
            //获取数据
            $('.all').on('click',function () {
                var data = transfer.get(tb1,'all');
                layer.msg(JSON.stringify(data))
            });
            $('.left').on('click',function () {
                var data = transfer.get(tb1,'left','id');
                layer.msg(JSON.stringify(data))
            });
            $('.right').on('click',function () {
                var data = transfer.get(tb1,'r','id');
                $.ajax({
                    type: "POST",
                    url: "/admin/role/upPermission",
                    cache: false,
                    data:{permission:data,id:"{{$role->id}}"},
                    success: function (data) {
                       layer.msg('授权成功');
                    },
                    error: function (xhr, status, error) {
                        layer.msg('授权失败');
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            });
        })
    </script>
@endsection





{{--查看模态框--}}{{--
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title " id="myModalLabel">{{$role->display_name}}<br>
        <small>{{trans('admin/role.model.created_at')}}:{{$role->created_at}}</small>
    </h4>
</div>
<div class="modal-body ">
    <div class="row ">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 "> <h4>{{trans('admin/role.model.name')}}:{{$role->name}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >
            {{trans('admin/role.model.description')}}:
            <span class="text-danger">{{$role->description}}</span>
        </div>
    </div>
    <div class="row">
        <div class="control-label col-md-6 col-sm-6 col-xs-12 " >
            <h4>{{trans('admin/role.model.permission')}}</h4>
            @foreach($role->permission as $v)
                {{trans('admin/permission.model.display_name')}}:{{$v->display_name}}→
                {{trans('admin/permission.model.description')}}:<small class="text-danger">{{$v->description}}</small><br>
            @endforeach
        </div>
    </div>
</div>
<div class="modal-footer">
        <small class="text-success">
            {{trans('admin/role.model.updated_at')}}:{{$role->updated_at}}
        </small>
</div>--}}

