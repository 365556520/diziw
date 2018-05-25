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
/*MintUI*/
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
Vue.use(MintUI)
/*MintUI end*/

/*自定义全局变量*/
import global from './components/config/Global'//引用文件
Vue.prototype.GLOBAL = global//挂载到Vue实例上面
/*自定义全局变量end*/
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
