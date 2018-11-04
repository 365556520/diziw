<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        {{--主用layui--}}
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('title')
        <link rel="stylesheet" href="{{ asset('admin/frame/layui/css/layui.css')}}">
        <link rel="stylesheet" href="{{ asset('admin/frame/static/css/style.css')}}">
        @yield('css')
    </head>
    <body class="layui-bg-gray">
        <div class="container">
                <div class="right_col" role="main" style="min-height: 934px; ">
                    @yield('content')
                </div>
        </div>
        <!-- jQuery -->
        <script src="{{ asset('/backend/vendors/jquery/dist/jquery.min.js')}}"></script>
        {{--vue js--}}
        <script src="{{asset('/backend/myvebdors/vue/vue.js')}}"></script>
        <script type="text/javascript" src="{{ asset('admin/frame/layui/layui.js')}}"></script>
        @yield('js')
        <script>
            $(function() {
                //公共--自动为ajax请求自动添加csrf-token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
    </body>
</html>