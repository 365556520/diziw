@extends('admin.layouts.layuicontent')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="layui-row" style="margin: 5px">
        <div class=" layui-row tc">
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2" >
                <div class="my-nav-btn layui-clear" data-href="./demo/btn.html" >
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe756;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text">{{ $gosdsinfo["moneys"]}}元</p>
                        <p class="my-nav-text layui-elip">纯利润</p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
                <div class="my-nav-btn layui-clear" data-href="./demo/form.html">
                    <div class="layui-col-md5">
                        <button class="layui-btn layui-btn-big layui-btn-warm layui-icon">&#xe735;</button>
                    </div>
                    <div class="layui-col-md7 tc">
                        <p class="my-nav-text"> {{$gosdsinfo["buycount"]}}</p>
                        <p class="my-nav-text layui-elip">总销量</p>
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
        <br>
        <div class="layui-row">
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md6">
                <div class="layui-collapse">
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">销售表</h2>
                        <div class="layui-colla-content layui-show">
                            <div id="main-line" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md6">
                <div class="layui-collapse">
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">利润表</h2>
                        <div class="layui-colla-content layui-show">
                            <div id="lirun" style="height: 500px;"></div>
                        </div>
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
            var element = layui.element
                , $ = layui.jquery;

            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main-line'));
            var lirunChart = echarts.init(document.getElementById('lirun'));
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption({
                title: {
                    text: '销售图'
                },
                tooltip: {},
                legend: {
                    data: ['销量']
                },
                xAxis: {
                    data: [
                        @foreach($goods as $v)
                            "{{$v->goods_name}}",
                        @endforeach
                    ]
                },
                yAxis: {},
                dataZoom: [
                    {   // 这个dataZoom组件，默认控制x轴。
                        type: 'slider', // 这个 dataZoom 组件是 slider 型 dataZoom 组件
                        start: 10,      // 左边在 10% 的位置。
                        end: 60         // 右边在 60% 的位置。
                    }
                ],
                series: [{
                    name: '销量',
                    type: 'bar',
                    data: [
                        @foreach($goods as $v)
                        {{$v->sell}},
                        @endforeach
                    ]
                }
                ]
            });
            //利润表
            lirunChart.setOption({

                title: {
                    text: '总利润{{ $gosdsinfo["moneys"]}}元',
                    subtext: '纯利润',
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    type: 'scroll',
                    bottom: 3,
                    data: [
                        @foreach($goods as $v)
                            "{{$v->goods_name}}",
                        @endforeach
                    ]
                },
                series: [
                    {
                        name: '利润',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '50%'],
                        data: [
                            @foreach($goods as $v)
                                {value:{{$v->price}}, name: '{{$v->goods_name}}'},
                            @endforeach
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]

            });

        });
    </script>
@endsection