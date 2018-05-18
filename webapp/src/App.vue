<template>
  <div id="app">
      <transition enter-active-class="flipInY animated"> <!--给是所有页面加上过度动画-->
         <router-view></router-view>
      </transition>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
