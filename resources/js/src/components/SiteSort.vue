<template>
<HeaderPart></HeaderPart>
  <div class="search_tabs" style="width: 60px;">
    <div class="search_menText" onclick="window.location.href = '/siteSort/men'" style="cursor: pointer">Men</div>
    <div class="search_womenText" onclick="window.location.href = '/siteSort/women'" style="cursor: pointer">Women</div>
    <div class="search_kidsText" onclick="window.location.href = '/siteSort/kids'" style="cursor: pointer">Kids</div>
  </div>
  <div class="sort">
    <div class="sort_title">for {{sort}}</div>
    <hr>
    <div class="sort_products">
      <div class="sort_product" v-for="item in itemsSort" v-bind:key="i" v-if="this.items[1]">
        <img class="sort_product-img" :src="'/src/assets/img/'+item.img +'.png'" v-on:click="linkToProduct(item.id)" style="cursor: pointer">
        <div class="sort_product-description">{{ item.description }}<div class="sort_product-colors" :style="{'background': item.color}"></div>
          +{{ item.colors }}</div>
        <div class="sort_product-name" v-if="this.user.length !== 0">
          {{ item.name }}
<!--          <div class="sorts_product-button" v-on:click="addToCart(item.id)" style="cursor: pointer; margin-left: 10px">+</div>-->
          <img class="sort_product-favorite" v-on:click="addToFavorite(item.id)" style="cursor: pointer; margin-right: auto; margin-left: 10px" :src="favorite2">
          <div class="sort_product-price">$ {{item.price}}</div></div>
        <div class="sort_product-name" v-else>
          {{ item.name }}
          <div class="sort_product-price">$ {{item.price}}</div></div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderPart from "./HeaderPart.vue";
import {useRoute} from "vue-router";
import axios from "axios";
import vueCookies from "vue-cookies";
import favorite2 from '../assets/img/favorite2.svg';

export default {
  name: "SiteSort",
  components: {
    HeaderPart
  },
  data() {
    return {
      sort: '',
      user: [],
      items: [],
      itemsSort: [],
      favorite2: favorite2,
    }
  },
  mounted() {
    const route = useRoute();
    this.sort = route.params.sort;

    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.get('http://localhost:8000/products')
        .then(async res=>{
          this.items = await res.data
          this.items = await this.items[0]
          await this.productSort(this.sort)
          console.log(this.itemsSort)
        })
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
    }
  },
  methods: {
    productSort(sort) {
      this.itemsSort = []
      const items = this.items
      for (let i = 0; i < items.length; i++) {
         if (items[i].sort == sort) {
            this.itemsSort.push(items[i])
         }
      }
      console.log(this.itemsSort)
    },

    addToCart(id) {
      const size = 'XS'
      const color = 'default'
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/addToCart', {
        id: id,
        size: size,
        color: color,
        email: this.user.email,
      }, {withCredentials: true})
    },

    linkToProduct(x) {
      window.location.href = '/product/'+x
    },

    addToFavorite(id) {
      axios.get('http://localhost:8000/sanctum/csrf-cookie')
      axios.defaults.withXSRFToken = true
      axios.post('http://localhost:8000/addToFavorite', {
        id: id,
        email: this.user.email,
      }, {withCredentials: true})
    },
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


.sort {
  margin-top: 20px;
  margin-left: 52px;
  margin-right: 52px;
}

.sort_title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 30px;
  font-weight: 600;
}

.sort_products {
  margin-top: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, 304px);
  grid-column-gap: 64px;
  grid-row-gap: 1em;
}

.sort_product-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.sort_product-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.sort_product-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.sort_product-img {
  width: 304px;
  height: 313px;
}

.sort_product-favorite {
  width: 20px;
  height: 20px;
}

.sort_product-colors {
  margin-left: 7px;
  margin-right: 3px;
  width: 12px;
  height: 12px;
  border: solid #A3A3A3 1px;
}

.search_tabs {
  font-family: 'Beatrice Deck Trial', sans-serif;
  text-transform: uppercase;
  margin-left: 50px;
  margin-top: 30px;
}
</style>
