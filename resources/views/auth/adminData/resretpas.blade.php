@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>修改密码</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @include('flash::message')
                            <form class="layui-form layui-form-pane" action="{{url('admin/home',[Auth::user()->getUserData->id])}}" method="post">
                                {{csrf_field()}}
                        {{--       防止用户恶意修改表单id，如果id不一致直接跳转500--}}
                                <input type="hidden" name="id" value="{{Auth::user()->getUserData->id}}">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">原始密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="password" lay-verify="required" placeholder="请输入原始密码"  autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">新密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="newPassword" lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">确认密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="cnewPassword" lay-verify="required" placeholder="请输入确认密码" autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-submit=""  lay-filter="demo2">修改密码</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{--菜单添加、修改、删除的js--}}
    <script src="{{ asset('/backend/js/home/userdata.js')}}"></script>
    <script>
        //            开始加载
        $(function () {
            UserData.init();
        });
    </script>
@endsection