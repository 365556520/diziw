@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <br>
    <div class="layui-row layui-col-space10">
        <div class="layui-col-xs12 layui-col-sm2 layui-col-md2">
            <!-- tree -->
            <ul id="tree" class="tree-table-tree-box"></ul>
        </div>
        <div class="layui-col-xs12 layui-col-sm10 layui-col-md10">
            <!-- 工具集 -->
            <div class="my-btn-box">
            <span class="fl">
                <a class="layui-btn layui-btn-danger" id="btn-delete-all">批量删除</a>
                <a class="layui-btn btn-default btn-add" id="btn-add-article">发布文章</a>
            </span>
                <span class="fr">
                <span class="layui-form-label">搜索条件：</span>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
                </div>
                <button class="layui-btn mgl-20">查询</button>
            </span>
            </div>
            <!-- table -->
            <div id="dateTable"></div>
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
                , cols: [[                  //标题栏
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 60, sort: true,}
                    , {field: 'account', title: '用户名', width: 120}
                    , {field: 'auth_group_name', title: '权限组', width: 120}
                    , {field: 'last_login_time', title: '最后登录时间', width: 120}
                    , {field: 'last_login_ip', title: '最后登录IP', width: 180}
                    , {field: 'create_time', title: '创建时间', width: 180}
                    , {field: 'status', title: '状态', width: 70}
                    , {fixed: 'right', title: '操作', width: 150, align: 'center', toolbar: '#barOption'} //这里的toolbar值是模板元素的选择器
                ]]
                , id: 'dataCheck'
                , url: ''
                , method: 'get'
                , page: true
                , limits: [30, 60, 90, 150, 300]
                , limit: 30 //默认采用30
                , loading: false
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

            // 获取选中行
            table.on('checkbox(dataCheck)', function (obj) {
                console.log(obj.checked); //当前是否选中状态
                console.log(obj.data); //选中行的相关数据
                console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
            });

            // 树        更多操作请查看 http://www.layui.com/demo/tree.html
            layui.tree({
                elem: '#tree' //传入元素选择器
                , click: function (item) { //点击节点回调
                    layer.msg('当前节名称：' + item.title);
                    // 加载中...
                    var loadIndex = layer.load(2, {shade: false});
                    // 关闭加载
                    layer.close(loadIndex);
                    // 刷新表格
                    tableIns.reload();
                }
                , nodes: [{ //节点
                    name: '父节点1'
                    ,title:'ceshi'
                    , children: [{
                        name: '子节点11'
                        , children: [{
                            name: '子节点111'
                        }]
                    }, {
                        name: '子节点12'
                    }]
                }, {
                    name: '父节点2'
                    , children: [{
                        name: '子节点21'
                        , children: [{
                            name: '子节点211纷纷就爱我就覅偶而安静佛尔'
                        }]
                    }]
                }]
            });

            // you code ...


        });
    </script>


@endsection