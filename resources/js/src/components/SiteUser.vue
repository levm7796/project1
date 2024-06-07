<template>
  <HeaderPart></HeaderPart>

<div class="container">
  <div class="container-name">NAME: {{ this.user.name }}</div>
  <div class="container-email">EMAIL: {{ this.user.email }}</div>


  <button class="container-button" v-on:click="changePasswordForm">change password</button>

  <div id="changePasswordForm" style="display: none; flex-direction: column">
    <input type="password" placeholder="Old password" id="oldPassword" class="form-input">
    <input type="password" placeholder="New password" id="newPassword" class="form-input">
    <div id="alertError" style="display: none"></div>
    <button v-on:click="changePassword" class="form-button">Change</button>
    <a href="/user" style="margin-left: 2px; color: white;">Cancel</a>
  </div>
</div>
</template>

<script>
import HeaderPart from "./HeaderPart.vue";
import vueCookies from "vue-cookies";
import axios from "axios";

export default {
  name: "SiteUser",
  data() {
    return {
      user: [],
    }
  },
  components: {
    HeaderPart
  },
  mounted() {
      if(vueCookies.isKey('user')) {
        let user = vueCookies.get('user')
        console.log(user)
        this.user = user
      } else {
        window.location.href = '/login'
      }
  },
  methods: {
    changePasswordForm() {
      document.querySelector('.container-button').style.display = 'none'
      document.getElementById('changePasswordForm').style.display = 'flex'
    },
    changePassword() {
      const oldPassword = document.getElementById('oldPassword').value
      const newPassword = document.getElementById('newPassword').value
      const email = this.user.email
      axios.defaults.withXSRFToken = true
      axios.post("http://localhost:8000/changePassword", {
        email: email,
        password: oldPassword,
        newPassword: newPassword
      }, {withCredentials: true})
          .then(res=> {
            if(typeof res.data !== 'object') {
              document.querySelector('.container-button').style.display = 'block'
              document.getElementById('changePasswordForm').style.display = 'none'
            } else {
              document.getElementById('alertError').style.display = 'block'
              document.getElementById('alertError').innerText = res.data.error
              document.getElementById('oldPassword').value = null
              document.getElementById('newPassword').value = null
              // console.log(res.data.error)
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

.container {
  /*border: 1px solid #8A8A8A;*/
  width: 600px;
  height: 500px;
  margin: auto;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 20px;
  font-weight: 500;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.container-button {
  text-transform: uppercase;
  font-size: 20px;
  border: none;
  padding: 10px 25px 10px 25px;
  color: black;
  background-color: #D9D9D9;
  cursor: pointer;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 500;
}

.container-name {
  margin-top: 50px;
  margin-bottom: 5px;
  color: black;
}

.container-email {
  margin-bottom: 20px;
  color: black;
}

.form-button {
  width: 256px;
  height: 25px;
  font-size: 23px;
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  background-color: #D9D9D9;
  cursor: pointer;
  border: none;
  padding: 10px 25px 10px 25px;
  text-transform: uppercase;
  letter-spacing: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  /*font-weight: 600;*/
}

.form-input {
  width: 300px;
  height: 30px;
  margin-bottom: 5px;
  border-radius: 1px;
  border: 1px solid #D9D9D9;
  font-family: 'Beatrice Deck Trial', sans-serif;
}

</style>