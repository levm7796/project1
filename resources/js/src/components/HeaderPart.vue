<template>

  <div class="header">
    <div class="container">


      <div class="leftPart">
<!--        <img :src="menuImg" alt="menu" class="leftPart_menuImg">-->
        <nav>
          <input type="checkbox" id="sidebar-active">
          <label for="sidebar-active" class="open-sidebar-button">
            <svg width="28" height="18" viewBox="0 0 28 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
              <path d="M27 1L1 1" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M19 9L1 9" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M14 17H1" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </label>

          <div class="links-container">
            <label for="sidebar-active" class="close-sidebar-button">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="26" height="26" viewBox="0 0 50 50" style="cursor: pointer">
                <path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path>
              </svg>
            </label>
<!--            <div class="leftPart_homeText" onclick="window.location.href = '/'" style="cursor: pointer">Home</div>-->
<!--            <div class="leftPart_collectionsText" onclick="document.querySelector('.collections').scrollIntoView();" style="cursor: pointer">Collections</div>-->
<!--            <div class="leftPart_newText" onclick="document.querySelector('.week').scrollIntoView();" style="cursor: pointer">New</div>-->
        <div class="nav_tab" onclick="window.location.href = '/vue'" style="cursor: pointer">Home</div>
        <div class="nav_tab" onclick="document.querySelector('.collections').scrollIntoView();" style="cursor: pointer">Collections</div>
        <div class="nav_tab" onclick="document.querySelector('.week').scrollIntoView();" style="cursor: pointer">New</div>
          </div>
        </nav>
      </div>


      <div class="middlePart">
        <img :src="logoImg" alt="logo" class="middlePart_logo" onclick="window.location.href = '/'">
      </div>


      <div class="rightPart" v-if="this.user.length !== 0">
        <img :src="favoriteImg" alt="favorite" class="rightPart_favorite" style="cursor:pointer;" onclick="window.location.href = '/siteFavorite'">
        <div class="rightPart_cartsImg">
          <img :src="cart2Img" alt="cart" class="rightPart_cart2Img" onclick="window.location.href = '/vue/siteCart'" style="cursor: pointer">
          <img :src="cartImg" alt="cart" class="rightPart_cartImg" onclick="window.location.href = '/vue/siteCart'" style="cursor: pointer">
        </div>
        <img :src="logoutImg" alt="logout" class="rightPart_logoutImg" style="cursor: pointer" v-on:click="logout">
        <img :src="userImg" alt="user" class="rightPart_userImg" onclick="window.location.href = '/vue/siteUser'" style="cursor: pointer">
      </div>

      <div class="rightPart" v-else>
        <img :src="loginImg" alt="login" class="rightPart_loginImg" onclick="window.location.href = '/vue/login'" style="cursor: pointer">
        <img :src="registerImg" alt="register" class="rightPart_registerImg" onclick="window.location.href = '/vue/register'" style="cursor: pointer">
      </div>


    </div>
  </div>
</template>

<script>
import menuImg from '../assets/img/menu.svg'
import logoImg from '../assets/img/logo.svg'
import favoriteImg from '../assets/img/favorite.svg'
import cartImg from '../assets/img/cart.svg'
import cart2Img from '../assets/img/cart2.svg'
import userImg from '../assets/img/user.svg'
import loginImg from '../assets/img/login.svg'
import registerImg from '../assets/img/register.svg'
import logoutImg from '../assets/img/logout.svg'
import vueCookies from "vue-cookies";
import axios from "axios";

export default {
  name: "SiteProduct",
  data() {
    return {
      menuImg: menuImg,
      logoImg: logoImg,
      favoriteImg: favoriteImg,
      cartImg: cartImg,
      cart2Img: cart2Img,
      userImg: userImg,
      loginImg: loginImg,
      registerImg: registerImg,
      logoutImg: logoutImg,
      user: []
    }
  },
  mounted() {
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      this.user = user
    }
  },
  methods: {
    logout() {
      axios.get('http://localhost:8000/logout')
      document.cookie = 'user' + '=; Max-Age=0'
      this.user = []
      window.location.href = '/'
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
  margin-top: 50px;
  margin-left: 50px;
}

body {
  margin: 0;
  padding: 0 50px 0 50px;
}
.title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 800;
  font-size: 48px;
  line-height: 0.8;
}

.leftPart {
  /*font-family: "Beatrice Deck Trial Extrabold";*/
  /*font-family: "PT Serif", serif;*/
  font-family: "Noto Sans", sans-serif;
  font-weight: 600;
  font-size: 16px;
  display: flex;
  flex-direction: row;
  align-items: center;
}

.container {
  display: flex;
  justify-content: space-between;
}

.leftPart_menuImg {
  width: 26px;
  height: 16px;
}

.middlePart_logo {
  width: 50px;
  height: 50px;
  cursor: pointer;
  position: absolute;
  margin-left: auto;
  margin-right: auto;
  left: 0;
  right: 0;
}

.rightPart {
  display: flex;
  flex-direction: row;
}
.rightPart_userImg {
  margin-right: 50px;
}

.rightPart_logoutImg {
  margin-left: 42px;
}

.rightPart_cart2Img {
  margin-left: 47px;
}

.rightPart_cartImg {
  margin-left: -5px;
}

/*.leftPart_collectionsText {*/
/*  margin-right: 35px;*/
/*}*/

/*.leftPart_homeText {*/
/*  margin-right: 35px;*/
/*}*/

.leftPart_menuImg {
  margin-right: 35px;
  margin-left: 52px;
  /*opacity: 0;*/
}

#sidebar-active {
  display: none;
}

.open-sidebar-button,
.close-sidebar-button {
  display: none;
}

.links-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  width: 220px;
}

@media only screen and (max-width: 1000px) {
  .rightPart_cartsImg {
    display: none;
  }

  .rightPart_favorite {
    display: none;
  }

  .middlePart_logo {
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
  }

  /*.leftPart_newText {*/
  /*  display: none;*/
  /*}*/

  /*.leftPart_collectionsText {*/
  /*  display: none;*/
  /*}*/

  /*.leftPart_homeText {*/
  /*  display: none;*/
  /*}*/

  .links-container {
    display: none;
    flex-direction: column;
    align-items: flex-start;
    position: absolute;
    top: 61px;
    left: 48px;

    z-index: 10;
    width: 141px;

    background-color: white;
  }

  nav .nav_tab {
    box-sizing: border-box;
    height: auto;
    width: 100%;
    padding: 20px 30px;
    justify-content: flex-end;
  }

  .open-sidebar-button,
  .close-sidebar-button {
    display: block;
  }

  #sidebar-active:checked ~ .links-container {
    display: flex;
  }
}
</style>
