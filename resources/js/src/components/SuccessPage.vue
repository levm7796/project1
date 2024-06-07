<template>
  <HeaderPart></HeaderPart>
  <div class="container">
    <div class="container_title">Thank you for buy</div>
    <a href="/" class="container_link">Go To Shop</a>
  </div>
</template>

<script>
import vueCookies from "vue-cookies";
import axios from "axios";
import HeaderPart from "./HeaderPart.vue";
export default {
  name: "successPage",
  components: {
    HeaderPart
  },
  mounted() {
    axios.defaults.withXSRFToken = true
    let id = vueCookies.get('orderId')
    axios.post('http://localhost:8000/updateOrder', {
      id: id
    }, {withCredentials: true})
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
@import url('https://fonts.cdnfonts.com/css/beatrice-display-trial');
html {
  box-sizing: border-box;
}
*, *::before, *::after {
  box-sizing: inherit;
}

.header {
  margin-top: 50px
}

body {
  margin: 0;
  padding: 0 50px 0 50px;
}

.container {
  margin-left: auto;
  margin-right: auto;
  margin-top: 100px;
}

.container_title {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
  font-size: 40px;
  font-weight: 600;
}

.container_link {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 20px;
  margin-top: 300px;
}
</style>