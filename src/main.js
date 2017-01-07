import Vue = from 'vue'

import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'

Vue.use(VueAxios, axios)

Vue.axios.defaults.headers.common['X-WP-Nonce'] = wp_api_vuejs_poc.nonce;

export default Vue;

new Vue({
  el: '#app',
  render: app => app(App)
});
