import './bootstrap';
import  { createApp } from 'vue';
import App from './src/App.vue';
import router from './src/router/router';
import vueCookies from 'vue-cookies';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';


const app = createApp(App)
app.use(router)
app.use(ToastPlugin)
app.use(vueCookies)
app.mount('#app')
