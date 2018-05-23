<template>

  <div>
    <link rel="stylesheet" type="text/css" href="static/css/index.css"/>
    <!--轮播图-->
    <swiper :options="swiperOption" ref="mySwiper" >
      <!-- slides -->
      <swiper-slide v-for="v in slides" :key="v.id">
        <router-link to="/video">
          <img :src="v.preview">
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
      <router-link :to="{params:{videoclasssid:v.id},name:'Page'}" v-for="v in commendvideo" :key="v.id" >
        <img :src="v.preview"  />
        <i class="iconfont icon-bofang"></i>
        <span class="time">22:56</span>
        <span class="title">{{v.title}}</span>
      </router-link>
    </div>
    <!--推荐视频结束-->
    <a href="" class="more">MORE ></a>
    <!--热门视频-->
    <h2>热门视频</h2>
    <div class="today">
      <div class="pic">
        <router-link :to="{name:'Page',params:{videoclasssid:v.id}}" v-for="v in hotvideo" :key="v.id"  >
          <img :src="v.preview" />
        </router-link>
      </div>
    </div>
    <!--热门视频结束-->

    <!--底部固定导航-->
    <ul id="bottom">
      <li class="cur">
        <router-link to ='/VideoHome'>
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
  name: 'VideoHome',
  mounted(){ //这个挂在第一次进入页面后运行一次
      this.axios.get(this.GLOBAL.serverSrc+'api/commendvideoclass/4').then((response) => {
          this.commendvideo = response.data.data;
          this.slides = response.data.data;
          console.log(response.data)
      }),
      this.axios.get(this.GLOBAL.serverSrc+'api/hotvideoclass/3').then((response) => {
          this.hotvideo = response.data.data;
          console.log(response.data)
      })
  },
  data () {
    return {
        //推荐视频
        commendvideo:[],
        //热门视频
        hotvideo:[],
        //轮播图
        slides:[],
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
