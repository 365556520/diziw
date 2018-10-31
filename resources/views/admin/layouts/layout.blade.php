<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>后台管理 | {{ env('APP_NAME') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('admin/frame/layui/css/layui.css')}}">
        <link rel="stylesheet" href="{{ asset('admin/frame/static/css/style.css')}}">
        <link rel="icon" href="{{ asset('admin/frame/static/image/code.png')}}">
    </head>
    <body>
     @include('admin.layouts.sidebar')
     <script type="text/javascript" src="{{ asset('admin/frame/layui/layui.js')}}"></script>
     <script type="text/javascript" src="{{ asset('admin/frame/static/js/vip_comm.js')}}"></script>
     <script type="text/javascript" src="{{ asset('admin/frame/static/js/vip_nav.js ')}}"></script>
    </body>
</html>
