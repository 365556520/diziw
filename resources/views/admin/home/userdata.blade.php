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
                        <div class="col-md-3 col-xs-12 widget widget_tally_box">
                            <div class="x_panel fixed_height_390">
                                <div class="x_content">

                                    <div class="flex">
                                        <ul class="list-inline widget_profile_box">
                                            <li>
                                                <a  data-toggle="tooltip" data-placement="top" title="{{Auth::user()->getUserData->qq}}">
                                                    <i class="fa fa-qq" ></i>
                                                </a>
                                            </li>
                                            <li>
                                                <img src="{{url(Auth::user()->getUserData->headimg)}}" alt="..." class="img-circle profile_img">
                                            </li>
                                            <li>
                                                <a data-toggle="tooltip" data-placement="top" title="{{Auth::user()->getUserData->ipone}}">
                                                    <i class="fa fa-mobile"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <h3 class="name">{{Auth::user()->getUserData->nickname}}</h3>

                                    <div class="flex">
                                        <ul class="list-inline count2">
                                            <li>
                                                <h3>账号</h3>
                                                <span>{{Auth::user()->username}}</span>
                                            </li>
                                            <li>
                                                <h3>性别</h3>
                                                <span>{{Auth::user()->getUserData->sex}}</span>
                                            </li>
                                            <li>
                                                <h3>年龄</h3>
                                                <span>{{Auth::user()->getUserData->age}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="pull-left">角色:
                                            @foreach($user->role as $v)
                                                {{$v->display_name}}
                                            @endforeach
                                        </div><br>
                                        <div class="pull-left">联系方式</div>
                                        <div class="pull-left">手机: {{Auth::user()->getUserData->ipone}}</div><br>
                                        <div class="pull-left">QQ: {{Auth::user()->getUserData->qq}}</div><br>
                                        <div class="pull-left">住址: {{Auth::user()->getUserData->address}}</div><br>
                                        <div class="pull-left">兴趣: {{Auth::user()->getUserData->hobby}}</div><br>
                                        <div class="pull-left">个性签名: {{Auth::user()->getUserData->Readme}}</div><br>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () { $("[data-toggle='tooltip']").tooltip(); });
    </script>
@endsection