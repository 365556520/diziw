@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs3 layui-col-sm2 layui-col-md2" style="height: 550px;overflow:scroll">
            <!-- tree -->
            <ul id="tree" class="tree-table-tree-box"></ul>
        </div>
        <div class="layui-col-xs9 layui-col-sm10 layui-col-md10">
            <!-- table -->
            <table class="layui-hide" id="dateTable" lay-filter="dateTable"></table>
            <br>
            <!-- 工具集 -->
            <script type="text/html" id="toolbarDemo">
                <div class="my-btn-box">
                    <span class="fl">
                        <button class="layui-btn layui-btn-danger"  lay-event="delete-all">批量删除</button>
                        <button class="layui-btn btn-default btn-add"  lay-event="add">发布文章</button>
                    </span>
                        <span class="fr">
                        <div class="layui-input-inline">
                            <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
                        </div>
                        <button class="layui-btn mgl-20">查询</button>
                    </span>
                </div>
            </script>

        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        // layui方法
        layui.use(['tree', 'table', 'layer'], function () {
            // 操作对象
            var table = layui.table
                , layer = layui.layer
                , $ = layui.jquery;
            // 表格渲染
            var tableIns = table.render({
                elem: '#dateTable'                  //指定原始表格元素选择器（推荐id选择器）
                , height: $(window).height() - ( $('.my-btn-box').outerHeight(true) ? $('.my-btn-box').outerHeight(true) + 35 :  40 )    //获取高度容器高度
                , id: 'dataCheck'
                , url: '/admin/articles/ajaxIndex'
                 ,toolbar: '#toolbarDemo'
                , where: {'category_id': null} //设定异步数据接口的额外参数
                , method: 'get'
                , page: true
                , limits: [15, 25, 50, 100]
                , limit: 15 //默认采用30
                , loading: false
                , cols: [[                  //标题栏
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 60, sort: true,fixed: 'left'}
                    , {field: 'title', title: '文章标题', width: 120 ,fixed: 'left'}
                    , {field: 'tag', title: '关键词', width: 120}
                    , {field: 'description', title: '描述', width: 120}
                    , {field: 'level', title: '级别', width: 100}
                    , {field: 'state', title: '文章状态', width: 90}
                    , {field: 'view', title: '浏览次数', width: 100 ,sort: true,}
                    , {field: 'user_id', title: '作者id', width: 100}
                    , {field: 'created_at', title: '创建时间', width: 180}
                    , {fixed: 'right', title: '操作', width: 160, align: 'center', toolbar: '#barDemo'} //这里的toolbar值是模板元素的选择器
                ]]
                , done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });


            //头工具栏事件
            table.on('toolbar(dateTable)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                switch(obj.event){
                    case 'delete-all':
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
                                        window.location.reload(); //刷新本页面
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
                    case 'add':
                        layer.open({
                            type: 2,//2类型窗口 这里内容是一个网址
                            title: '添加文章',
                            shadeClose: true,
                            shade: false,
                            anim: 2, //打开动画
                            maxmin: true, //开启最大化最小化按钮
                            area: ['893px', '100%'],
                            content: '{{url("/admin/articles/create")}}',
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
/*            // 获取选中行
            table.on('checkbox(dataCheck)', function (obj) {
                console.log(obj.checked); //当前是否选中状态
                console.log(obj.data); //选中行的相关数据
                console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
            });*/

            // 树        更多操作请查看 http://www.layui.com/demo/tree.html
            layui.tree({
                elem: '#tree' //传入元素选择器
                , click: function (item) { //点击节点回调
                    if (item.cate_pid != 0){
                        layer.msg('当前节名称：' + item.id);
                        console.log(item);
                        newcategory_id = item.id;
                        // 加载中...
                        var loadIndex = layer.load(2, {shade: false});
                        // 关闭加载
                        layer.close(loadIndex);
                        // 刷新表格
                        tableIns.reload({
                            where: {'category_id': newcategory_id} //设定异步数据接口的额外参数
                            ,page: {
                                curr: 1 //重新从第 1 页开始
                            }
                        });
                    }

                }
                , nodes: [
                    @foreach($categorys as $v)
                       {
                            name:'{{$v->cate_name}}'
                            ,id:'{{$v->id}}'
                            ,cate_pid : '{{$v->cate_pid}}'
                             @if($v->children)
                                 ,children:[
                                    @foreach($v->children as $vs)
                                        {
                                            name:'{{$vs->cate_name}}'
                                            ,id:'{{$vs->id}}'
                                            ,cate_pid : '{{$vs->cate_pid}}'
                                        },
                                     @endforeach
                                 ]
                            @endif
                        },
                    @endforeach
                ]
            });
            // you code ...

            /*
            * */
        });
    </script>


@endsection