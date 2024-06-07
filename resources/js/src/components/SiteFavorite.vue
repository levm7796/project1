<template>
<HeaderPart></HeaderPart>
  <div class="favorite">
    <div class="favorite_title">favorite <img :src="favorite2" style="width: 30px; height: 30px; margin-left: 15px; margin-bottom: 5px"></div>
    <hr style="border: none; background-color: #D9D9D9; height: 1px;">
    <div class="favorite_products" v-if="this.items.length >= 1">
      <div style="display: flex; flex-direction: row; margin-bottom: 20px" v-for="(item, i) in items" v-bind:key="i">
        <div class="favorite_product">
          <img class="favorite_product-img" :src="'/src/assets/img/'+item.img +'.png'" v-on:click="linkToProduct(item.id)" style="cursor: pointer">
          <div class="favorite_product-description">{{ item.description }}</div>
          <div class="favorite_product-name">
            {{ item.name }}
<!--            <div class="week_product-button" v-on:click="addToCart(item.id)" style="cursor: pointer; margin-right: auto; margin-left: 10px">+</div>-->
            <div class="favorite_product-price">$ {{item.price}}</div>
          </div>
        </div>
        <div style="margin-left: 10px; cursor: pointer;" v-on:click="removeFavorite(item.id)">X</div>
        </div>
    </div>
    <a href="/" v-else style="color: black; font-family: 'Beatrice Deck Trial', sans-serif;">Go To Shop</a>
  </div>
</template>

<script>
import HeaderPart from "./HeaderPart.vue";
import vueCookies from "vue-cookies";
import axios from "axios";
import favorite2 from '../assets/img/favorite2.svg'

export default {
  name: "SiteFavorite",
  data() {
    return {
      items: [],
      user: [],
      favorite2: favorite2,
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
    }

    axios.defaults.withXSRFToken = true
    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.post('http://localhost:8000/favoriteProducts', {
      email: this.user.email
    }, {withCredentials: true})
        .then(async res=>{
          let items = res.data[0]
          this.items = items
          console.log(this.items)
        })
  },

  methods: {
    async addToCard(id) {
      if(vueCookies.isKey('user')) {
        const email = this.user.name
        axios.defaults.withXSRFToken = true
        await axios.post("http://localhost:8000/addToCard", {
          email: email,
          productId: id
        }, {withCredentials: true})
      } else {
        window.location.href = '/login'
      }
    },
    removeFavorite(id) {
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/removeFavorite', {
        id: id,
        email: this.user.email
      }, {withCredentials: true})
      .then(()=> {
        axios.post('http://localhost:8000/favoriteProducts', {
          email: this.user.email
        }, {withCredentials: true})
            .then(async res=>{
              let items = res.data[0]

              this.items = items

              console.log(this.items)
            })
      })

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

.favorite_products {
  /*display: flex;*/
  /*flex-direction: row;*/
  /*justify-content: space-between;*/
  /*flex-wrap: wrap;*/

  display: grid;
  grid-template-columns: repeat(auto-fit, 304px);
  grid-column-gap: 64px;
  grid-row-gap: 1em;
}

.favorite_product-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.favorite_product-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.favorite_product-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.favorite {
  margin-top: 100px;
  margin-left: 50px;
  width: 691px;
}

.favorite_title {
  color: black;
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
  font-size: 30px;
  display: flex;
  align-items: center;
}

.favorite_product-img {
  width: 304px;
  height: 313px;
}
</style>
