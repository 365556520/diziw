<template>
  <div>
    <!--视频-->
    <video :src="current.path"  controls="controls" poster="static/images/510.jpg"></video>
    <!--视频结束-->

    <h1>10 导航条样式的设置</h1>

    <ul id="list">
      <li v-for="v in videos" :class="{'cur':active === v.id}" :key="v.id"><a href="" @click.prevent="play(v)">{{v.name}}</a></li>
    </ul>


    <!--返回按钮-->
    <router-link  class="iconfont back" to="/Video">&#xe612;</router-link>
  </div>
</template>
<script>
export default {
  name: 'Page',
  mounted(){
      let videoClass_id = this.$route.params.videoclasssid;//获取传送过来的系列视频的id
      this.axios.get('http://diziw.dev/api/videos/'+videoClass_id).then((response) => {
          console.log(response);
          if(response.status != 200 && response.data.code != 200 ){
              alert("获取视频信息失败");
          }else {
              this.videos = response.data.data;
              //默认视频
              this.current = this.videos[0];
              this.active = this.videos[0].id;
          }
      })
    },
    data () {
      return {
          //视频列表
          videos:[],
          //当前视频
          current:{},
          //视频状态
          active:'',
      }
    },
    methods:{
      play(video){
          //把id给视频状态
          this.active =video.id;
          //更改播放视频连接
          this.current=video;
      }
    }
}
</script>
<style scoped>
  * {
    padding: 0;
    margin: 0;
    color: #31343B;
  }

  a {
    text-decoration: none;
    color: #31343B;
  }

  li {
    list-style: none;
  }

  body {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    /*padding-bottom: 15%;*/
  }


  /*底部固定导航*/
  #bottom {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    background: #FFFFFF;
    margin: 0;
  }

  #bottom li {
    width: 50%;
    box-sizing: border-box;
  }

  #bottom li i.iconfont {
    color: #888;
    font-size: 6vw;
    display: block;
    text-align: center;
  }

  #bottom li span {
    font-size: 2.6vw;
    display: block;
    text-align: center;
    color: #888;
  }

  #bottom li.cur {
    /*background: #333;*/
  }

  #bottom li.cur i.iconfont {
    color: #333;
  }

  #bottom li.cur span {
    color: #333;
  }
  /*底部固定导航结束*/


  video{
    width: 100%;

  }
  h1{
    font-size: 4.5vw;
    line-height: 2em;
    color: #31343B;
    text-indent: 2em;
    margin: 0;
    font-weight: 700;
  }
  #list{
    /*width: 92%;*/
    /*margin: 0 auto;*/
    border-top: #EFEFF4 5px solid;
    padding-top: 2%;
  }
  #list li a{
    font-size: 3.8vw;
    color: #666;
    line-height: 2.8em;
    display: block;
    margin-left: 6%;
    border-left: 1px dotted #999;
    text-indent: 1em;
    position: relative;
  }
  #list li a:before{
    content: '';
    width: 10px;
    height: 10px;
    background: #ccc;
    position: absolute;
    left: -6px;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;


  }
  #list li.cur a{
    color: #333;
    font-weight: 700;

  }

  a.iconfont.back{
    font-size: 9vw;
    /*color: #888;*/
    color: deepskyblue;
    position: fixed;
    right: 6%;
    bottom: 3%;
  }

</style>
