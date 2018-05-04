<template>

  <div>
    <link rel="stylesheet" type="text/css" href="static/css/index.css"/>
    <!--轮播图-->
    <swiper :options="swiperOption" ref="mySwiper" >
      <!-- slides -->
      <swiper-slide v-for="v in slides" :key="v.id">
        <router-link to="/video">
          <img :src="v.path">
        </router-link>
      </swiper-slide>

      <!-- Optional controls -->
      <div class="swiper-pagination"  slot="pagination"></div>

      <div class="swiper-scrollbar"   slot="scrollbar"></div>
    </swiper>
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
    <!--热门视频-->
    <h2>热门视频</h2>
    <div class="today">
      <div class="pic">
        <a href=""><img src="static/images/8.jpg"/></a>
        <a href=""><img src="static/images/9.jpg"/></a>
        <a href=""><img src="static/images/10.jpg"/></a>
      </div>
    </div>
    <!--热门视频结束-->

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
        slides:[
            {id:1,path:'static/images/1.jpg'},
            {id:2,path:'static/images/2.jpg'},
            {id:3,path:'static/images/3.jpg'},
        ],
        swiperOption: {
            autoplay: true,//自动切换
            effect : 'fade',//切换效果
            //滚动监视
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                snapOnRelease: false,
            },
        },
    }
  }
}
</script>

<style scoped>

</style>
