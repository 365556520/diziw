@inject('menu',' App\Repositories\Presenter\AdminMenuPresenter')
<!-- Font Awesome字体和图标 -->
<link href="{{ asset('/backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- layout admin -->
<div class="layui-layout layui-layout-admin"> <!-- 添加skin-1类可手动修改主题为纯白，添加skin-2类可手动修改主题为蓝白 -->
    <!-- header -->
    <div class="layui-header my-header">
        <a href="index.html">
            <!--<img class="my-header-logo" src="" alt="logo">-->
            <div class="my-header-logo">后台模板 HTML</div>
        </a>

        <!-- 顶部左侧添加选项卡监听 -->
        <ul class="layui-nav" lay-filter="side-top-left">
            {{--左侧菜单伸缩--}}
            <li class="layui-nav-item">
                <a class="btn-nav"><i class="fa fa-dedent" style="font-size:20px"></i></a>
            </li>

        {{--    <li class="layui-nav-item"><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="layui-icon">&#xe621;</i>基础</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                    <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                </dl>
            </li>--}}
        </ul>

        <!-- 顶部右侧添加选项卡监听 -->
        <ul class="layui-nav my-header-user-nav" lay-filter="side-top-right">
            <li class="layui-nav-item"><a href="javascript:;" class="pay" href-url="">支持作者</a></li>
            <li class="layui-nav-item">
                <a class="name" href="javascript:;"><i class="layui-icon">&#xe629;</i>主题</a>
                <dl class="layui-nav-child">
                    <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                    <dd data-skin="1"><a href="javascript:;">纯白</a></dd>
                    <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="name" href="javascript:;">
                    <img src="@if(empty(Auth::user()->getUserData->headimg)){{url('backend/images/img.jpg')}}@else{{url(Auth::user()->getUserData->headimg)}}@endif" class="layui-circle layui-nav-img">
                    {{ Auth::user()->name}}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" href-url="{{route('showheadimg') }}"><i class="layui-icon">&#xe621;</i>修改图像</a></dd>
                    <dd><a href="javascript:;" href-url="{{route('resetPas')}}"><i class="layui-icon">&#xe621;</i>修改密码</a></dd>
                    <dd><a href="javascript:;" href-url="{{ url('/admin/home/'.Auth::user()->id.'/edit')}}"><i class="layui-icon">&#xe621;</i>个人信息</a></dd>
                    <dd>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="layui-icon">&#x1006;</i>
                            退出
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </dd>
                </dl>
            </li>
        </ul>

    </div>
    <!-- side -->
    <div class="layui-side my-side">
        <div class="layui-side-scroll ">
            <!-- 左侧主菜单添加选项卡监听 -->
            <ul class="layui-nav layui-nav-tree" lay-filter="side-main">
                {!!$menu->sidebarMenus($sidebarMenus)!!}
            </ul>
        </div>
    </div>

    <!-- body -->
    <div class="layui-body my-body">
        <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="1"><span><i class="layui-icon">&#xe638;</i>欢迎页</span></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe id="iframe" src="{{url('admin/welcome')}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="layui-footer my-footer">
        <p><a href="http://vip-admin.com" target="_blank">vip-admin后台模板v1.8.0</a>&nbsp;&nbsp;&&nbsp;&nbsp;<a href="http://vip-admin.com/index/gather/index.html" target="_blank">vip-admin管理系统v1.2.0</a></p>
        <p>2017 © copyright 蜀ICP备17005881号</p>
    </div>
</div>

<!-- pay -->
<div class="my-pay-box none">
    <div><img src="" alt="支付宝"><p>支付宝</p></div>
    <div><img src="" alt="微信"><p>微信</p></div>
</div>
<!-- 右键菜单 -->
<div class="my-dblclick-box none"></div>

