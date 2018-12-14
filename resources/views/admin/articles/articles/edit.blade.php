@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
    <link href="{{ asset('/backend/myvebdors/layui/layui_ext/dtree/dtree.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/myvebdors/layui/layui_ext/dtree/font/dtreefont.css')}}" rel="stylesheet">
@endsection
@section('content')
    <ul id="demoTree1" class="dtree" data-id="0"></ul>
@endsection
@section('js')
    <script>
        var data =[{
            "id":"001",
            "title": "湖南省",
            "isLast": false,
            "level": "1",
            "parentId": "0",
            "checkArr": [{"type": "0", "isChecked": "1"}],
            "basicData": {"data1": "自定义数据111", "data2": "自定义数据222", "data3": "自定义'我带了单引号'333"},
            "children":[{
                "id":"001001",
                "title": "长沙市",
                "isLast":true,
                "parentId": "001",
                "checkArr": [{"type": "0", "isChecked": "1"}],
                "level": "2"
            },{
                "id":"001002",
                "title": "株洲市",
                "isLast":true,
                "parentId": "001",
                "checkArr": [{"type": "0", "isChecked": "1"}],
                "level": "2"
            },{
                "id":"001003",
                "title": "湘潭市",
                "isLast":true,
                "parentId": "001",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"001004",
                "title": "衡阳市",
                "isLast":true,
                "parentId": "001",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"001005",
                "title": "郴州市",
                "isLast":true,
                "parentId": "001",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            }]
        },{
            "id":"002",
            "title": "湖北省",
            "isLast": false,
            "parentId": "0",
            "level": "1",
            "checkArr": [{"type": "0", "isChecked": "0"}],
            "children":[{
                "id":"002001",
                "title": "武汉市",
                "isLast":true,
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"002002",
                "title": "黄冈市",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "isLast":true,
                "parentId": "002",
                "level": "2"
            },{
                "id":"002003",
                "title": "潜江市",
                "isLast":true,
                "parentId": "002",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"002004",
                "title": "荆州市",
                "isLast":true,
                "parentId": "002",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"002005",
                "title": "襄阳市",
                "isLast":true,
                "parentId": "002",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            }]
        },{
            "id":"003",
            "title": "广东省",
            "isLast": false,
            "parentId": "0",
            "level": "1",
            "checkArr": [{"type": "0", "isChecked": "0"}],
            "children":[{
                "id":"003001",
                "title": "广州市",
                "isLast":false,
                "parentId": "003",
                "level": "2",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "children":[{
                    "id":"003001001",
                    "title": "天河区",
                    "isLast":true,
                    "parentId": "003001",
                    "checkArr": [{"type": "0", "isChecked": "0"}],
                    "level": "3"
                },{
                    "id":"003001002",
                    "title": "花都区",
                    "isLast":true,
                    "parentId": "003001",
                    "checkArr": [{"type": "0", "isChecked": "0"}],
                    "level": "3"
                }]
            },{
                "id":"003002",
                "title": "深圳市",
                "isLast":true,
                "parentId": "003",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"003003",
                "title": "中山市",
                "isLast":true,
                "parentId": "003",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"003004",
                "title": "东莞市",
                "isLast":true,
                "parentId": "003",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"003005",
                "title": "珠海市",
                "isLast":true,
                "parentId": "003",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"003006",
                "title": "韶关市",
                "isLast":true,
                "parentId": "003",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            }]
        },{
            "id":"004",
            "title": "浙江省",
            "isLast": false,
            "level": "1",
            "parentId": "0",
            "checkArr": [{"type": "0", "isChecked": "0"}],
            "children":[{
                "id":"004001",
                "title": "杭州市",
                "isLast":true,
                "parentId": "004",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"004002",
                "title": "温州市",
                "isLast":true,
                "parentId": "004",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"004003",
                "title": "绍兴市",
                "isLast":true,
                "parentId": "004",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"004004",
                "title": "金华市",
                "isLast":true,
                "parentId": "004",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            },{
                "id":"004005",
                "title": "义乌市",
                "isLast":true,
                "parentId": "004",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            }]
        },{
            "id":"005",
            "title": "福建省",
            "isLast": false,
            "parentId": "0",
            "level": "1",
            "checkArr": [{"type": "0", "isChecked": "0"}],
            "children":[{
                "id":"005001",
                "title": "厦门市",
                "isLast":true,
                "parentId": "005",
                "checkArr": [{"type": "0", "isChecked": "0"}],
                "level": "2"
            }]
        }];

        layui.config({
            base: '/backend/myvebdors/layui/layui_ext/dtree/'//配置 layui 第三方扩展组件存放的基础目录
        }).extend({
            dtree: 'dtree' //定义该组件模块名
        }).use(['layer', 'dtree'], function(){
            var layer = layui.layer,
                dtree = layui.dtree,
                $ = layui.$;
            var DemoTree=dtree.render({
                elem: "#demoTree1",  //绑定元素
                //  url: "../json/case/demoTree1.json"  //异步接口
                data:data,
                checkbar: false,
                checkbarType: "all"
            });
            //单击节点 监听事件
            dtree.on("node('demoTree1')" ,function(param){
                layer.msg(JSON.stringify(param));
            });
        });
    </script>
@endsection