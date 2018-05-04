<template>

  <div>
    <link rel="stylesheet" type="text/css" href="static/css/index.css"/>
    <!--轮播图-->
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href=""><img src="static/images/1.jpg"/></a>
        </div>
        <div class="swiper-slide">
          <a href=""><img src="static/images/2.jpg"/></a>
        </div>
        <div class="swiper-slide">
          <a href=""><img src="static/images/3.jpg"/></a>
        </div>
      </div>
      <!-- 如果需要分页器 -->
      <div class="swiper-pagination"></div>
    </div>
    <!--轮播图结束-->

    <!--推荐视频-->
    <h2>推荐视频</h2>

    <div id="recommend">
      <a href="">
        <img src="static/images/4.jpg" alt="" />
        <i class="iconfont icon-bofang"></i>
        <span class="time">22:56</span>
        <span class="title">谷歌：没有扫描仪也能</span>
      </a>
      <a href="">
        <img src="static/images/5.jpg" alt="" />
        <i class="iconfont icon-bofang"></i>
        <span class="time">22:56</span>
        <span class="title">谷歌：没有扫描仪也能</span>
      </a>
      <a href="">
        <img src="static/images/6.jpg" alt="" />
        <i class="iconfont icon-bofang"></i>
        <span class="time">22:56</span>
        <span class="title">谷歌：没有扫描仪也能</span>
      </a>
      <a href="">
        <img src="static/images/7.jpg" alt="" />
        <i class="iconfont icon-bofang"></i>
        <span class="time">22:56</span>
        <span class="title">谷歌：没有扫描仪也能</span>
      </a>
    </div>
    <!--推荐视频结束-->
    <a href="" class="more">MORE ></a>
    <!--今日推荐-->
    <h2>今日推荐</h2>

    <div class="today">
      <a href="" class="title">大数据下的广告：精准投放与精准消除</a>
      <p class="column">网络资讯</p>
      <div class="pic">
        <a href=""><img src="static/images/8.jpg"/></a>
        <a href=""><img src="static/images/9.jpg"/></a>
        <a href=""><img src="static/images/10.jpg"/></a>
      </div>
    </div>
    <!--今日推荐结束-->

    <!--底部固定导航-->
    <ul id="bottom">
      <li class="cur">
        <router-link to ='/'>
            <i class="iconfont icon-shouyeshouye"></i>
            <span>首页</span>
        </router-link>
      </li>
      <li>
        <router-link to ='/Video'>
          <i class="iconfont icon-icon02"></i>
          <span>视频</span>
        </router-link>
      </li>
    </ul>
    <!--底部固定导航结束-->

  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
    }
  }
}
</script>

<style scoped>

</style>
