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


    <div>
        <h1>Ajax Post 上传</h1>
        <input id="fileSelector" type="file">
        <input id="submitBtn" type="submit">
        <div id="msg"></div>
    </div>


@endsection
@section('js')
    <script src="{{asset('/backend/myvebdors/vue/vue.js')}}"></script>
    {{--cosjs--}}
    <script src="{{asset('backend/myvebdors/cos-js-sdk-v5/dist/cos-js-sdk-v5.min.js')}}"></script>

    <script>

        $(function () {
            // 请求用到的参数
            var Bucket = 'diziw-1251899486';
            var Region = 'ap-beijing';
            var protocol = location.protocol === 'https:' ? 'https:' : 'http:';
            var prefix = protocol + '//' + Bucket + '.cos.' + Region + '.myqcloud.com/';

            // 计算签名
            var getAuthorization = function (options, callback) {
                var method = (options.Method || 'get').toLowerCase();
                var key = options.Key || '';
                // var url = 'http://127.0.0.1:3000/sts-post-object' +
                var url = '{{Url("admin/video/uploadvideo")}}' +
                    '?method=' + method +
                    '&pathname=' + encodeURIComponent('/') +
                    '&key=' + encodeURIComponent(key);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.onload = function (e) {
                    var data = JSON.parse(e.target.responseText);
                    if (data.authorization === '') {

                    }
                    callback(null, {
                        Authorization: data.authorization,
                        XCosSecurityToken: data.sessionToken,
                    });
                };
                xhr.onerror = function (e) {
                    callback('获取签名出错');
                };
                xhr.send();
            };

            // 上传文件
            var uploadFile = function (file, callback) {
                var Key = 'dir/' + file.name; // 这里指定上传目录和文件名

                getAuthorization({Method: 'get', Key: Key}, function (err, info) {
                    var auth = info.Authorization;
                    var XCosSecurityToken = info.XCosSecurityToken;

                    var fd = new FormData();
                    fd.append('key', Key);
                    fd.append('Signature', auth);
                    XCosSecurityToken && fd.append('x-cos-security-token', XCosSecurityToken);
                    fd.append('file', file);
                    var url = prefix;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', url, true);
                    xhr.onload = function () {
                        if (Math.floor(xhr.status / 100) === 2) {
                            var ETag = xhr.getResponseHeader('etag');
                            callback(null, {url: url, ETag: ETag});
                        } else {
                            callback('文件 ' + Key + ' 上传失败，状态码：' + xhr.status);
                        }
                    };
                    xhr.onerror = function () {
                        callback('文件 ' + Key + ' 上传失败，请检查是否没配置 CORS 跨域规则');
                    };
                    xhr.send(fd);

                });
            };

            // 监听表单提交
            document.getElementById('submitBtn').onclick = function (e) {
                var file = document.getElementById('fileSelector').files[0];
                if (!file) {
                    document.getElementById('msg').innerText = '未选择上传文件';
                    return;
                }
                file && uploadFile(file, function (err, data) {
                    console.log(err || data);
                    document.getElementById('msg').innerText = err ? err : ('上传成功，ETag=' + data.ETag);
                });
            };
        });

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






