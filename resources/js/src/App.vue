<template>
  <router-view></router-view>
<!--    <h1>hello world</h1>-->
</template>

<script>

export default {
  name: 'App',
  components: {
    // HeaderSite,
    // BodySite,
    // FooterSite
  },
  methods:{
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

body {
  overflow-x: hidden;
  margin: 0;
}

#app {
  height: 100vh;
  display: flex;
  flex-direction: column;
}
</style>
