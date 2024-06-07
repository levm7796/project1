<template>
  <HeaderPart/>
  <form action="" class="form">
    <h1 class="form_title">Find account</h1>
    <div class="form_email">
      <input type="email" placeholder="Email" id="email" class="form_input">
    </div>
    <div id="error" class="form_alert"></div>
    <div class="container_already" id="already">We send link to your email!</div>
    <button type="button" class="form_button" v-on:click="send()">find</button>
  </form>
</template>

<script>
import axios from "axios";
import HeaderPart from "./HeaderPart.vue";

export default {
  name: "ResetPassword",
  components: {
    HeaderPart
  },
  methods: {
    async send() {
      let email = document.getElementById('email').value
      axios.defaults.withXSRFToken = true

      await axios.get("http://localhost:8000/sanctum/csrf-cookie")

      await axios.post("http://localhost:8000/setToken", {
        email: email
      }, {withCredentials: true})
          .then(res => {
            res = res.data
            if(res.error) {
              document.getElementById('already').style.display = 'none'
              document.getElementById('error').style.display = 'block'
              document.getElementById('error').innerText = res.error
            } else {
              document.getElementById('error').style.display = 'none'
            document.getElementById('email').value = ''
            document.getElementById('already').style.display = 'block'
            }
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

.form {
  margin-left: 50px;
  margin-top: 10px
}

.form_title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 30px;
  font-weight: 600;
}

.form_input {
  font-family: 'Beatrice Deck Trial', sans-serif;
  height: 39px;
  width: 461px;
  margin-bottom: 14px;
  border: 1px solid #D9D9D9;
  margin-right: -19px;
  padding-left: 22px;
}

.form_button {
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

.form_alert {
  margin-top: 5px;
  margin-bottom: 5px;
  display: none;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: #ff2323;
}

.container_already {
  display: none;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: #27ff00;
  font-size: 14px;
}
</style>