<template>
  <HeaderPart/>
  <button v-on:click="clickButton">Button</button>
  <div class="notification">
    <div class="notification_block">was added to favorite</div>
  </div>
  <div class="search">
    <div class="search_tabs" style="width: 60px;">
      <div class="search_menText" onclick="window.location.href = '/siteSort/men'" style="cursor: pointer">Men</div>
      <div class="search_womenText" onclick="window.location.href = '/siteSort/women'" style="cursor: pointer">Women</div>
      <div class="search_kidsText" onclick="window.location.href = '/siteSort/kids'" style="cursor: pointer">Kids</div>
    </div>


    <div class="search_field">
      <img src="" alt="" class="search_searchImg">
      <div class="search_searchFields">
        <input type="text" class="search_searchField" tabindex="-1" v-model="search" @keyup.enter="keyupEnter">
        <button class="search_searchText" onclick="window.location.href = '/siteSearch/'+document.querySelector('.search_searchField').value">Search</button>
      </div>
    </div>


  </div>
  <div class="collection">
    <div class="collection_titles">
      <div class="collection_titles-title title">new <br> collection</div>
      <div class="collection_titles-description">
        Summer <br>
        2024
      </div>
    </div>
    <div class="collection_buttons">
<!--      <button class="collection_buttons-toShop">go to shop <svg width="50" height="14" viewBox="0 0 50 14" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--        <path d="M1 7.75C0.585785 7.75 0.25 7.41421 0.25 7C0.25 6.58579 0.585785 6.25 1 6.25V7.75ZM48.5 7L49.0303 6.46967C49.3232 6.76256 49.3232 7.23744 49.0303 7.53033L48.5 7ZM41.9697 1.53033C41.6768 1.23744 41.6768 0.762563 41.9697 0.46967C42.2626 0.176777 42.7374 0.176777 43.0303 0.46967L41.9697 1.53033ZM43.0303 13.5303C42.7374 13.8232 42.2626 13.8232 41.9697 13.5303C41.6768 13.2374 41.6768 12.7626 41.9697 12.4697L43.0303 13.5303ZM1 6.25H48.5V7.75H1V6.25ZM47.9697 7.53033L41.9697 1.53033L43.0303 0.46967L49.0303 6.46967L47.9697 7.53033ZM49.0303 7.53033L43.0303 13.5303L41.9697 12.4697L47.9697 6.46967L49.0303 7.53033Z" fill="black"/>-->
<!--      </svg></button>-->
<!--      <div class="collection_buttons-arrows">-->
<!--        <button class="collection_buttons-arrowLeft">-->
<!--          <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--            <path d="M6.73994 1.67267C7.11145 1.26402 7.08133 0.631567 6.67267 0.26006C6.26401 -0.111447 5.63157 -0.0813301 5.26006 0.327327L6.73994 1.67267ZM1 6.5L0.26006 5.82733C-0.0866866 6.20875 -0.0866866 6.79125 0.26006 7.17267L1 6.5ZM5.26006 12.6727C5.63157 13.0813 6.26401 13.1114 6.67267 12.7399C7.08133 12.3684 7.11145 11.736 6.73994 11.3273L5.26006 12.6727ZM5.26006 0.327327L0.26006 5.82733L1.73994 7.17267L6.73994 1.67267L5.26006 0.327327ZM0.26006 7.17267L5.26006 12.6727L6.73994 11.3273L1.73994 5.82733L0.26006 7.17267Z" fill="#1E1E1E"/>-->
<!--          </svg>-->
<!--        </button>-->
<!--        <button class="collection_buttons-arrowRight">-->
<!--          <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--            <path d="M0.26006 11.3273C-0.111447 11.736 -0.0813304 12.3684 0.327327 12.7399C0.735985 13.1114 1.36843 13.0813 1.73994 12.6727L0.26006 11.3273ZM6 6.5L6.73994 7.17267C7.08669 6.79125 7.08669 6.20875 6.73994 5.82733L6 6.5ZM1.73994 0.327327C1.36843 -0.0813306 0.735985 -0.111447 0.327328 0.26006C-0.08133 0.631567 -0.111447 1.26401 0.26006 1.67267L1.73994 0.327327ZM1.73994 12.6727L6.73994 7.17267L5.26006 5.82733L0.26006 11.3273L1.73994 12.6727ZM6.73994 5.82733L1.73994 0.327327L0.26006 1.67267L5.26006 7.17267L6.73994 5.82733Z" fill="#1E1E1E"/>-->
<!--          </svg>-->
<!--        </button>-->
<!--      </div>-->
      <div class="collection_imgs">
        <img :src="img1" alt="" style="margin-right: 41px">
        <img :src="img2" alt="">
      </div>
    </div>
  </div>
  <div class="week">
    <div class="week_title title" style="margin-bottom: 33px;">New <br> this week</div>
    <div class="week_products">

<!--          <div class="products_item" v-for="i in 3" v-bind:key="i">-->
<!--            <img src="https://static5.cilory.com/238651-thickbox_default/nologo-white-polo-t-shirt-with-navy-collar.jpg" alt="" class="products_item_img">-->
<!--            <div class="products_item-name"></div>-->
<!--            <div class="products_item-price">10$</div>-->
<!--            <div class="products_item-buttons">-->
<!--            <button class="products_item-button" style="margin-right: 5px">Buy</button>-->
<!--            <button class="products_item-button">Add to card</button>-->
<!--            </div>-->
<!--          </div>-->

            <div class="week_product" v-for="i in 4" v-bind:key="i" v-if="this.items[1]">
              <img class="week_product-img" :src="'/src/assets/img/'+items[i-1].img +'.png'" v-on:click="linkToProduct(items[i-1].id)" style="cursor: pointer">
              <div class="week_product-description">{{ items[i-1].description }}</div>
              <div class="week_product-name" v-if="this.user.length !== 0">
                {{ items[i - 1].name }}
<!--                <div class="week_product-button" v-on:click="addToCart(items[i-1].id)" style="cursor: pointer; margin-left: 10px">+</div>-->
                <img class="week_product-favorite" v-on:click="addToFavorite(items[i-1].id)" @click="notify" style="cursor: pointer; margin-right: auto; margin-left: 10px" :src="favorite2">
                <div class="week_product-price">$ {{items[i-1].price}}</div></div>

              <div class="week_product-name" v-else>{{ items[i - 1].name }}<div class="week_product-price">$ {{items[i-1].price}}</div></div>
            </div>

<!--      <div class="week_product">-->
<!--        <img class="week_product-img" :src="img3">-->
<!--        <button class="week_product-button">+</button>-->
<!--        <div class="week_product-description">V-Neck T-Shirt</div>-->
<!--        <div class="week_product-name">Embroidered Seersucker Shirt<div class="week_product-price">$ 99</div></div>-->
<!--      </div>-->

<!--      <div class="week_product">-->
<!--        <img class="week_product-img" :src="img4">-->
<!--        <button class="week_product-button">+</button>-->
<!--        <div class="week_product-description">Cotton T Shirt<div class="week_product-colors" style="background-color: #ffffff"></div>+5</div>-->
<!--        <div class="week_product-name">Basic Slim Fit T-Shirt<div class="week_product-price">$ 99</div></div>-->
<!--      </div>-->

<!--      <div class="week_product">-->
<!--        <img class="week_product-img" :src="img5">-->
<!--        <button class="week_product-button">+</button>-->
<!--        <div class="week_product-description">Henley T-Shirt<div class="week_product-colors" style="background-color: #DBDCCE"></div>+3</div>-->
<!--        <div class="week_product-name">Blurred Print T-Shirt<div class="week_product-price">$ 99</div></div>-->
<!--      </div>-->

<!--      <div class="week_product">-->
<!--        <img class="week_product-img" :src="img6">-->
<!--        <button class="week_product-button">+</button>-->
<!--        <div class="week_product-description">Crewneck T-Shirt<div class="week_product-colors" style="background-color: #EAE8D9"></div>+2</div>-->
<!--        <div class="week_product-name">Full Sleeve Zipper<div class="week_product-price">$ 99</div></div>-->
<!--      </div>-->
    </div>
<!--    <div class="week_arrows">-->
<!--      <button class="week_arrow-arrowLeft">-->
<!--        <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--          <path d="M6.73994 1.67267C7.11145 1.26402 7.08133 0.631567 6.67267 0.26006C6.26401 -0.111447 5.63157 -0.0813301 5.26006 0.327327L6.73994 1.67267ZM1 6.5L0.26006 5.82733C-0.0866866 6.20875 -0.0866866 6.79125 0.26006 7.17267L1 6.5ZM5.26006 12.6727C5.63157 13.0813 6.26401 13.1114 6.67267 12.7399C7.08133 12.3684 7.11145 11.736 6.73994 11.3273L5.26006 12.6727ZM5.26006 0.327327L0.26006 5.82733L1.73994 7.17267L6.73994 1.67267L5.26006 0.327327ZM0.26006 7.17267L5.26006 12.6727L6.73994 11.3273L1.73994 5.82733L0.26006 7.17267Z" fill="#1E1E1E"/>-->
<!--        </svg>-->
<!--      </button>-->
<!--      <button class="week_arrow-arrowRight">-->
<!--        <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--          <path d="M0.26006 11.3273C-0.111447 11.736 -0.0813304 12.3684 0.327327 12.7399C0.735985 13.1114 1.36843 13.0813 1.73994 12.6727L0.26006 11.3273ZM6 6.5L6.73994 7.17267C7.08669 6.79125 7.08669 6.20875 6.73994 5.82733L6 6.5ZM1.73994 0.327327C1.36843 -0.0813306 0.735985 -0.111447 0.327328 0.26006C-0.08133 0.631567 -0.111447 1.26401 0.26006 1.67267L1.73994 0.327327ZM1.73994 12.6727L6.73994 7.17267L5.26006 5.82733L0.26006 11.3273L1.73994 12.6727ZM6.73994 5.82733L1.73994 0.327327L0.26006 1.67267L5.26006 7.17267L6.73994 5.82733Z" fill="#1E1E1E"/>-->
<!--        </svg>-->
<!--      </button>-->
<!--    </div>-->
  </div>
  <div class="collections">
    <div class="collections_title title">XIV <br>
      Collections <br>
      23-24</div>
    <div class="collections_tabs">
      <div class="collections_tabs-titles">
        <div class="tabs_titles-title" id="tab1" v-on:click="changeTab(1); productSort('all')">(ALL)</div>
        <div class="tabs_titles-title" id="tab2" v-on:click="changeTab(2); productSort('men')">Men</div>
        <div class="tabs_titles-title" id="tab3" v-on:click="changeTab(3); productSort('women')">Women</div>
        <div class="tabs_titles-title" id="tab4" v-on:click="changeTab(4); productSort('kids')">KIDS</div>
      </div>
      <div class="collections_tabs-another">
        <div class="tabs_another-filter">Filters(+)</div>
        <div class="tabs_another-sorts">
          Sorts(-)
          <div class="tabs_another-more">
            Less to More <br>
            More to Less
          </div>
        </div>
      </div>
    </div>
    <hr style="margin-top: 23px;
    background-color: #DFDFDF; border: none; height: 1px;">
    <div class="collections_products">

<!--      <div class="collections_product" v-for="i in 3" v-bind:key="i" v-if="this.items[1]">-->
<!--        <img class="collections_product-img" :src="'/src/assets/img/'+items[i+3].img +'.png'" v-on:click="linkToProduct(items[i+3].id)" style="cursor: pointer">-->
<!--        <div class="collections_product-description">{{ items[i+3].description }}<div class="week_product-colors" style="background-color: #ffffff"></div>-->
<!--          +{{ items[i+3].colors }}</div>-->
<!--        <div class="collections_product-name" v-if="this.user.length !== 0">-->
<!--          {{ items[i+3].name }}-->
<!--          <div class="collections_product-button" v-on:click="addToCart(items[i+3].id)" style="cursor: pointer; margin-left: 10px">+</div>-->
<!--          <img class="collections_product-favorite" v-on:click="addToFavorite(items[i+3].id)" style="cursor: pointer; margin-right: auto; margin-left: 10px" :src="favorite2">-->
<!--          <div class="week_product-price">$ {{items[i+3].price}}</div></div>-->
<!--        <div class="collections_product-name" v-else>-->
<!--          {{ items[i+3].name }}-->
<!--          <div class="week_product-price">$ {{items[i+3].price}}</div></div>-->
<!--      </div>-->

              <div class="collections_product" v-for="item in itemsSort" v-bind:key="i" v-if="this.itemsSort.length !== 0">
                <img class="collections_product-img" :src="'/src/assets/img/'+item.img +'.png'" v-on:click="linkToProduct(item.id)" style="cursor: pointer">
                <div class="collections_product-description">{{ item.description }}<div class="week_product-colors" style="background-color: #ffffff"></div>
                  +{{ item.colors }}</div>
                <div class="collections_product-name" v-if="this.user.length !== 0">
                  {{ item.name }}
<!--                  <div class="collections_product-button" v-on:click="addToCart(item.id)" style="cursor: pointer; margin-left: 10px">+</div>-->
                  <img class="collections_product-favorite" v-on:click="addToFavorite(item.id); notify" style="cursor: pointer; margin-right: auto; margin-left: 10px" :src="favorite2">
                  <div class="week_product-price">$ {{item.price}}</div></div>
                <div class="collections_product-name" v-else>
                  {{ item.name }}
                  <div class="week_product-price">$ {{item.price}}</div></div>
              </div>
              <div v-else class="collections_message">We don't have products!</div>
    </div>
  </div>
  <div class="description">
    <div class="description_text">
      <div class="description_text-title">Our Approach to fashion design</div>
      <div class="description_text-content">at elegant vogue , we blend creativity with craftsmanship to create fashion that transcends trends and stands the test of time each design is meticulously crafted, ensuring the highest quelity exqulsite finish</div>
    </div>
    <div class="description_images">
      <img :src="img10" alt="" class="description_images-img1">
      <img :src="img11" alt="" class="description_images-img2">
      <img :src="img12" alt="" class="description_images-img3">
      <img :src="img13" alt="" class="description_images-img4">
    </div>
  </div>
  <div class="footer">
    <div class="footer_leftPart">
      <div class="footer_leftPart-info">
        <div class="footer_leftPart-info-title">info</div>
        <div class="footer_leftPart-info-tabs">
          <div>pricing</div>
          <div>about</div>
          <div>contacts</div>
        </div>
      </div>
      <div class="footer_leftPart-languages">
        <div class="footer_leftPart-languages-title">languages</div>
        <div class="footer_leftPart-languages-tabs">
          <div>eng</div>
          <div>esp</div>
          <div>sve</div>
        </div>
      </div>
    </div>
    <div class="footer_rightPart">
      <div style="color: #ECECEC; margin-bottom: -63px">vr</div> <br>
      xiv <br>
      qr
    </div>
    <div class="footer_down">
      <div>© 2024 — copyright</div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import vueCookies from "vue-cookies";
import userImg from "../assets/img/user.svg";
import img1 from "../assets/img/img1.png";
import img2 from "../assets/img/img2.png";
import img3 from "../assets/img/img3.png";
import img4 from "../assets/img/img4.png";
import img5 from "../assets/img/img5.png";
import img6 from "../assets/img/img6.png";
import img7 from "../assets/img/img7.png";
import img8 from "../assets/img/img8.png";
import img9 from "../assets/img/img9.png";
import img10 from "../assets/img/img10.png";
import img11 from "../assets/img/img11.png";
import img12 from "../assets/img/img12.png";
import img13 from "../assets/img/img13.png";
import HeaderPart from "./HeaderPart.vue";
import favorite2 from '../assets/img/favorite2.svg'

// import { ref } from "vue";
// import {useToast} from 'vue-toast-notification';
// import 'vue-toast-notification/dist/theme-sugar.css';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  name: "HomePage",
  setup() {
    const notify = () => {
      toast.success("Was added to Favorite", {
        autoClose: 1000,
      }); // ToastOptions
    }
    return { notify };
  },
  data() {
    return {
      user: [],
      items: [],
      itemsSort: [],
      img1: img1,
      img2: img2,
      img3: img3,
      img4: img4,
      img5: img5,
      img6: img6,
      img7: img7,
      img8: img8,
      img9: img9,
      img10: img10,
      img11: img11,
      img12: img12,
      img13: img13,
      favorite2: favorite2,
      search: ''
    }
  },
  components: {
    HeaderPart
  },
  mounted() {
    // let instance = this.$toast.open('You did it!');
    // instance.dismiss();
    // this.$toast.clear();


    axios.get('http://localhost:8000/sanctum/csrf-cookie')
    axios.get('http://localhost:8000/products')
      .then(async res=>{
        this.items = await res.data
        this.items = await this.items[0]
        await this.productSort('all')
        console.log(this.items)
      })
    if(vueCookies.isKey('user')) {
      let user = vueCookies.get('user')
      console.log(user)
      this.user = user
    }
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
    logout() {
      axios.get('http://localhost:8000/logout')
      document.cookie = 'user' + '=; Max-Age=0'
      this.user = []
      window.location.href = '/'
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

      // const toast = useToast();
      //
      // // Use it!
      // toast("I'm a toast!");
      //
      // // or with options
      // toast.success("My toast content", {
      //   timeout: 2000
      // });
      // These options will override the options defined in the "app.use" plugin registration for this specific toast

      // Make it available inside methods

      // this.$toast.open({
      //   message: 'Something went wrong!',
      //   type: 'error',
      //   // all of other options may go here
      // });
    },

    async changeTab(x) {
      for(let i = 0; i<4; i++) {
        document.getElementById('tab'+(i+1)).style.color = '#8A8A8A'
      }
      document.getElementById('tab'+x).style.color = 'black'
    },

    productSort(sort) {
        this.itemsSort = []
        const items = this.items
      if(sort == 'all') {
        for (let i = 4; i < items.length; i++) {
          this.itemsSort.push(items[i])
        }
      } else {
        for (let i = 4; i < items.length; i++) {
          if (items[i].sort == sort) {
            this.itemsSort.push(items[i])
          }
        }
      }
        console.log(this.itemsSort)
    },
    keyupEnter() {
      window.location.href = '/siteSearch/'+document.querySelector('.search_searchField').value
    },
    clickButton() {
         axios.post("http://localhost:8000/api/productById", {
            id: 1,
        }, {withCredentials: true})
    }

  },
}
</script>

<style scoped lang="less">
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

.title {
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 800;
  font-size: 48px;
  line-height: 0.8;
  position: relative;
  z-index: 2;
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

.search {
  /*font-family: "Beatrice Deck Trial Extrabold";*/
  font-family: "PT Serif", serif;
  font-weight: 400;
  font-size: 16px;
  text-transform: uppercase;
  position: relative;
  margin-left: 52px;
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

.search_searchField {
  background: url("./src/assets/img/search.svg") no-repeat scroll 15px 18px;
  padding-left: 40px;
  width: 254px;
  height: 50px;
  border-radius: 3px;
  border: none;
  background-color: rgba(0,0,0,0.1);
  position: relative;
  margin-right: -75px;
  padding-right: 73px;
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
}

.search_tabs {
  font-family: 'Beatrice Deck Trial', sans-serif;
}

.header {
  margin-bottom: 60px;
}



.collection {
  margin-left: 52px;
  margin-top: 94px
}

.collection_titles-description {
  font-family: "Noto Sans", sans-serif;
}

.collection_buttons-toShop {
  margin-top: 200px;
  border: none;
  background-color: rgba(0, 0, 0, 0.1);
  height: 40px;
  width: 219px;
  text-transform: capitalize;
  font-family: "Noto Sans", sans-serif;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 15px;
  padding-left: 27px;
  padding-right: 19px;
  margin-right: 40px;
}

.collection_buttons-arrowLeft {
  height: 40px;
  width: 40px;
  padding: 0;
  background: none;
  border: solid #A3A3A3 1px;
  margin-right: 15px;
}

.collection_buttons-arrowRight {
  height: 40px;
  width: 40px;
  padding: 0;
  background: none;
  border: solid #A3A3A3 1px;
  margin-right: 10px;
}

.collection_buttons {
  display: flex;
  flex-direction: row;
  /*justify-content: space-between;*/
}

.collection_buttons-arrows {
  margin-top: 200px;
}

/*.collection_titles {*/
/*  width: 318px;*/
/*}*/

.collection_imgs {
  margin-top: -134px;
  margin-left: 388px;
}

.week {
  margin-left: 52px;
  margin-top: 150px;
  margin-right: 52px;
}

.week_products {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  flex-wrap: wrap;
}

.week_product-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.week_product-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.week_product-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.week_arrow-arrowLeft {
  height: 40px;
  width: 40px;
  padding: 0;
  background: none;
  border: solid #A3A3A3 1px;
  margin-right: 15px;
}

.week_arrow-arrowRight {
  height: 40px;
  width: 40px;
  padding: 0;
  background: none;
  border: solid #A3A3A3 1px;
}

.week_product-button {
  //display: none;
  //position: absolute;
  //margin-right: 10px;
}

.week_arrows {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.week_product-colors {
  margin-left: 7px;
  margin-right: 3px;
  width: 12px;
  height: 12px;
  border: solid #A3A3A3 1px;
}

.collections {
  margin-left: 52px;
  margin-top: 116px;
  margin-right: 52px;
}

.collections_tabs {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

.tabs_titles-title {
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 400;
  font-size: 16px;
  color: #8A8A8A;
  cursor: pointer;
}

.tabs_titles-title:first-child {
  color: black;
}

.collections_tabs-titles {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  width: 287px;
  margin-top: 62px;
}

.collections_tabs-another {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  margin-top: 22px;
  width: 265px;
  height: 57px;

  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 500;
  font-size: 14px;
  color: black;
}

.tabs_another-more {
  margin-top: 15px;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 500;
  font-size: 14px;
  color: rgba(0, 0, 0, 0.6);
}

.collections_products {
  //display: flex;
  //flex-direction: row;
  //justify-content: space-between;
  margin-top: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, 366px);
  grid-column-gap: 155px;
  grid-row-gap: 1em;
}

.collections_product-description {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 12px;
  color: rgba(0,0,0, 0.6);
  display: flex;
  flex-direction: row;
}

.collections_product-name {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.collections_product-price {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-weight: 400;
  font-size: 14px;
}

.description_text {
  display: flex;
  align-items: center;
  flex-direction: column;
}

.description_text-title {
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 500;
  font-size: 48px;
  text-transform: uppercase;
  color: black;
  text-align: center;
}

.description_text-content {
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 300;
  font-size: 16px;
  color: black;
  width: 685px;
  line-height: 1.5;
  letter-spacing: 2.3px;
  text-align: center;
}

.description {
  margin-top: 230px;
}

.description_images {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

.description_images-img1,
.description_images-img3
{
  margin-top: 108px;
  height: 389px;
}

.description_images-img2,
.description_images-img4 {
  margin-top: 182px;
}

.footer {
  height: 628px;
  background-color: #f5f5f5;
  /*background-color: #ff4141;*/
  margin-top: 148px;
  padding: 125px 609px 0 167px;
  display: flex;
  flex-direction: row;
  color: black
}

.footer_leftPart-info-title,
.footer_leftPart-languages-title
{
  margin-bottom: 35px;
}

.footer_leftPart-info {
  margin-bottom: 66px;
}

.footer_leftPart {
  margin-bottom: 255px;
  margin-right: 288px;
  color: rgba(0,0,0,60%);
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
}

.footer_rightPart {
  font-size: 80px;
  text-transform: uppercase;
  font-family: 'Beatrice Deck Trial', sans-serif;
  font-weight: 900;
  line-height: 0.8;
  letter-spacing: -2%;
  padding-top: 92px
}

.footer_down {
  margin-top: 514px;
  margin-left: -143px;
  font-size: 10px;
  color: rgba(30, 30, 30,40%);
  font-family: 'Beatrice Deck Trial', sans-serif;
}

.week_product-favorite,
.collections_product-favorite {
  width: 20px;
  height: 20px;
}

.collections_message {
  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 20px;
}

.notification_block {
  width: 264px;
  height: 40px;
  background-color: #D9D9D9;
  display: none;
  align-items: center;
  justify-content: center;
  text-transform: capitalize;

  font-family: 'Beatrice Deck Trial', sans-serif;
  color: black;
  font-size: 15px;

  border-radius: 5px;
}

.notification {
  position: fixed;
  bottom: 10px;
  right: 10px;
}

</style>
