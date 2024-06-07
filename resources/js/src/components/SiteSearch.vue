<template>
<HeaderPart></HeaderPart>
  <div class="search">
    <div class="search_searchFields">
      <input type="text" class="search_searchField" v-model="search">
      <button class="search_searchText">Search</button>
    </div>
    <div class="search_products">
        <div style="display: flex; flex-direction: row; margin-bottom: 20px" v-for="item in filteredProducts" :key="item.id">
          <div class="search_product">
            <img class="search_product-img" :src="'/src/assets/img/'+item.img +'.png'" v-on:click="linkToProduct(item.id)" style="cursor: pointer">
            <div class="search_product-description">{{ item.description }}</div>
            <div class="search_product-name" v-if="this.user.length !== 0">
              {{ item.name }}
<!--              <div class="search_product-button" v-on:click="addToCart(item.id)" style="cursor: pointer; margin-left: 10px">+</div>-->
              <img class="search_product-favorite" v-on:click="addToFavorite(item.id)" style="cursor: pointer; margin-right: auto; margin-left: 10px" :src="favorite2">
              <div class="search_product-price">$ {{item.price}}</div></div>

            <div class="search_product-name" v-else>{{ item.name }}<div class="search_product-price">$ {{item.price}}</div></div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import HeaderPart from "./HeaderPart.vue";
import {useRoute} from "vue-router";
import axios from "axios";
import vueCookies from "vue-cookies";
import favorite2 from '../assets/img/favorite2.svg'

export default {
name: "SiteSearch",
  components: {
  HeaderPart
  },
  data() {
    return {
      items: [],
      user: [],
      search: '',
      favorite2: favorite2,
    }
  },
  mounted() {
    const route = useRoute();
    this.search = route.params.search;
    document.querySelector('.search_searchField').value = this.search
    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.get('http://localhost:8000/products')
        .then(async res=>{
          this.items = await res.data
          this.items = await this.items[0]
        })
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
    }
  },
  methods: {
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
  },
  computed: {
    filteredProducts() {
      if(this.items.length > 1) {
        return this.items.filter(p => {
          // return true if the product should be visible

          // in this example we just check if the search string
          // is a substring of the product name (case insensitive)
          return p.name.toLowerCase().indexOf(this.search.toLowerCase()) != -1;
        });
      }
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


.search_searchField {
  background: url("../../../public/assets/img/search.svg") no-repeat scroll 15px 18px;
  padding-left: 40px;
  width: 254px;
  height: 50px;
  border-radius: 3px;
  border: none;
  background-color: rgba(0,0,0,0.1);
  position: relative;
  margin-right: -75px;
  padding-right: 73px;
  /*margin-bottom: 20px;*/
}

.search_searchField[type="text"] {
  font-size: 20px;
}

.search_searchText {
  font-family: "Noto Sans", sans-serif;
  font-weight: 600;
  font-size: 14px;
  text-transform: capitalize;
  border: none;
  background: none;
  cursor: pointer;
  z-index: 2;
}

.search_searchFields {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.search {
  margin-top: 50px;
}

.search_products {
  /*display: flex;*/
  /*flex-direction: row;*/
  /*justify-content: space-between;*/
  /*flex-wrap: wrap;*/

  display: grid;
  grid-template-columns: repeat(auto-fit, 304px);
  grid-column-gap: 64px;
  grid-row-gap: 1em;
}

.search_product-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.search_product-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.search_product-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.search_product-img {
  width: 304px;
  height: 313px;
}

.search_product-favorite {
  width: 20px;
  height: 20px;
}
</style>
