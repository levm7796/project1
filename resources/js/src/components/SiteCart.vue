<template>
  <HeaderPart></HeaderPart>
  <div class="main_container">
    <div class="products">
      <div class="products_tabs">
        <div class="products_tabs-bag">shopping bag</div>
<!--        <div class="products_tabs-favorite">favorites</div>-->
      </div>
      <hr style="border: none; background-color: #C9C9C9; height: 1px">
      <div class="products_cards">

        <div v-for="item in items" v-bind:key="item.id" style="display: flex; flex-direction: row;">
          <div class="products_card">
            <img class="products_card-img" :src="'/src/assets/img/'+item.img +'.png'" style="width: 304px; height: 313px">
            <div class="products_card-description">{{ item.description }}<div class="products_card-colors" style="background-color: #ffffff"></div>{{ item.colors }}</div>
            <div class="products_card-name">{{ item.name }}<div class="products_card-price">$ {{ item.price }}</div></div>
          </div>
          <div class="products_card-options">
            <button class="products_card-options-button" v-on:click="deleteProduct(item.cartId)">X</button>


            <div :class="['products_card-options-size', 'products_card-options-size'+item.cartId]" style="font-size: 14px; cursor: pointer" v-on:click="dropSizes(item.cartId)">{{item.size}}</div>

            <div style="display: none; flex-direction: row; margin-right: 25px; position: relative; z-index: 2" :class="['dropdown-menu-sizes'+item.cartId]">
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, 'XS')">XS</div>
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, 'S')">S</div>
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, 'M')">M</div>
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, 'L')">L</div>
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, 'XL')">XL</div>
              <div class="dropdown-menu-size" style="border: 1px solid black; cursor: pointer;" v-on:click="changeSize(item.cartId, '2XL')">2XL</div>
            </div>


            <div :class="['products_card-options-color', 'products_card-options-color'+item.cartId]" :style="{'background': item.color}" style="width: 25px; height: 25px; cursor: pointer; border: 1px solid #8a8a8a" v-on:click="dropColors(item.cartId)"></div>
            <div style="display: none; flex-direction: row; margin-right: 25px; position: relative; z-index: 2;" :class="['dropdown-menu-colors'+item.cartId]">
              <div class="dropdown-menu-color" style="background-color: #D9D9D9; cursor: pointer" v-on:click="changeColor(item.cartId, '#D9D9D9')"></div>
              <div class="dropdown-menu-color" style="background-color: #A9A9A9; cursor: pointer" v-on:click="changeColor(item.cartId, '#A9A9A9')"></div>
              <div class="dropdown-menu-color" style="background-color: #1E1E1E; cursor: pointer" v-on:click="changeColor(item.cartId, '#1E1E1E')"></div>
              <div class="dropdown-menu-color" style="background-color: #A6D6CA; cursor: pointer" v-on:click="changeColor(item.cartId, '#A6D6CA')"></div>
              <div class="dropdown-menu-color" style="background-color: #FFFFFF; cursor: pointer" v-on:click="changeColor(item.cartId, '#FFFFFF')"></div>
              <div class="dropdown-menu-color" style="background-color: #B9C1E8; cursor: pointer" v-on:click="changeColor(item.cartId, '#B9C1E8')"></div>
            </div>
            <div>
              <div class="products_card-options-plus" v-on:click="changePics(item.cartId, 1)">+</div>
              <div :class="['products_card-options-pics', 'products_card-options-pics'+item.cartId]" style="font-size: 12px">{{item.pics}}</div>
              <div class="products_card-options-minus" v-on:click="changePics(item.cartId, 0)">-</div>
            </div>
          </div>
        </div>

      </div>
      <hr style="border: none; background-color: #C9C9C9; height: 1px" v-if="this.items.length >= 1">
      <a href="/" v-if="this.items.length < 1" style="color: black; font-family: 'Beatrice Deck Trial', sans-serif;">Go To Shop</a>
    </div>
    <div class="tax">
      <div class="tax_title">order summary</div>
      <div class="tax_subtotal">
        Subtotal
        <div class="tax_subtotal-price">${{subtotalPrice}}</div>
      </div>
      <div class="tax_shipping">
        Shipping
        <div class="tax_shipping-price">$10</div>
      </div>
      <hr style="margin-bottom: 22px">
      <div class="tax_total">total <div style="font-size: 13px; color: rgba(0,0,0,0.6); margin-right: 100px;">(tax incl.)</div>${{ totalPrice }}</div>
      <div class="tax_agree">
        <input type="checkbox" style="border: 1px solid black" id="taxAgree">
        <div class="tax_agree-text">I agree to the Terms and Conditions</div>
      </div>
      <button class="tax_button" v-on:click="toCheckout">continue</button>
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
import img1 from '../assets/img/img20.png'
import img2 from '../assets/img/img21.png'
import vueCookies from "vue-cookies";
import axios from "axios";
import HeaderPart from "./HeaderPart.vue";

export default {
  name: "SiteCart",
  data() {
    return {
      menuImg: menuImg,
      logoImg: logoImg,
      favoriteImg: favoriteImg,
      cartImg: cartImg,
      cart2Img: cart2Img,
      userImg: userImg,
      img1: img1,
      img2: img2,
      items: [],
      user: [],
      subtotalPrice: 0,
      totalPrice: 0,
      shippingPrice: 10.
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

    axios.defaults.withXSRFToken = true
    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.post('http://localhost:8000/cardProducts', {
      email: this.user.email
    }, {withCredentials: true})
        .then(async res=>{
          // this.item = await res.data
          // this.item = this.item[0]
          // console.log(this.item)

          let pics = res.data[1]
          let size = res.data[2]
          let color = res.data[3]
          let cartId = res.data[4]
          let items = res.data[0]

          for(let i = 0; i<res.data[0].length; i++) {
            items[i]['pics'] = pics[i].pics
          }

          for(let i = 0; i<res.data[2].length; i++) {
            items[i]['size'] = size[i].size
          }

          for(let i = 0; i<res.data[3].length; i++) {
            items[i]['color'] = color[i].color
          }

          for(let i = 0; i<res.data[4].length; i++) {
            items[i]['cartId'] = cartId[i].id
          }
          this.items = items
            this.subtotalPrice = 0
          for(let i = 0; i<this.items.length; i++) {
                this.subtotalPrice += this.items[i].price * this.items[i].pics
            // this.subtotalPrice += this.items[i].price
          }
          this.totalPrice = this.subtotalPrice + this.shippingPrice
          console.log(this.items)
          // console.log(this.id)
        })
  },
  methods: {
    changeColor(id,color) {
      axios.defaults.withXSRFToken = true
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.post('http://localhost:8000/changeColor', {
        email: this.user.email,
        id: id,
        color: color
      }, {withCredentials: true})
      axios.post('http://localhost:8000/cardProducts', {
        email: this.user.email
      }, {withCredentials: true})
          .then(async res=>{

            let pics = res.data[1]
            let size = res.data[2]
            let color = res.data[3]
            let cartId = res.data[4]
            let items = res.data[0]

            for(let i = 0; i<res.data[0].length; i++) {
              items[i]['pics'] = pics[i].pics
            }

            for(let i = 0; i<res.data[2].length; i++) {
              items[i]['size'] = size[i].size
            }

            for(let i = 0; i<res.data[3].length; i++) {
              items[i]['color'] = color[i].color
            }

            for(let i = 0; i<res.data[4].length; i++) {
              items[i]['cartId'] = cartId[i].id
            }
            this.items = items
            console.log(this.items)
          })
      document.querySelector('.products_card-options-color' + id).style.background = color
      document.querySelector('.products_card-options-color' + id).style.display = 'block'
      document.querySelector('.dropdown-menu-colors' + id).style.display = 'none'
    },

    dropColors(x) {
      let a = '.products_card-options-color' + x
      let b = '.dropdown-menu-colors' + x
      document.querySelector(a).style.display = 'none'
      document.querySelector(b).style.display = 'flex'
    },

    changeSize(id,size) {
      axios.defaults.withXSRFToken = true
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.post('http://localhost:8000/changeSize', {
        email: this.user.email,
        id: id,
        size: size
      }, {withCredentials: true})
      axios.post('http://localhost:8000/cardProducts', {
        email: this.user.email
      }, {withCredentials: true})
          .then(async res=>{

            let pics = res.data[1]
            let size = res.data[2]
            let color = res.data[3]
            let cartId = res.data[4]
            let items = res.data[0]

            for(let i = 0; i<res.data[0].length; i++) {
              items[i]['pics'] = pics[i].pics
            }

            for(let i = 0; i<res.data[2].length; i++) {
              items[i]['size'] = size[i].size
            }

            for(let i = 0; i<res.data[3].length; i++) {
              items[i]['color'] = color[i].color
            }

            for(let i = 0; i<res.data[4].length; i++) {
              items[i]['cartId'] = cartId[i].id
            }
            this.items = items
            console.log(this.items)
          })
      document.querySelector('.products_card-options-size' + id).innerText = size
      document.querySelector('.products_card-options-size' + id).style.display = 'block'
      document.querySelector('.dropdown-menu-sizes' + id).style.display = 'none'
    },

    dropSizes(x) {
      let a = '.products_card-options-size' + x
      let b = '.dropdown-menu-sizes' + x
      document.querySelector(a).style.display = 'none'
      document.querySelector(b).style.display = 'flex'
    },

    changePics(id, method) {
      if(method == 1) {
        document.querySelector('.products_card-options-pics'+id).innerText++
      } else {
        document.querySelector('.products_card-options-pics'+id).innerText--
      }
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/changePics', {
        id: id,
        method: method
      }, {withCredentials: true})
      axios.post('http://localhost:8000/cardProducts', {
        email: this.user.email
      }, {withCredentials: true})
          .then(async res=>{

            let pics = res.data[1]
            let size = res.data[2]
            let color = res.data[3]
            let cartId = res.data[4]
            let items = res.data[0]

            for(let i = 0; i<res.data[0].length; i++) {
              items[i]['pics'] = pics[i].pics
            }

            for(let i = 0; i<res.data[2].length; i++) {
              items[i]['size'] = size[i].size
            }

            for(let i = 0; i<res.data[3].length; i++) {
              items[i]['color'] = color[i].color
            }

            for(let i = 0; i<res.data[4].length; i++) {
              items[i]['cartId'] = cartId[i].id
            }
            this.items = items
            this.subtotalPrice = 0
            for(let i = 0; i<this.items.length; i++) {
              this.subtotalPrice += this.items[i].price * this.items[i].pics
              // this.subtotalPrice += this.items[i].price
            }
            this.totalPrice = this.subtotalPrice + this.shippingPrice
            console.log(this.items)
          })
    },

    deleteProduct(id) {
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/removeProduct', {
        id: id,
        email: this.user.email
      }, {withCredentials: true})
      axios.post('http://localhost:8000/cardProducts', {
        email: this.user.email
      }, {withCredentials: true})
          .then(async res=>{

            let pics = res.data[1]
            let size = res.data[2]
            let color = res.data[3]
            let cartId = res.data[4]
            let items = res.data[0]

            for(let i = 0; i<res.data[0].length; i++) {
              items[i]['pics'] = pics[i].pics
            }

            for(let i = 0; i<res.data[2].length; i++) {
              items[i]['size'] = size[i].size
            }

            for(let i = 0; i<res.data[3].length; i++) {
              items[i]['color'] = color[i].color
            }

            for(let i = 0; i<res.data[4].length; i++) {
              items[i]['cartId'] = cartId[i].id
            }
            this.items = items
            this.subtotalPrice = 0
            for(let i = 0; i<this.items.length; i++) {
              this.subtotalPrice += this.items[i].price * this.items[i].pics
              // this.subtotalPrice += this.items[i].price
            }
            // this.totalPrice = this.subtotalPrice + this.shippingPrice
            console.log(this.items)
          })
    },

    toCheckout() {
      if(document.getElementById('taxAgree').checked) {
        window.location.href = '/checkout'
      } else {
        document.querySelector('.tax_agree-text').style.color = 'red';
        console.log(document.getElementById('taxAgree').checked)
      }
    },

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



.main_container {
  display: flex;
  justify-content: space-between;
  margin-top: 120px;
}

.products_tabs-favorite {
  color: #8A8A8A;
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 500;
  font-family: 'Beatrice Deck Trial', sans-serif;
}

.products_tabs-bag {
  font-size: 13px;
  font-weight: 500;
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
}

.products_tabs {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 242px;
  margin-bottom: 20px;
}

.products {
  margin-left: 52px;
  width: 712px;
  height: 416px;
}

.products_cards {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  flex-wrap: wrap;
  width: 712px;
  margin-top: 17px;
  margin-bottom: 30px;
}

.products_card-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.products_card-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.products_card-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.products_card-colors {
  margin-left: 7px;
  margin-right: 3px;
  width: 12px;
  height: 12px;
  border: solid #A3A3A3 1px;
}

.tax {
  width: 253px;
  height: 264px;
  border: 1px #D9D9D9 solid;
  margin-top: 62px;
  font-family: 'Beatrice Deck Trial', sans-serif;
  padding: 49px 36px 36px 36px;
  color: black;
  margin-right: 50px;
}

.tax_title {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  text-transform: uppercase;
  margin-bottom: 18px;
}

.tax_total {
  text-transform: uppercase;
  color: black;
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-bottom: 35px;
}

.tax_button {
  width: 229px;
  height: 40px;
  border: none;
  color: black;
  background-color: #D9D9D9;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
}

.tax_agree {
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
}

.tax_agree-text {
  font-size: 11px;
  font-weight: 200;
}

.tax_subtotal,
.tax_shipping {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.tax_subtotal {
  margin-bottom: 3px;
}

.tax_shipping {
  margin-bottom: 16px;
}

.products_card {
  margin-bottom: 10px;
}

.products_card-options {
  display: flex;
  flex-direction: column;
  width: 40px;
  height: 200px;
  align-items: center;
  justify-content: space-between;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 400;
  color: black;
}

.products_card-options-button {
  width: 40px;
  height: 40px;
  border: none;
  background: none;
  padding: 0;
  cursor: pointer;
}

.products_card-options-plus,
.products_card-options-pics,
.products_card-options-minus
{
  border: 1px solid #8A8A8A;
  width: 25px;
  height: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.products_card-options-pics {
  margin-top: -1px;
  margin-bottom: -1px;
}

.dropdown-menu-color {
  width: 25px;
  height: 25px;
  cursor: pointer;
}

.dropdown-menu-size {
  width: 31px;
  height: 31px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  cursor: pointer;
}
</style>
