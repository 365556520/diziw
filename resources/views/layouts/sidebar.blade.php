@inject('menu',' App\Repositories\Presenter\MenuPresenter')
{{--侧边导航--}}
<div class="col-md-3 left_col">
    {{--旧的改版后不用的--}}
    {{--侧边导航--}}
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>后台管理系统</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info 侧边导航头部 -->
        <div class="profile">
            <div class="profile_pic">
                <a  href="{{route('showheadimg') }}"><img src="@if(empty(Auth::user()->getUserData->headimg)){{url('backend/images/img.jpg')}}@else{{url(Auth::user()->getUserData->headimg)}}@endif" alt="..." class="img-circle profile_img"></a>
            </div>
            <div class="profile_info">
                <span>欢迎管理员:</span>
                <h2>{{  Auth::user()->name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br><br>
        <!-- sidebar menu 侧边导航主体-->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <br>
            <div class="menu_section" >
                <br><br>
                <ul class="nav side-menu">
                    {!!$menu->sidebarMenus($sidebarMenus)!!}
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons 侧边导航底部按钮 -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="系统设置">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" href="{{url('admin/menu')}}" data-original-title="菜单管理">
                <span class="fa fa-navicon" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" onclick="fullScreen()" data-original-title="进入全屏">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="退出" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation 顶部导航-->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="@if(empty(Auth::user()->getUserData->headimg)){{url('backend/images/img.jpg')}}@else{{url(Auth::user()->getUserData->headimg)}}@endif" alt="">{{ Auth::user()->name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{route('resetPas')}}">修改密码</a></li>
                        <li><a href="{{ url('/admin/home/'.Auth::user()->id.'/edit')}}">个人信息</a></li>
                        <li>
                            <a href="{{route('showheadimg') }}">修改头像</a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i>
                                退出
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">1</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="@if(empty(Auth::user()->getUserData->headimg)){{url('backend/images/img.jpg')}}@else{{url(Auth::user()->getUserData->headimg)}}@endif" alt=""></span>
                                <span>
                                      <span>{{ Auth::user()->name }}</span>
                                      <span class="time">3分钟</span>
                                 </span>
                                <span class="message">未读消息</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script>

    // 全屏代码
    function fullScreen() {
        var elem = document.body;
        if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.requestFullScreen) {
            elem.requestFullscreen();
        } else {
            notice.notice_show("浏览器不支持全屏API或已被禁用", null, null, null, true, true);
        }
    }
    function exitFullScreen() {
        var elem = document;
        if (elem.webkitCancelFullScreen) {
            elem.webkitCancelFullScreen();
        } else if (elem.mozCancelFullScreen) {
            elem.mozCancelFullScreen();
        } else if (elem.cancelFullScreen) {
            elem.cancelFullScreen();
        } else if (elem.exitFullscreen) {
            elem.exitFullscreen();
        } else {
            notice.notice_show("浏览器不支持全屏API或已被禁用", null, null, null, true, true);
        }
    }

</script>