@extends('layouts.mobileApp')
@section('title')
    <title>ceshi</title>
@endsection
@section('content')
    <div id="app">
        <jspang>
            <span slot="bolgUrl">@{{jspangData.bolgUrl}}</span>
            <span slot="netName">测试</span>
            <span slot="skill">@{{jspangData.skill}}</span>
        </jspang>
    </div>
    <template id="tmp">
        <div>
            <p>博客地址：<slot name="bolgUrl"></slot></p>
            <p>网名：<slot name="netName"></slot></p>
            <p>技术类型：<slot name="skill"></slot></p>
        </div>
    </template>
@endsection
@section('js')
    <script type="text/javascript">
        var jspang={
            template:'#tmp'
        }
        var app=new Vue({
            el:'#app',
            data:{
                jspangData:{
                    bolgUrl:'http://jspang.com',
                    netName:'技术胖',
                    skill:'Web前端'
                }
            },
            components:{
                "jspang":jspang
            }
        })
    </script>
@endsection






