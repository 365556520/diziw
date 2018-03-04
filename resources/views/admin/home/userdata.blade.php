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
                        <h2>个人信息</h2>
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
                                {{method_field('PUT')}}
                        {{--       防止用户恶意修改表单id，如果id不一致直接跳转500--}}
                                <input type="hidden" name="id" value="{{Auth::user()->getUserData->id}}">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">昵称</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="nickname" lay-verify="required" placeholder="请输入" value="{{Auth::user()->getUserData->nickname}}" autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">年龄</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="age" lay-verify="required" placeholder="请输入" value="{{Auth::user()->getUserData->age}}" autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item" pane="">
                                    <label class="layui-form-label">性别</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="sex" value=1 title="男" @if(Auth::user()->getUserData->sex == 1)checked=""@endif>
                                        <input type="radio" name="sex" value=0 title="女"  @if(Auth::user()->getUserData->sex == 0)checked=""@endif>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">验证手机</label>
                                    <div class="layui-input-block">
                                        <input type="tel" name="ipone" lay-verify="required|phone" value="{{Auth::user()->getUserData->ipone}}"  placeholder="请输入手机号" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">QQ</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="qq" lay-verify="title" autocomplete="off" value="{{Auth::user()->getUserData->qq}}"  placeholder="请输入QQ号码" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">联系地址</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="address"  placeholder="请输入联系地址" value="{{Auth::user()->getUserData->address}}" autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">爱好</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="hobby"  placeholder="请输入联系地址" value="{{Auth::user()->getUserData->hobby}}" autocomplete="off" class="layui-input">
                                    </div>
                                </div>


                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">个性签名</label>
                                    <div class="layui-input-block">
                                        <textarea placeholder="请输入内容" name="Readme" class="layui-textarea">{{Auth::user()->getUserData->Readme}}</textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-submit=""  lay-filter="demo2">修改信息</button>
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