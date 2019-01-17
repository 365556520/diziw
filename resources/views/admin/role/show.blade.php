@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="layui-container" style="margin-top: 20px;">
        <div class="layui-btn-group">
            <button class="layui-btn all">获取全部数据</button>
            <button class="layui-btn left">获取左边数据</button>
            <button class="layui-btn right">获取右边数据</button>
        </div>
        <div id="root"></div>

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
            var data1 = [{'id':'10001','name':'杜甫','sex':'男'},{'id':'10002','name':'李白','sex':'男'},{'id':'10003','name':'王勃','sex':'男'},{'id':'10004','name':'李清照','sex':'男'}];
            var data2 = [{'id':'10005','name':'白居易','sex':'男'}];
            //表格列
            var cols = [{type: 'checkbox', fixed: 'left'},{field: 'id', title: 'ID', width: 80, sort: true},{field: 'name', title: '用户名'},{field: 'sex', title: '性别'}]
            //表格配置文件
            var tabConfig = {'page':true,'limits':[10,50,100],'height':300}
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
                var data = transfer.get(tb1,'r');
                layer.msg(JSON.stringify(data))
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

