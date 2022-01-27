import Vue from 'vue'
import App from './App.vue'
import router from './router'
import Vuelidate from 'vuelidate'
import store from './store/store'
Vue.config.productionTip = false
Vue.use(Vuelidate)
new Vue({
  router, store,
  render: h => h(App),
}).$mount('#app')