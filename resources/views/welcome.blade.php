@extends('layouts.auth')
@section('title')
    <title>ceshi</title>
    <style>
        body { font-family: "Microsoft YaHei"; }
        .page {max-width:1024px;margin:0 auto;}
        h1 { font-weight: normal; color:#333;}
        a { color: #006eff; background-color: transparent; padding: 8px 16px; line-height: 1.3; display: inline-block; text-align: center; margin: 0 8px 8px 0; border: 1px solid #006eff; font-size: 14px; text-decoration: none; }
        a:hover { color: #fff; background-color: #006eff; }
        .result {display:none;line-height:1.3;font-size: 13px;font-family:monospace;border:1px solid #006eff;margin:0;height:200px;overflow:auto;box-sizing:border-box;padding:5px;}
    </style>
@endsection
@section('content')
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
        </div>
    @endif
    <div id="app">
        <p>@{{ message }}</p>
        <p>@{{ ceshi }}</p>
        <button v-on:click="reverseMessage">逆转消息</button>
        <input v-model="message">
            <ol>
                <!--
                  现在我们为每个 todo-item 提供 todo 对象
                  todo 对象是变量，即其内容可以是动态的。
                  我们也需要为每个组件提供一个“key”，稍后再
                  作详细解释。
                -->
                <todo-item
                        v-for="item in groceryList"
                        v-bind:todo="item"
                        v-bind:key="item.id">
                </todo-item>
            </ol>


            <div class="page-header" v-for="(v,k) in videos">
                <div class="form-group">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="password_confirmation" v-model="v.ti"   class="layui-input">
                    </div>
                </div>
                <div class="form-group">
                    <label class="layui-form-label">label</label>
                    <div class="layui-input-inline">
                        <input type="text" name="password_confirmation" v-model="v.pa"  class="layui-input">
                    </div>
                </div>
                <button class="layui-btn" @click ="del(k)">删除</button>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn"  @click ="add">添加</button>
            </div>
        <textarea> @{{videos}}</textarea>
    </div>

    <div class="page">
        <h1>cos-js-sdk-v5</h1>
        <div class="main" ><a id="main" href="javascript:void(0)">uploadFiles</a></div>
        <pre class="result"></pre>
    </div>
@endsection
@section('js')
    {{--vue js--}}
    <script src="{{asset('/backend/myvebdors/vue/vue.js')}}"></script>
    {{--cosjs--}}
    <script src="{{asset('backend/myvebdors/cos-js-sdk-v5/dist/cos-js-sdk-v5.min.js')}}"></script>
    <script src="{{asset('backend/js/cos/demo.js')}}"></script>

    <script>




        Vue.component('todo-item', {
            props: ['todo'],
            template: '<li>@{{ todo.text }}</li>'
        });

        var app = new Vue({
            el: '#app',
            data: {
                message: '正序排列',
                ceshi:'测试数据',
                groceryList: [
                    { id: 0, text: '蔬菜' },
                    { id: 1, text: '奶酪' },
                    { id: 2, text: '随便其它什么人吃的东西' }
                ],
                videos: [{ti:'',pa:''}]
            },
            methods: {
                reverseMessage: function () {
                    this.ceshi = this.ceshi.split('').reverse().join('')
                },
                add:function () {
                    this.videos.push({ti:'',pa:''});
                },
                del:function (k) {
                    this.videos.splice(k,1);
                }
            }
        });

        $(function () {
            $('#main').click(function (e) {
                selectFileToUpload();
            })
        });
    </script>
@endsection






