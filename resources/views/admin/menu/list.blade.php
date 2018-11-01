@extends('admin.layouts.content')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
    <!-- nestable 后台拖拽菜单css-->
    <link href="{{ asset('/backend/vendors/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">

@endsection
@section('content')
    {{--页面逻辑处理类--}}
    @inject('menus','App\Repositories\Presenter\AdminMenuPresenter')

    <div class="layui-row ">
        <div class="layui-col-md12 layui-col-sm12 layui-col-xs12">
        @include('flash::message')
            <!-- 菜单列表 -->
            <div class="layui-col-md6 layui-col-sm12 layui-col-xs12">
                <div >
                        <div class="dd" id="nestable_list_3">
                            <ol class="dd-list">
                                {!! $menus->getMenuList($menuList) !!}
                            </ol>
                        </div>
                </div>
            </div>
            <!-- end left panel -->
            <!-- right panel添加菜单 -->
            @permission(config('admin.permissions.menu.add'))
            <div class="layui-col-md6 layui-col-sm12 layui-col-xs12">

                        <form class="layui-form" id="menuForm" action="{{url('admin/menu')}}" method="post">
                            {!!csrf_field()!!}
                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.name')}}</label>
                                <div class="layui-input-block ">
                                    <input type="text" class="layui-input" name="name" value="{{old('name')}}" placeholder="请输入菜单名称">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.icon')}}</label>
                                <div class="layui-input-block ">
                                    <input type="text" class="layui-input" name="icon" value="{{old('icon')}}" placeholder="请输入菜单图标">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.pid')}}</label>
                                <div class="layui-input-block">
                                    <select class ='select_single' name="parent_id">
                                        {!! $menus->getMenu($menu) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.slug')}}</label>
                                <div class="layui-input-block ">
                                    <input type="text" class="layui-input" name="slug" value="{{old('slug')}}" placeholder="请输入菜单权限">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.active')}}</label>
                                <div class="layui-input-block ">
                                    <input type="text" class="layui-input" name="heightlight_url" value="{{old('heightlight_url')}}" placeholder="请输入菜单高亮">
                                </div>
                            </div>
                            

                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.url')}}</label>
                                <div class="layui-input-block">
                                    <input type="text" class="layui-input" name="url" value="{{old('url')}}" placeholder="请输入菜单连接">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">{{ trans('admin/menu.model.sort')}}</label>
                                <div class="layui-input-block ">
                                    <input type="text" class="layui-input" name="sort" value="{{old('sort')}}" placeholder="排序">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block  ">
                                    <button class="layui-btn" lay-submit="" type="submit"  lay-filter="tianjia">{{ trans('admin/menu.submit')}}</button>
                                </div>
                            </div>
                        </form>

            </div>
            @endpermission
            <!-- end right panel -->
        </div>
    </div>
@endsection
@section('js')
    <!-- nestable 后台拖拽菜单js-->
    <script src="{{ asset('/backend/vendors/jquery-nestable/jquery.nestable.js')}}"></script>
    {{--菜单添加、修改、删除的js--}}
    <script src="{{ asset('/backend/js/menu/menu-list.js')}}"></script>
    {{--提示代码--}}
    @include('component.errorsLayer')
    <script>
        $(document).ready(function() {
            MenuList.init();
        });

        layui.use(['form', ], function(){
            var form = layui.form
                ,layer = layui.layer;
        });

    </script>
    <!-- nestable end 后台拖拽菜单js-->
@endsection
