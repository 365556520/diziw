@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
    <link href="{{ asset('/backend/myvebdors/layui/layui_ext/dtree/dtree.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/myvebdors/layui/layui_ext/dtree/font/dtreefont.css')}}" rel="stylesheet">
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

        </div>
    </div>
@endsection
@section('js')

    <script type="text/javascript">
        // layui方法
        layui.config({
            base: '/backend/myvebdors/layui/layui_ext/dtree/'//配置 layui 第三方扩展组件存放的基础目录
        }).extend({
            dtree: 'dtree' //定义该组件模块名
        }).use(['tree', 'table', 'layer', 'dtree'], function () {
            // 操作对象
            var table = layui.table
                , layer = layui.layer
                ,dtree = layui.dtree
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
                        var ids = new Array(); //id变量
                        var thumbs = new Array(); //图片变量
                        //获取图片和id
                        for (var k in data) {
                            ids.push({
                                'id' : data[k]['id'],
                            });
                            thumbs.push(data[k]['thumb']);
                        }
                        if(data.length>0){
                            layer.confirm('真的删除这些分类吗？', function(index){
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('/admin/articles/destroys')}}/"+ JSON.stringify(ids),
                                    cache: false,
                                    data:{"thumb":thumbs},
                                    success: function (data) {
                                        layer.msg('删除成功', {
                                            time: 2000, //20s后自动关
                                        });
                                        //刷新表格
                                        tableIns.reload();
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
                            title: '<div><i class="layui-icon layui-icon-edit" style="font-size: 22px; color: #ff2315;"></i>添加文章</div>',
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

            //监听行工具条事件
            table.on('tool(dateTable)', function(obj){
                var data = obj.data;
                //console.log('kankan22222 '+obj.data);
                if(obj.event === 'del'){
                    layer.confirm('真的删除此分类吗？', function(index){
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/articles')}}/"+data.id,
                            cache: false,
                            data:{_method:"DELETE", _token: "{{csrf_token()}}","thumb":data.thumb},
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
                        content: '{{url("/admin/articles")}}/'+ data.id + '/edit',
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
            //树
            dtree.render({
                elem: "#tree",  //绑定元素
                //  url: "../json/case/tree.json"  //异步接口
                data: [
                        @foreach($categorys as $v){
                        title:'{{$v->cate_name}}'
                        ,id:'{{$v->id}}'
                        ,parentId : '{{$v->cate_pid}}'
                        @if($v->children)
                        ,children:[
                            @foreach($v->children as $vs){
                            title:'{{$vs->cate_name}}'
                            ,id:'{{$vs->id}}'
                            ,parentId : '{{$vs->cate_pid}}'
                        },
                        @endforeach
                    ]
                        @endif
                    },
                    @endforeach
                ],
            });
            //单击节点 监听事件
            dtree.on("node('tree')" ,function(param){
                console.log('点击树节点的属性'+JSON.stringify(param.param));
                if (param.param.parentId != 0) {
                    newcategory_id = param.param.nodeId;
                    // 加载中...
                    var loadIndex = layer.load(2, {shade: false});
                    // 关闭加载
                    layer.close(loadIndex);
                    // 刷新表格
                    tableIns.reload({
                        where: {'category_id': newcategory_id} //设定异步数据接口的额外参数
                        , page: {
                            curr: 1 //重新从第 1 页开始
                        }
                    });
                }
            });
        });
    </script>


@endsection