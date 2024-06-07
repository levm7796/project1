<template>
  <div class="container">
    <div class="card">
      <div class="card_name">Name: {{user.name}}</div>
      <div class="card_email">Email: {{user.email}}</div>

      <button v-on:click="setRegionForm" id="setRegionButton" v-if="user.region === null">Set region</button>
      <div v-else class="card_region">{{ user.region }}</div>

      <div id="setRegion" style="display: none">
        <input type="text" placeholder="Region" id="regionInput">
        <button v-on:click="setRegion">Set</button>
      </div>

      <button v-on:click="changePasswordForm" id="changePasswordButton">Change password</button>
      <div id="changePasswordForm" style="display: none">
        <input type="password" placeholder="Old password" id="oldPassword">
        <input type="password" placeholder="New password" id="newPassword">
        <div id="alertError" style="display: none"></div>
        <button v-on:click="changePassword">Change</button>
        <a href="/user" style="margin-left: 2px; color: white;">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
import vueCookies from "vue-cookies";
import axios from "axios";

export default {
name: "UserPage",
  data() {
    return {
      user: ''
    }
  },
  mounted() {
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
    }
  },
  methods: {
    setRegionForm() {
      document.getElementById('setRegionButton').style.display = 'none'
      document.getElementById('setRegion').style.display = 'block'
    },
    setRegion() {
      const region = document.getElementById('regionInput').value
      const email = this.user.email
      axios.defaults.withXSRFToken = true
      axios.post("http://localhost:8000/setRegion", {
        email: email,
        region: region
      }, {withCredentials: true})
      .then(res=> {
        console.log(res.data)
        document.getElementById('setRegion').style.display = 'none'
        window.location.href = '/login'
      })
    },
    changePasswordForm() {
      document.getElementById('changePasswordButton').style.display = 'none'
      document.getElementById('changePasswordForm').style.display = 'block'
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
            document.getElementById('changePasswordButton').style.display = 'block'
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

<style scoped lang="less">
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}
.card {
  height: 200px;
  width: 400px;
  background-color: #42b983;
  border-radius: 10px;
  padding: 5px;
}

#alertError {
  background-color: rgb(250, 82, 82);
  color: #fff7f7;
  border-radius: 5px;
  margin-top: 2px;
  margin-bottom: 2px;
}
</style>