<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{--不在使用--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')


    <!-- Bootstrap -->
    <link href="{{asset('/backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('/backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('/backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('/backend/vendors/animate/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('/backend/build/css/custom.min.css')}}" rel="stylesheet">

</head>
<body class="login">
<div id="app">
    @yield('content')
</div>
<script src="{{asset('/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{asset('/backend/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
{{--layer--}}
<script src="{{asset('/backend/vendors/layer/layer.js')}}"></script>
@yield('js')
</body>
</html>