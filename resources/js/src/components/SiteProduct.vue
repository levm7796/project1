<template>
  <HeaderPart></HeaderPart>
  <div class="card">
    <div class="card_leftPart">
      <img :src="'/src/assets/img/'+item.img +'.png'" class="card_leftPart-image">
      <div class="card_leftPart-images">
        <img :src="'/src/assets/img/'+item.img +'.png'" alt="" id="img1" class="active" v-on:click="activeImg('img1')" style="cursor: pointer">
        <img :src="'/src/assets/img/'+item.img +'.png'" alt="" id="img2" class="unactive" v-on:click="activeImg('img2')" style="cursor: pointer">
        <img :src="'/src/assets/img/'+item.img +'.png'" alt="" id="img3" class="unactive" v-on:click="activeImg('img3')" style="cursor: pointer">
        <img :src="'/src/assets/img/'+item.img +'.png'" alt="" id="img4" class="unactive" v-on:click="activeImg('img4')" style="cursor: pointer">
        <img :src="'/src/assets/img/'+item.img +'.png'" alt="" id="img5" class="unactive" v-on:click="activeImg('img5')" style="cursor: pointer">
      </div>
    </div>
    <div class="card_rightPart">
      <div class="card_rightPart-title">{{this.item.name}}</div>
      <div class="card_rightPart-price">$ {{item.price}}</div>
      <div class="card_rightPart-country">MRP incl. of all taxes</div>
      <div class="card_rightPart-description">Relaxed-fit shirt. Camp collar and short sleeves. Button-up front.</div>
      <div class="card_rightPart-color">
        <div class="card_rightPart-color-title">Color</div>
        <div class="card_rightPart-color-colors">
          <div class="card_rightPart-color-block activeBlock" style="background-color: #D9D9D9" id="color1" v-on:click="changeColor(1)"></div>
          <div class="card_rightPart-color-block unactiveBlock" style="background-color: #A9A9A9" id="color2" v-on:click="changeColor(2)"></div>
          <div class="card_rightPart-color-block unactiveBlock" style="background-color: #1E1E1E" id="color3" v-on:click="changeColor(3)"></div>
          <div class="card_rightPart-color-block unactiveBlock" style="background-color: #A6D6CA" id="color4" v-on:click="changeColor(4)"></div>
          <div class="card_rightPart-color-block unactiveBlock" style="background-color: #FFFFFF" id="color5" v-on:click="changeColor(5)"></div>
          <div class="card_rightPart-color-block unactiveBlock" style="background-color: #B9C1E8" id="color6" v-on:click="changeColor(6)"></div>
        </div>
      </div>
      <div class="card_rightPart-size">
        <div class="card_rightPart-size-title">Size</div>
        <div class="card_rightPart-size-sizes">
          <div class="card_rightPart-size-block activeSize" id="size1" v-on:click="changeSize(1)">XS</div>
          <div class="card_rightPart-size-block unactiveSize" id="size2" v-on:click="changeSize(2)">S</div>
          <div class="card_rightPart-size-block unactiveSize" id="size3" v-on:click="changeSize(3)">M</div>
          <div class="card_rightPart-size-block unactiveSize" id="size4" v-on:click="changeSize(4)">L</div>
          <div class="card_rightPart-size-block unactiveSize" id="size5" v-on:click="changeSize(5)">XL</div>
          <div class="card_rightPart-size-block unactiveSize" id="size6" v-on:click="changeSize(6)">2X</div>
        </div>
        <div class="card_rightPart-size-description">FIND YOUR SIZE |  MEASUREMENT GUIDE</div>
      </div>
      <button class="card_rightPart-button" v-on:click="addToCart" v-if="this.user.length !== 0" @click="notify">add</button>
      <button class="card_rightPart-button" onclick="window.location.href = '/login'" v-else>login</button>
    </div>
  </div>
</template>

<script>
// import menuImg from '../assets/img/menu.svg'
// import logoImg from '../assets/img/logo.svg'
// import favoriteImg from '../assets/img/favorite.svg'
// import cartImg from '../assets/img/cart.svg'
// import cart2Img from '../assets/img/cart2.svg'
// import userImg from '../assets/img/user.svg'
import img1 from '../assets/img/img14.png'
import img2 from '../assets/img/img15.png'
import img3 from '../assets/img/img16.png'
import img4 from '../assets/img/img17.jpg'
import img5 from '../assets/img/img18.png'
import img6 from '../assets/img/img19.png'
import {useRoute} from 'vue-router';
import axios from 'axios'
import vueCookies from "vue-cookies";
import HeaderPart from "./HeaderPart.vue";
import {toast} from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

export default {
name: "SiteProduct",
  data() {
    return {
      // menuImg: menuImg,
      // logoImg: logoImg,
      // favoriteImg: favoriteImg,
      // cartImg: cartImg,
      // cart2Img: cart2Img,
      // userImg: userImg,
      img1: img1,
      img2: img2,
      img3: img3,
      img4: img4,
      img5: img5,
      img6: img6,
      id: 0,
      item: [],
      user: [],
    }
  },
  setup() {
    const notify = () => {
      toast.success("Was added to Cart", {
        autoClose: 1000,
      }); // ToastOptions
    }
    return { notify };
  },
  components: {
    HeaderPart
  },
  mounted() {
    const route = useRoute();
    this.id = route.params.id;

    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
    }

    const id = route.params.id;
    axios.defaults.withXSRFToken = true
    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.post('http://localhost:8000/productById', {
      id: id
    }, {withCredentials: true})
        .then(async res=>{
          this.item = await res.data
          this.item = this.item[0]
          console.log(this.item)
        })
  },
  methods: {
    activeImg(img) {
      for(let i = 0; i<5; i++) {
        document.getElementById('img'+(i+1)).className = 'unactive'
      }

      document.getElementById(img).className = 'active'
    },
    changeColor(x) {
      for(let i = 0; i<6; i++) {
        document.getElementById('color'+(i+1)).className = 'unactiveBlock'
      }

      document.getElementById('color' + x).className = 'activeBlock'
    },

    changeSize(x) {
      for(let i = 0; i<6; i++) {
        document.getElementById('size'+(i+1)).className = 'unactiveSize'
      }

      document.getElementById('size' + x).className = 'activeSize'
    },

    addToCart() {
      const size = document.querySelector('.activeSize').innerText
      const color = document.querySelector('.activeBlock').style.backgroundColor
      console.log(size)
      console.log(color)
      console.log(this.user)
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/addToCart', {
        id: this.id,
        size: size,
        color: color,
        email: this.user.email,
      }, {withCredentials: true})

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
}

.rightPart {
  display: flex;
  flex-direction: row;
}
.rightPart_userImg {
  margin-left: 42px;
  margin-right: 50px;
}

.rightPart_cart2Img {
  margin-left: 47px;
}

.rightPart_cartImg {
  margin-left: -5px;
}

.leftPart_collectionsText {
  margin-right: 35px;
}

.leftPart_homeText {
  margin-right: 35px;
}

.leftPart_menuImg {
  margin-right: 35px;
  margin-left: 52px;
}

.card {
  width: 875px;
  height: 498px;
}

.card_leftPart {
  display: flex;
  flex-direction: row;
  margin-right: 100px;
}

.card_leftPart-images {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-left: 41px;
  height: 438px;
}

.card_rightPart {
  display: flex;
  flex-direction: column;
  width: 306px;
  height: 432px;
  border: #D9D9D9 solid 1px;
  padding: 51px 35px 10px 40px;
}

.card_rightPart-title,
.card_rightPart-price {
  font-size: 14px;
  font-weight: 400;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
}

.card_rightPart-title {
  margin-bottom: 2px;
}

.card_rightPart-price {
  margin-bottom: 10px
}

.card_rightPart-country {
  font-size: 12px;
  font-weight: 400;
  font-family: "Noto Sans", sans-serif;
  color: rgba(0,0,0,0.6);
  margin-bottom: 40px;
}

.card_rightPart-description {
  font-size: 12px;
  font-weight: 400;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  margin-bottom: 65px;
}

.card_rightPart-color-title,
.card_rightPart-size-title
{
  font-size: 12px;
  font-weight: 200;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
}

.card_rightPart-color-colors,
.card_rightPart-size-sizes
{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.card {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-top: 96px;
  margin-right: auto;
  margin-left: auto;
}

.card_leftPart-image {
  height: 438px;
}

.card_rightPart-size-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 10px;
  font-weight: 400;
  line-height: 3;
  letter-spacing: 0.5px;
  margin-bottom: 16px;
}

.card_rightPart-color {
  margin-bottom: 19px;
}

.card_rightPart-size-sizes {
  margin-bottom: 14px;
}
.card_rightPart-button {
  width: 229px;
  height: 40px;
  padding: 10px 0 10px 0 ;
  font-size: 12px;
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
  border: none;
  background-color: #D9D9D9;
  cursor: pointer;
}

.unactive {
  opacity: 0.5;
  width: 64px;
  height: 78px;
}

.active {
  opacity: 1;
  width: 64px;
  height: 78px;
}

.unactiveBlock {
  border: none;
  width: 35px;
  height: 35px;
  cursor: pointer;
}

.activeBlock {
  border: 2px solid black;
  width: 35px;
  height: 35px;
  cursor: pointer;
}

.unactiveSize {
  width: 33.5px;
  height: 33.5px;
  border: 1px solid #A3A3A3;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.activeSize {
  border: 2px solid black;
  width: 33.5px;
  height: 33.5px;
  /*border: 1px solid #A3A3A3;*/
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
</style>
