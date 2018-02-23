@inject('menu',' App\Repositories\Presenter\MenuPresenter')
{{--侧边导航--}}
<div class="col-md-3 left_col">
    {{--侧边导航--}}
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>后台管理系统</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info 侧边导航头部 -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{url('backend/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>欢迎管理员:</span>
                <h2>{{ Auth::user()->getUserData->nickname}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br><br>
        <!-- sidebar menu 侧边导航主体-->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <br>
            <div class="menu_section" >
                <h3>后台管理</h3>
                <ul class="nav side-menu">
                    {!!$menu->sidebarMenus($sidebarMenus)!!}
                </ul>
            </div>
            <div class="menu_section">
                <h3>网站配置</h3>

            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons 侧边导航底部按钮 -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
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
                        <img src="{{url('backend/images/img.jpg')}}" alt="">{{Auth::user()->getUserData->nickname}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">

                        <li><a href="{{ route('userdata',array('id'=>Auth::user()->id))}}">个人信息</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
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
                                <span class="image"><img src="{{url('backend/images/img.jpg')}}" alt=""></span>
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