<template>
  <div id="app">
      <transition enter-active-class="flipInY animated">
         <router-view></router-view>
      </transition>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
