<template>
  <div class="products">
    <div class="products_item" v-if="this.items.length !== 0" v-for="(item,i) in items" v-bind:key="i">
      <img :src="item.img" alt="" class="products_item_img">
      <div class="products_item-name">{{ item.name }}</div>
      <div class="products_item-price">{{ item.price }}$</div>
      <div>

        <div class="products_item-price"><button v-on:click="changePics(item.id, 0)" class="products_item_butPrice">-</button>{{ item.pics }}<button v-on:click="changePics(item.id, 1)" class="products_item_butPrice">+</button></div>

      </div>
      <div class="products_item-buttons">
        <button class="products_item_button" v-on:click="removeProduct(item.id)">Remove</button>
      </div>
    </div>
  </div>
  <button v-on:click="buy" class="buy_button">Buy</button>
</template>

<script>
import vueCookies from "vue-cookies";
import axios from "axios";

export default {
  name: "CardPage",
  data() {
    return {
      items: '',
      pics: null,
      user: ''
    }
  },
  async mounted() {
    if(!vueCookies.isKey('user')) {
      window.location.href = '/login'
    }
    axios.defaults.withXSRFToken = true
    const user = vueCookies.get('user')
    const email = user.email
    await axios.post('http://localhost:8000/cardProducts', {
      email: email
    }, {withCredentials: true})
        .then(res=>{
          let pics = res.data[1]
          let items = res.data[0]

          for(let i = 0; i<res.data[0].length; i++) {
            items[i]['pics'] = pics[i].pics
          }
          this.items = items
          console.log(this.id)
          // this.items = this.items[0]
        })
  },
  methods: {
    removeProduct(id) {
      axios.defaults.withXSRFToken = true
      const user = vueCookies.get('user')
      const email = user.email
      axios.post('http://localhost:8000/removeProduct', {
        id: id,
        email: email
      }, {withCredentials: true})
          .then(res=>{
            axios.post('http://localhost:8000/cardProducts', {
              email: email
            }, {withCredentials: true})
                .then(res=>{
                    if (res.data[0].length !== 0) {
                      this.items = res.data
                    } else {
                      this.items = ''
                    }
                  // this.items = this.items[0]
                })
          })
    },
    changePics(id, method) {
      axios.defaults.withXSRFToken = true
      const user = vueCookies.get('user')
      const email = user.email
      axios.post('http://localhost:8000/changePics', {
        email: email,
        id: id,
        method: method
      }, {withCredentials: true})
          .then(res=>{
            axios.post('http://localhost:8000/cardProducts', {
              email: email
            }, {withCredentials: true})
                .then(res=>{
                  if (res.data[0].length !== 0) {
                    let pics = res.data[1]
                    let items = res.data[0]
                    for (let i = 0; i < res.data[0].length; i++) {
                      items[i]['pics'] = pics[i].pics
                    }
                    this.items = items

                  }
                  // this.items = this.items[0]
                })
          })
    },
    buy() {
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
        price: this.totalPrice()
      }, {withCredentials: true})
          .then(res=>{
            window.location.href = res.data
          })
    },
    totalPrice() {
      let total = 0;
      for(let i = 0; i<this.items.length; i++) {
        total += this.items[i].price * this.items[i].pics
      }
      return total;
    }
  }
}
</script>

<style scoped lang="less">
.products {
  display: grid;
  gap: 10px;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  margin-right: 20%;
  margin-left: 20%;
  margin-top: 10px;
&_item {
   border: solid black 1px;
   padding: 10px;
   display: flex;
   flex-direction: column;
   align-items: center;
   &_butPrice {
     background-color: white;
     border: none;
     cursor: pointer;
   }
   &_button {
     background-color: white;
     border: 1px solid black;
     border-radius: 7px;
     cursor: pointer;
   }
  &_img {
   width: 110px;
   height: 130px;
 }
&-button {

 }
}
}

.buy_button {
  border: 1.5px solid black;
  border-radius: 10px;
  background-color: #42b983;
  width: 12%;
  max-width: 83px;
  height: 35px;
  color: white;
  font-size: 16px;
  cursor: pointer;
  position: absolute;
  margin: 2%;
}
</style>