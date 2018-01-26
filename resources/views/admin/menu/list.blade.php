@extends('layouts.admin')
@section('css')
    <!-- Select2 -->
    <link href="{{ asset('/backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- nestable 后台拖拽菜单css-->
    <link href="{{ asset('/backend/vendors/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">
@endsection
@section('content')
    {{--页面逻辑处理类--}}
    @inject('menus','App\Repositories\Presenter\MenuPresenter')
    <div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>菜单系统</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-12 col-sm-12 col-xs-12">
        @include('flash::message')
            <!-- left panel -->
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>菜单管理 <small>菜单排序、添加、删除、分组</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content bs-example-popovers">
                        <div class="dd" id="nestable_list_3">
                            <ol class="dd-list">
                                {!! $menus->getMenuList($menuList) !!}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end left panel -->
            <!-- right panel添加菜单 -->
            @permission(config('admin.permissions.menu.add'))
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>菜单数据 <small>添加菜单项</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br/>
                        <form class="form-horizontal form-label-left" id="menuForm" action="{{url('admin/menu')}}" method="post">
                            {!!csrf_field()!!}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单名称</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="请输入菜单名称">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单图标</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="icon" value="{{old('icon')}}" placeholder="请输入菜单图标">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">父级菜单</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="select2_single form-control" name="parent_id"  tabindex="-1"  >
                                        {!! $menus->getMenu($menu) !!}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单权限</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="slug" value="{{old('slug')}}" placeholder="请输入菜单权限">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单高亮</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="heightlight_url" value="{{old('heightlight_url')}}" placeholder="请输入菜单高亮">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单连接</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="url" value="{{old('url')}}" placeholder="请输入菜单连接">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">排序</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="sort" value="{{old('sort')}}" placeholder="排序">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endpermission
            <!-- end right panel -->
        </div>
    </div>
</div>
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{ asset('/backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- nestable 后台拖拽菜单js-->
    <script src="{{ asset('/backend/vendors/jquery-nestable/jquery.nestable.js')}}"></script>
    {{--菜单添加、修改、删除的js--}}
    <script src="{{ asset('/backend/js/menu/menu-list.js')}}"></script>
    <script>
        $(document).ready(function() {
            MenuList.init();
        });
    </script>
    <!-- nestable end 后台拖拽菜单js-->
@endsection
