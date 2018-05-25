<template>
  <div class="hello">
    <mt-button @click.native="handleClick">按钮</mt-button>
  </div>
</template>

<script>
  export default {
    name: 'HelloWorld',
    data () {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
      methods: {
          handleClick: function() {
              this.$toast('Hello world!');
          }
      }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
