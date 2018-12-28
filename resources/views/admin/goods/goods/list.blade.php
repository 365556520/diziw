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
            {{--<ul id="tree" class="tree-table-tree-box"></ul>--}}
            <ul id="tree" class="dtree" data-id="0"></ul>
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

            <script type="text/html" id="switchTpl">
                <input type="checkbox" name="state" value="@{{d.state}}"  id="@{{d.id}}" lay-skin="switch" lay-text="已审核|未审核" lay-filter="state" @{{ d.state == 1 ? 'checked' : '' }}>
            </script>

        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use('table', function(){
            var table = layui.table;

            // 表格渲染
            var tableIns = table.render({
                elem: '#dateTable'                  //指定原始表格元素选择器（推荐id选择器）
                , height: $(window).height() - ( $('.my-btn-box').outerHeight(true) ? $('.my-btn-box').outerHeight(true) + 35 :  40 )    //获取高度容器高度
                , id: 'dataCheck'
                , url: '/admin/goods/ajaxIndex'
                ,toolbar: '#toolbarDemo'
                , where: {'goodscategorys_id': null} //设定异步数据接口的额外参数
                , method: 'get'
                , page: true
                , limits: [15, 25, 50, 100]
                , limit: 15 //默认采用30
                , loading: false
                , cols: [[                  //标题栏
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 60, sort: true,fixed: 'left'}
                    , {field: 'goods_name', title: '商品名字', width: 120 ,fixed: 'left'}
                    , {field: 'aytype', title: '商品单位', width: 100}
                    , {field: 'cost_price', title: '进价', width: 80}
                    , {field: 'shop_price', title: '售价', width: 80}
                    , {field: 'number', title: '规格', width: 120}
                    , {field: 'inventory', title: '库存', width: 120}
                    , {field: 'sell', title: '销量', width: 120}
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
            table.on('toolbar(test)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                switch(obj.event){
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
                            title: '添加商品',
                            shadeClose: true,
                            shade: false,
                            anim: 2, //打开动画
                            maxmin: true, //开启最大化最小化按钮
                            area: ['400px', '50%'],
                            content: '{{url("/admin/goods/create")}}',
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
                            url: "{{url('/admin/goods')}}/"+data.id,
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
                        title: '修改商品',
                        shadeClose: true,
                        shade: false,
                        anim: 2, //打开动画
                        maxmin: true, //开启最大化最小化按钮
                        area: ['400px', '50%'],
                        content: '{{url("/admin/goods")}}/'+ data.id + '/edit',
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
                        ,title:'商品----'+data.goods_name
                        ,area: ['390px', '260px']
                        ,shade: 0
                        ,maxmin: true
                        ,content: '<div>分类id：'+data.id +'<br>' +
                             '分类名称：'+data.goods_name +'<br>' +
                             '</div>'
                    });
                }
            });
        });
    </script>
@endsection