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
                        @include('flash::message')
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form class="layui-form layui-form-pane" action="{{route('resetPas')}}" method="post">
                                {{csrf_field()}}
                                <div class="layui-form-item">
                                    <label class="layui-form-label">旧密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="original_password" lay-verify="required" placeholder="请输入原始密码"  autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">新密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="password" lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">确认密码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="password_confirmation" lay-verify="required" placeholder="请输入确认密码" autocomplete="off" class="layui-input">
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
    <script>
        //form提交
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>
    {{--错误信息--}}
    @include('component.errorsLayer')

@endsection