// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

Vue.config.productionTip = false
/*vue-awesome-swiper轮播插件*/
import VueAwesomeSwiper from 'vue-awesome-swiper'
Vue.use(VueAwesomeSwiper)
/*vue-awesome-swiper轮播插件 end*/
/*vue-axios 接收服务器传过来数据的插件*/
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
/*vue-axios end*/


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
