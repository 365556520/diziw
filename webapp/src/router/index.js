import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import VideoHome from '@/components/VideoHome'
import Video from '@/components/Video'
import Page from '@/components/Page'

Vue.use(Router)

export default new Router({
  routes: [
      {
          path: '/',
          name: 'HelloWorld',
          component: HelloWorld
      },
      {
          path: '/VideoHome',
          name: 'VideoHome',
          component: VideoHome
      },
      {    /*这是视频标签如果有标签id就会获取该标签的所有视频如果没有就会获取所有视频*/
          path:'/Video/:id?',
          name:'Video',
          component: Video
      },
      {   /*系列视频*/
          path:'/Page/:videoclasssid',
          name:'Page',
          component: Page
      },
  ]
})
