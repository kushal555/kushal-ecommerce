import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import '~/plugins'
import '~/components'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
