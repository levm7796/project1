<template>
  <HeaderPart/>
  <div class="container">
    <div class="container_title">change password</div>
    <input class="container_input container_passwordInput" placeholder="New password" type="password">
    <input class="container_input container_passwordInput2" placeholder="Confirm password" type="password">
    <button class="container_button" v-on:click="changePassword">change</button>
  </div>
</template>

<script>
import {useRoute} from "vue-router";
import axios from "axios";
import HeaderPart from "./HeaderPart.vue";

export default {
  name: "SetPassword",
  components: {
    HeaderPart
  },
  data() {
    return {
      token: '',
      email: '',
    }
  },
  mounted() {
    const route = useRoute();
    this.token = route.params.token;
    this.email = route.params.email;
  },
  methods: {
    changePassword() {
      const password = document.querySelector('.container_passwordInput').value
      const confirmPassword = document.querySelector('.container_passwordInput2').value

      console.log(password)

      if(password !== confirmPassword) {
        return false
      }

      axios.defaults.withXSRFToken = true
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.post('http://localhost:8000/forgotPassword', {
        email: this.email,
        password: password,
        token: this.token
      }, {withCredentials: true})
          .then(async res=>{
            window.location.href = '/login'
          })
    }
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

.container_title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 30px;
  font-weight: 600;
}

.container_input {
  font-family: 'Beatrice Deck Trial', sans-serif;
  height: 39px;
  width: 461px;
  margin-bottom: 14px;
  border: 1px solid #D9D9D9;
  margin-right: -19px;
  padding-left: 22px;
}

.container_button {
  width: 238px;
  height: 45px;
  border: none;
  background: #D9D9D9;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  margin-top: 20px;
}

.container_alert {
  margin-top: 5px;
  margin-bottom: 5px;
  display: none;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: #ff2323;
}

.container {
  display: flex;
  flex-direction: column;
  width: 461px;
  margin-left: 50px;
  margin-top: 10px;
}
</style>