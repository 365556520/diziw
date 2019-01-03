@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="layui-row" style="margin: 5px">
        <div class="tc">
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2" >
                <div class="my-nav-btn layui-clear" data-href="./demo/btn.html" >
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe756;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip"></p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/form.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-btn-warm layui-icon">&#xe735;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip">表单</p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/table.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-icon">&#xe715;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip">表格</p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/tab-card.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-btn-normal layui-icon">&#xe705;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip">选项卡</p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/progress-bar.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-bg-cyan layui-icon">&#xe6b2;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip">进度条</p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/folding-panel.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-bg-black layui-icon">&#xe698;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">40</p>
                        <p class="my-nav-text layui-elip">折叠面板</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-sm6 layui-col-md4">
            <div class="layui-collapse">
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">图表</h2>
                    <div class="layui-colla-content layui-show">
                        <div id="main-line" style="height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('/backend/myvebdors/echarts/echarts.min.js')}}"></script>
    <script type="text/javascript">
        layui.use(['element'], function () {
            var  element = layui.element
                , $ = layui.jquery;

            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main-line'));

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption({
                title: {
                    text: '销售图'
                },
                tooltip: {},
                legend: {
                    data: ['销量','纯利润']
                },
                xAxis: {
                    data: ["衬衫", "羊毛衫", "雪纺衫", "裤子", "高跟鞋", "袜子"]
                },
                yAxis: {},
                series: [{
                    name: '销量',
                    type: 'bar',
                    data: [5, 20, 360, 10, 10, 20]
                },{
                    name: '纯利润',
                    type: 'bar',
                    data: [15, 10, 36, 10, 10, 20]
                }
                ]
            });



        });
    </script>
@endsection