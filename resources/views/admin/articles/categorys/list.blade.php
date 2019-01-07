@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div style="background: #beff9f;color: #ec4e20;size: 18px">@include('flash::message')</div>
    <div class="layui-row">
        <table class="layui-hide" id="test" lay-filter="test"></table>
        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container layui-btn-group my-btn-box">
                <button class="layui-btn layui-btn-danger  layui-btn-xs" lay-event="getCheckData">批量删除</button>
                <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="getCheckLength">获取选中数目</button>
                <button class="layui-btn layui-btn-warm layui-btn-xs" lay-event="isAll">刷新</button>
                <button class="layui-btn layui-btn-xs" lay-event="add">添加分类</button>
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
                ,url:'/admin/categorys/ajaxIndex'
                ,toolbar: '#toolbarDemo'
                ,title: '用户数据表'
                ,cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    ,{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
                    ,{field:'_cate_name', title:'分类名称', width:120}
                    ,{field:'cate_keywords', title:'关键词', width:120, edit: 'text',}
                    ,{field:'cate_description', title:'描述', width:200, edit: 'text',}
                    ,{field:'cate_view', title:'查看次数', width:120}
                    ,{field:'created_at', title:'创建时间', width:180, sort: true}
                    ,{field:'updated_at', title:'更新时间', width:180}
                    ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:180}
                ]]
                ,limit: 100 //默认采用100
                ,loading: false
            });

            //头工具栏事件
            table.on('toolbar(test)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                switch(obj.event){
                    case 'getCheckData':
                        var data = checkStatus.data;  //得到选中数据的数组
                        if(data.length>0){
                            layer.confirm('真的删除这些分类吗？', function(index){
                                $.ajax({
                                    type: "GET",
                                    url: "{{url('/admin/categorys/destroys')}}/"+ JSON.stringify(data),
                                    cache: false,
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
                        }else {
                            layer.msg('最少选中一个');
                        }
                        break;
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
                            title: '添加文章分类',
                            shadeClose: true,
                            shade: false,
                            anim: 2, //打开动画
                            maxmin: true, //开启最大化最小化按钮
                            area: ['893px', '100%'],
                            content: '{{url("/admin/categorys/create")}}',
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
                    layer.confirm('真的删除此分类吗？', function(index){
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/categorys')}}/"+data.id,
                            cache: false,
                            data:{_method:"DELETE", _token: "{{csrf_token()}}"},
                            success: function (data) {
                                layer.msg('删除成功', {
                                    time: 2000, //20s后自动关
                                });
                                //删除成功后删除缓存
                                obj.del();
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
                } else if(obj.event === 'edit'){
                   layer.open({
                        type: 2,//2类型窗口 这里内容是一个网址
                        title: '修改文章分类',
                        shadeClose: true,
                        shade: false,
                        anim: 2, //打开动画
                        maxmin: true, //开启最大化最小化按钮
                        area: ['893px', '100%'],
                        content: '{{url("/admin/categorys")}}/'+ data.id + '/edit',
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
                        type: 1 //1类型窗口 这里内容可以自己写
                        ,title:'文章分类----'+data.cate_name
                        ,area: ['390px', '260px']
                        ,shade: 0
                        ,maxmin: true
                        ,content: '<div>分类id：'+data.id +'<br>' +
                             '分类名称：'+data.cate_name +'<br>' +
                             '分类关键词：'+data.cate_keywords +'<br>' +
                             '分类描述：'+data.cate_description +'<br>' +
                             '</div>'
                    });
                }
            });
        });
    </script>
@endsection