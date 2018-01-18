<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>后台管理</title>
        <!-- Bootstrap -->
        <link href="{{ asset('/backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('/backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('/backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
          @yield('css')
        <!-- Custom Theme Style -->
        <link href="{{ asset('/backend/build/css/custom.min.css')}}" rel="stylesheet">

    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('layouts.sidebar')
                <!-- page content 主页内容-->
                <div class="right_col" role="main" style="min-height: 934px; ">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer content 主要内容页脚 -->
                <footer>
                    <div class="pull-right">
                        内容页脚 <a href="#">内容页脚</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{ asset('/backend/vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/backend/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset('/backend/vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{ asset('/backend/vendors/nprogress/nprogress.js')}}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('/backend/build/js/custom.min.js')}}"></script>
        @yield('js')
    </body>
</html>