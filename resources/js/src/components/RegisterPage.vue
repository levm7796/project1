<template>
  <HeaderPart></HeaderPart>
  <form action="/" class="form register">
    <h1 class="register_title">New account</h1>
    <div class="form_name">
<!--      <label for="name">Name</label>-->
      <input type="text" placeholder="Name" id="name" class="register_input">
    </div>
    <div class="form_email">
<!--      <label for="email">Email</label>-->
      <input type="email" placeholder="Email" id="email" class="register_input">
    </div>
    <div class="form_password">
<!--      <label for="password">Password</label>-->
      <input type="password" placeholder="Password" id="password" class="register_input">
    </div>
    <div class="form_password">
<!--      <label for="password2">Confirm password</label>-->
      <input type="password" placeholder="Password" id="password2" class="register_input">
    </div>
    <div id="error" class="alert alert-danger register_alert" role="alert"></div>
    <!--    <button type="submit" class="form_submit">Submit</button>-->
    <button v-on:click="signIn()" type="button" class="register_button">continue</button>
  </form>
</template>

<script>
import axios from 'axios'
import HeaderPart from "./HeaderPart.vue";

export default {
name: "RegisterPage",
  components: {
  HeaderPart
  },
  data() {
    return {

    }
  },
  methods: {
    async signIn()
    {
      let name = document.getElementById('name').value
      let email = document.getElementById('email').value
      let password = document.getElementById('password').value
      let password2 = document.getElementById('password2').value

      if (password !== password2) {
        document.getElementById('error').style.display = 'block'
        document.getElementById('error').innerText = 'Password mismatch'
        return false;
      }

      if(!this.validateEmail(email)) {
        document.getElementById('error').style.display = 'block'
        document.getElementById('error').innerText = 'Invalid Email'
        return false
      }

      axios.defaults.withXSRFToken = true
      // axios.withCredentials = true

      await axios.get('http://localhost:8000/sanctum/csrf-cookie')
      await axios.post("http://localhost:8000/register", {
        name: name,
        email: email,
        password: password,
      }, {withCredentials: true})
          .then(res => {
            if(res.data.error !== undefined) {
              document.getElementById('error').style.display = 'block'
              document.getElementById('error').innerText = res.data.error
            } else {
            window.location.href = '/login'
            }
          })
    },
    validateEmail(email) {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
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

.register_title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 30px;
  font-weight: 600;
}

.register {
  margin-left: 52px;
}

.register_input {
  font-family: 'Beatrice Deck Trial', sans-serif;
  height: 39px;
  width: 461px;
  margin-bottom: 14px;
  border: 1px solid #D9D9D9;
  margin-right: -19px;
  padding-left: 22px;
}

.register_button {
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
}

.register_alert {
  margin-top: 5px;
  margin-bottom: 5px;
  display: none;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: #ff2323;
}
</style>