@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
     @include('flash::message')
    <div class="layui-row">
        <table class="layui-hide" id="test" lay-filter="test"></table>
        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container layui-btn-group my-btn-box">
                <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="getCheckLength">获取选中数目</button>
                <button class="layui-btn layui-btn-warm layui-btn-xs" lay-event="isAll">刷新</button>
                <button class="layui-btn layui-btn-xs" lay-event="add">{{trans('admin/role.action.create')}}</button>
            </div>
        </script>
        {{--操作按钮--}}
        <script type="text/html" id="barbtn">
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="show">授权</button>
                <button class="layui-btn layui-btn-xs" lay-event="edit">编辑</button>
                <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</button>
            </div>
        </script>
    </div>
@endsection
@section('js')
    <script>
        layui.use('table', function(){
            var table = layui.table;
            // 表格渲染
            var tableIns = table.render({
                elem: '#test'
                , height: $(window).height() - ( $('.my-btn-box').outerHeight(true) ? $('.my-btn-box').outerHeight(true) + 35 :  40 )    //获取高度容器高度
                ,url:'/admin/role/ajaxIndex'
                ,toolbar: '#toolbarDemo'
                ,title: '{{trans('admin/role.desc')}}'
                ,cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    ,{field:'id', title:'{{trans('admin/role.model.id')}}', width:80, fixed: 'left', unresize: true, sort: true}
                    ,{field:'name', title:'{{trans('admin/role.model.name')}}', width:120}
                    ,{field:'display_name', title:'{{trans('admin/role.model.display_name')}}', width:120, edit: 'text',}
                    ,{field:'description', title:'{{trans('admin/role.model.description')}}', width:200, edit: 'text',}
                    ,{fixed:'right', title:'{{trans('admin/role.model.operate')}}', toolbar: '#barbtn', width:180}
                ]]
                , page: true
                , limits: [15, 25, 50, 100]
                , limit: 15 //默认采用30
                ,loading: false
            });

            //头工具栏事件
            table.on('toolbar(test)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                switch(obj.event){
                    case 'getCheckLength':
                        var data = checkStatus.data;
                        layer.msg('选中了：'+ data.length + ' 个');
                        break;
                    case 'isAll':
                        // 刷新表格
                        tableIns.reload({
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                        });
                        //layer.msg(checkStatus.isAll ? '全选': '未全选');
                        break;
                    case 'add':
                        layer.open({
                            type: 2,//2类型窗口 这里内容是一个网址
                            title: '{{trans('admin/role.create')}}',
                            shadeClose: true,
                            shade: false,
                            anim: 2, //打开动画
                            maxmin: true, //开启最大化最小化按钮
                            area: ['893px', '100%'],
                            content: '{{url("/admin/role/create")}}',
                            cancel: function(index, layero){
                                // 刷新表格
                                tableIns.reload({
                                    page: {
                                        curr: 1 //重新从第 1 页开始
                                    }
                                });
                                return true;
                            }
                        });
                        break;
                };
            });
            //监听行工具条事件
            table.on('tool(test)', function(obj){
                var data = obj.data;
                //console.log('kankan22222 '+obj.data);
                if(obj.event === 'del'){
                    if(data.name==="admin"){
                        layer.msg('超级管理员不能删除！', {
                            time: 2000, //20s后自动关
                        });
                    }else{
                        layer.confirm('真的删除此分类吗？', function(index){
                            $.ajax({
                                type: "POST",
                                url: "{{url('/admin/role')}}/"+data.id,
                                cache: false,
                                data:{_method:"DELETE", _token: "{{csrf_token()}}"},
                                success: function (data) {
                                    layer.msg('删除成功', {
                                        time: 2000, //20s后自动关
                                    });
                                    // 刷新表格
                                    tableIns.reload({
                                        page: {
                                            curr: 1 //重新从第 1 页开始
                                        }
                                    });
                                    //删除成功后删除缓存
                                    layer.close(index);
                                },
                                error: function (xhr, status, error) {
                                    layer.msg('删除失败', {
                                        time: 2000, //20s后自动关
                                    });
                                    console.log(xhr);
                                    console.log(status);
                                    console.log(error);
                                }
                            });
                        });
                    }
                } else if(obj.event === 'edit'){
                   layer.open({
                        type: 2,//2类型窗口 这里内容是一个网址
                        title: '{{trans('admin/permission.edit')}}',
                        shadeClose: true,
                        shade: false,
                        anim: 2, //打开动画
                        maxmin: true, //开启最大化最小化按钮
                        area: ['893px', '100%'],
                        content: '{{url("/admin/role")}}/'+ data.id + '/edit',
                        cancel: function(index, layero){
                           // 刷新表格
                           tableIns.reload({
                               page: {
                                   curr: 1 //重新从第 1 页开始
                               }
                           });
                           return true;
                       }
                    });
                 /*   layer.prompt({
                        formType: 2
                        ,value:data.id
                    }, function(value, index){
                        obj.update({
                            cate_keywords: value
                        });
                        layer.close(index);
                    });*/
                } else if(obj.event === 'show'){
                    //多窗口模式，层叠置顶
                    layer.open({
                        type: 2 //1类型窗口 这里内容可以自己写
                        ,title:'授权'
                        ,area: ['97%', '100%']
                        ,shade: 0
                        ,maxmin: true
                        ,content: '{{url("/admin/role")}}/'+ data.id
                    });
                }
            });
        });
    </script>
@endsection