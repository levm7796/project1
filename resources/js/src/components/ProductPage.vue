<template>
  <div class="product">
    <div :modules="modules" id="swiper">
      <div><img :src="item.img" alt=""></div>
      <div><img :src="item.img" alt=""></div>
      <div><img :src="item.img" alt=""></div>
    </div>
    <div class="product_name">{{item.name}}</div>
    <div class="product_price">{{item.price}}$</div>
  <button v-on:click="getSession()" class="buy_button">Buy</button>
  </div>

<!--  <stripe-buy-button-->
<!--      buy-button-id="buy_btn_1PGMzwAcSiYCPjwcEpMEFOIQ"-->
<!--      publishable-key="pk_test_51PGMNPAcSiYCPjwcBK9WVrGeTf027u9saHCSfjssft40YzbBDO7aOdlA2wYaSANuB8vDCPFmyGOQwTJTzKxYd65200SvF0rzTj"-->
<!--  >-->
<!--  </stripe-buy-button>-->

<!--  <stripe-buy-button-->
<!--      buy-button-id="buy_btn_1PGNEnAcSiYCPjwcQcjZpGnq"-->
<!--      publishable-key="pk_test_51PGMNPAcSiYCPjwcBK9WVrGeTf027u9saHCSfjssft40YzbBDO7aOdlA2wYaSANuB8vDCPFmyGOQwTJTzKxYd65200SvF0rzTj"-->
<!--  >-->
<!--  </stripe-buy-button>-->

<!--  <stripe-checkout-->
<!--  ref="checkoutRef"-->
<!--  :pk="publishableKey"/>-->
<!--  <button v-on:click="submit">Pay</button>-->

</template>

<script>
import {useRoute} from 'vue-router';
import axios from 'axios'
import vueCookies from "vue-cookies";
// import SwiperClass, { Navigation } from 'Swiper'
// import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
// import 'swiper/css'
// import 'swiper/css/navigation'
import 'https://js.stripe.com/v3/buy-button.js'
import { StripeCheckout } from '@vue-stripe/vue-stripe'

export default {
  name: "ProductPage",
  components: {
    // Swiper,
    // SwiperSlide,
    StripeCheckout
  },
  data() {
    return {
      item: '',
      id: null,
      user: null,
      // modules: [Navigation],
      publishableKey: 'pk_test_51PGMNPAcSiYCPjwcBK9WVrGeTf027u9saHCSfjssft40YzbBDO7aOdlA2wYaSANuB8vDCPFmyGOQwTJTzKxYd65200SvF0rzTj'
    }
  },
  mounted() {
    const route = useRoute();
    this.id = route.params.id;
    const id = route.params.id;
    axios.defaults.withXSRFToken = true
    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.post('http://localhost:8000/productById', {
      id: id
    }, {withCredentials: true})
    .then(async res=>{
      this.item = await res.data
      this.item = this.item[0]
      if(res.data[0].name == 'T-shirt') {
        document.getElementById('swiper').style.width = '320px'
        document.getElementById('swiper').style.height = '429px'
      }
    })
  },
  methods: {
    getSession() {
      axios.defaults.withXSRFToken = true
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      if(vueCookies.isKey('user')) {
        let user = vueCookies.get('user')
        console.log(user)
        this.user = user
        axios.post('http://localhost:8000/createOrder', {
          productId: this.item.id,
          email: user.email,
          price: this.item.price,
        }, {withCredentials: true})
        .then(res=>{
          let id = res.data.id
          // console.log(id)
          vueCookies.set('orderId', id)
        })
      }
      axios.post('http://localhost:8000/checkout', {}, {withCredentials: true})
          .then(res=>{
            window.location.href = res.data
          })
    }
  }
}
</script>

<style scoped lang="less">
//.product{
//  &_img {
//    width: 432px;
//    height: 324px;
//  }
//}

html,
body {
  position: relative;
  height: 100%;
}

body {
  background: #eee;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px;
  color: #000;
  margin: 0;
  padding: 0;
}

.swiper {
  width: 319px;
  height: 162px;
  margin-left: 0;
}

//.swiper {
//  width: 320px;
//  height: 429px;
//  margin-left: 0;
//}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product {
  padding-left: 2%;
}

.buy_button {
  border: 1.5px solid black;
  border-radius: 10px;
  background-color: #42b983;
  width: 83px;
  height: 35px;
  color: white;
  font-size: 16px;
  margin-top: 10px;
  cursor: pointer;
}
</style>


