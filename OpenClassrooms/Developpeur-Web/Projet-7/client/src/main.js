import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueRessource from 'vue-resource'
import VueSession from 'vue-session'

Vue.use(VueSession)

Vue.use(VueRessource)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
