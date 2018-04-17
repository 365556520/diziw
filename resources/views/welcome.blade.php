@extends('layouts.auth')
@section('title')
    <title>ceshi</title>
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

@endsection
@section('js')
    <script src="{{asset('/backend/myvebdors/vue/vue.js')}}"></script>
    {{--cosjs--}}
    <script src="{{asset('backend/myvebdors/cos-js-sdk-v5/dist/cos-js-sdk-v5.min.js')}}"></script>
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
        })
    </script>
@endsection






