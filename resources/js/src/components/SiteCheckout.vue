<template>
<HeaderPart></HeaderPart>
  <div class="container">
    <div class="checkout">
      <div class="checkout_title">checkout</div>
      <div class="checkout_info">
        <div class="checkout_info-contact">
          <div class="info-contact-title">contact info</div>
          <input class="info-contact-email" placeholder="Email" required>
          <input class="info-contact-phone" placeholder="Phone">
        </div>
        <div class="checkout_info-address">
          <div class="info-address-title">shipping address</div>
          <div class="info-address-FL">
            <input type="text" class="info-address-first" placeholder="First Name">
            <input type="text" class="info-address-last" placeholder="Last Name">
          </div>
          <input class="info-address-country" placeholder="Country">
          <input class="info-address-country" placeholder="State / Region">
          <input class="info-address-country" placeholder="Address">
          <div class="info-address-location">
            <input type="text" class="info-address-city" placeholder="City">
            <input type="text" class="info-address-postal" placeholder="Postal Code">
          </div>
        </div>
          <div class="info-address-button" v-on:click="pay">Pay</div>
      </div>
    </div>
    <div class="order">
      <div class="order-title">your order</div>
      <div class="order_products">
        <div class="order_products-product" v-for="(item, i) in items" v-bind:key="i">

          <img :src="'/src/assets/img/'+item.img +'.png'" alt="product" style="width: 113px; height: 134px; margin-right: 10px">
          <div class="products-product-info">
            <div class="products-product-topPart">
              <div class="product-topPart-name">{{item.name}} <a href="/siteCart" class="product-topPart-link">Change</a></div>
              <div class="product-topPart-options">
                <div class="product-topPart-color" :style="{'background': item.color}"></div>
                <div class="product-topPart-size">{{item.size}}</div>
              </div>
            </div>

            <div class="products-product-bottomPart">
              <div class="product-bottomPart-pics">({{item.pics}})</div>
              <div class="product-bottomPart-price">$ {{item.price}}</div>
            </div>

          </div>

        </div>
        <hr>
        <div class="order_prices">
          <div class="order_prices-subtotal">Subtotal <div>${{subtotalPrice}}</div></div>
          <div class="order_prices-shipping">Shipping <div>${{shippingPrice}}</div></div>
        </div>
        <hr>
        <div class="order-total">Total <div>${{totalPrice}}</div></div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderPart from "./HeaderPart.vue";
import vueCookies from "vue-cookies";
import axios from "axios";

export default {
  name: "SiteCheckout",
  data() {
    return {
      user: [],
      items: [],
      totalPrice: 0,
      subtotalPrice: 0,
      shippingPrice: 10
    }
  },
  mounted() {
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
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
    pay() {
      axios.defaults.withXSRFToken = true
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      if(vueCookies.isKey('user')) {
        let user = vueCookies.get('user')
        console.log(user)
        this.user = user
        axios.post('http://localhost:8000/createOrder', {
          items: this.items,
          email: user.email,
        }, {withCredentials: true})
            .then(res=>{
              let id = res.data
              // console.log(id)
              vueCookies.set('orderId', id)
            })
      }
      axios.post('http://localhost:8000/checkout', {
        price: this.totalPrice
      }, {withCredentials: true})
          .then(res=>{
            window.location.href = res.data
          })
    },

},
  components: {
    HeaderPart
  },
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

input {
  height: 39px;
  width: 461px;
  margin-bottom: 14px;
  border: 1px solid #D9D9D9;
  margin-right: -19px;
  padding-left: 22px;
}

hr {
  border: none;
  background-color: #DFDFDF;
  height: 1px
}


.checkout {
  width: 468px;
  height: 538px;
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  margin-left: 50px;
  margin-top: 40px;
}

.checkout_info-contact,
.checkout_info-address {
  display: flex;
  flex-direction: column;
}

.info-address-title {
  margin-top: 19px;
}

.checkout_title {
  font-weight: 800;
  font-size: 32px;
  text-transform: uppercase;
  margin-bottom: 41px;
}

.info-contact-title,
.info-address-title {
  font-size: 14px;
  font-weight: 500;
  text-transform: uppercase;
}

.info-address-first,
.info-address-last,
.info-address-city,
.info-address-postal {
  width: 212px;
}

/*.info-address-first,*/
/*.info-address-city {*/
/*  margin-right: 50px;*/
/*}*/

.info-address-location,
.info-address-FL {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  /*width: 461px;*/
}

.info-address-button {
  width: 238px;
  height: 45px;
  border: none;
  background: #D9D9D9;
  margin-left: 249px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.order_products-product {
  display: flex;
  flex-direction: row;
  font-size: 12px;
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  width: 335px;
  height: 135px;
  margin-bottom: 23px;
}

.products-product-info {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.order {
  width: 329px;
  /*height: 478px;*/
  border: 1px solid #D9D9D9;
  padding: 35px 37px 24px 39px;
}

.product-topPart-name {
  font-size: 11px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  /*width: 100%;*/
  width: 215px;
}

.product-topPart-color {
  width: 15px;
  height: 15px;
  border: 1px solid #8a8a8a;
  margin-right: 5px;
}

.product-topPart-options {
  display: flex;
  flex-direction: row;
}

.product-topPart-link {
  color: black
}

.container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.order-title {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 14px;
  font-weight: 500;
  text-transform: uppercase;
  margin-bottom: 30px;
}

.products-product-bottomPart {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.order_prices {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 12px;
  font-weight: 400;
}

.order-total {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-size: 14px;
  font-weight: 400;
}

.order-total,
.order_prices-shipping,
.order_prices-subtotal {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
</style>