<template>
  <HeaderPart></HeaderPart>

  <form action="/" class="form login">
    <h1 class="login_title">Login</h1>
    <div class="form_email">
<!--      <label for="email">Email</label>-->
      <input type="text" placeholder="Email" id="email" class="login_input">
    </div>
    <div class="form_password" style="height: 45px;">
<!--      <label for="password">Password</label>-->
      <input type="password" placeholder="Password" id="password" class="login_input">
    </div>
    <a href="/resetPassword" style="color: black; margin-top: -10px">Forgot Password?</a>
    <div id="error" class="alert alert-danger login_alert" role="alert"></div>
    <button type="button" class="form_submit login_button" v-on:click="logIn()">Continue</button>
<!--    <RouterLink to="/resetPassword">Forgot password?</RouterLink>-->
  </form>
</template>

<script>
import axios from "axios";
import VueCookies from 'vue-cookies';
import HeaderPart from "./HeaderPart.vue";
export default {
name: "LoginPage",
  components: {
  HeaderPart
  },
  methods: {
    async logIn() {
      let email = document.getElementById('email').value
      let password = document.getElementById('password').value
      axios.defaults.withXSRFToken = true

      await axios.get('http://localhost:8000/api/sanctum/csrf-cookie')
      await axios.post("http://localhost:8000/api/login", {
        email: email,
        password: password,
      }, {withCredentials: true})
          .then(async res => {
            if(res.data.error !== undefined) {
              document.getElementById('error').style.display = 'block'
              document.getElementById('error').innerText = res.data.error
            } else {
              let token = await res.data.token
              console.log(token)
               let user = await axios.get('http://localhost:8000/api/user',
                   {
                     withCredentials: true,
                     'X-Requested-With': 'XMLHttpRequest',
                     headers: {
                       'Authorization': 'Bearer ' + token
                     }
                })
              VueCookies.set('user', user.data)
              window.location.href = '/'
            }
          });
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
@import url('https://fonts.cdnfonts.com/css/beatrice-display-trial');
/*font-family: "Beatrice Deck Trial Extrabold";*/
html {
  box-sizing: border-box;
}
*, *::before, *::after {
  box-sizing: inherit;
}
body {
  margin: 0;
  padding: 0 50px 0 50px;
  background-image: url("./src/assets/img/background.jpg");
  /*font-family: "Beatrice Deck Trial Extrabold";*/
}

.login_title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 30px;
  font-weight: 600;
}

.login {
  margin-left: 52px;
}

.login_input {
  font-family: 'Beatrice Deck Trial', sans-serif;
  height: 39px;
  width: 461px;
  margin-bottom: 14px;
  border: 1px solid #D9D9D9;
  margin-right: -19px;
  padding-left: 22px;
}

.login_button {
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

.login_alert {
  margin-top: 5px;
  margin-bottom: 5px;
  display: none;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: #ff2323;
}
</style>
