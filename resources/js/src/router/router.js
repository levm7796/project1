import { createWebHistory, createRouter } from 'vue-router'

import HomePage from '../components/HomePage.vue'
import LoginPage from '../components/LoginPage.vue'
import RegisterPage from '../components/RegisterPage.vue'
import CardPage from '../components/CardPage.vue'
import ProductPage from "../components/ProductPage.vue";
import UserPage from "../components/UserPage.vue";
import SuccessPage from "../components/SuccessPage.vue";
import clothPage from "../components/clothPage.vue";
import SiteProduct from "../components/SiteProduct.vue";
import SiteCart from "../components/SiteCart.vue";
import SiteUser from "../components/SiteUser.vue";
import SiteCheckout from "../components/SiteCheckout.vue";
import SiteFavorite from "../components/SiteFavorite.vue";
import SiteSort from "../components/SiteSort.vue";
import SiteSearch from "../components/SiteSearch.vue";
import ResetPassword from "../components/ResetPassword.vue";
import SetPassword from "../components/SetPassword.vue";

const routes = [
				{ path: '/', component: HomePage, name: 'home' },
				{ path: '/login', component: LoginPage, name: 'login' },
				{ path: '/register', component: RegisterPage, name: 'register' },
				{ path: '/buy/:id', component: ProductPage, name: 'product' },
				{ path: '/product/:id', component: SiteProduct, name: 'productCard' },
				{ path: '/user', component: UserPage, name: 'user' },
				{ path: '/card', component: CardPage, name: 'card' },
				{ path: '/success', component: SuccessPage, name: 'success' },
				{ path: '/site', component: clothPage, name: 'clothPage' },
				{ path: '/siteProduct', component: SiteProduct, name: 'SiteProduct' },
				{ path: '/siteCart', component: SiteCart, name: 'SiteCart' },
				{ path: '/siteFavorite', component: SiteFavorite, name: 'SiteFavorite' },
				{ path: '/siteSort/:sort', component: SiteSort, name: 'SiteSort' },
				{ path: '/siteSearch/:search', component: SiteSearch, name: 'SiteSearch' },
				{ path: '/siteUser', component: SiteUser, name: 'SiteUser' },
				{ path: '/checkout', component: SiteCheckout, name: 'SiteCheckout' },
				{ path: '/resetPassword', component: ResetPassword, name: 'ResetPassword' },
				{ path: '/setPassword/:token/:email', component: SetPassword, name: 'SetPassword' },
]


const router = createRouter({
				history: createWebHistory(),
				routes,
})

export default router
