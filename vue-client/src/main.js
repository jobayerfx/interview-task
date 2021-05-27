import Vue from 'vue'
import App from './App.vue'
import router from './router'

import 'bootstrap/dist/css/bootstrap.min.css'
import '@/assets/css/main.css'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'
axios.defaults.headers.common['Authorization'] = 'Bearer ' +  (localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).token : '')
Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
