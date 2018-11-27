<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- 用Bootstrap做内容布局用的是 -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('title')
        <!-- Bootstrap -->
        <link href="{{ asset('/backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('/backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('/backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        {{--layui-v2.2.5--}}
        <link href="{{ asset('/backend/myvebdors/layui/layui/css/layui.css')}}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('/backend/build/css/custom.min.css')}}" rel="stylesheet">

        @yield('css')
    </head>
    <body style="background-color:#eee">
        <!-- page content 主页内容-->
        <div class="right_col" role="main"  >
            @yield('content')
        </div>
        <!-- jQuery -->
        <script src="{{ asset('/backend/vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/backend/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset('/backend/vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{ asset('/backend/vendors/nprogress/nprogress.js')}}"></script>
        {{--layer--}}
        <script src="{{asset('/backend/myvebdors/layer/layer.js')}}"></script>
        {{--vue js--}}
        <script src="{{asset('/backend/myvebdors/vue/vue.js')}}"></script>
        <!--用的这个模板js -->
        <script src="{{ asset('/backend/build/js/custom.min.js')}}"></script>
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