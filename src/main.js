import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App.vue'

Vue.use(VueResource);

Vue.http.headers.common['X-WP-Nonce'] = wp_api_vuejs_poc.nonce;
Vue.http.options.root = wp_api_vuejs_poc.rest_url;

export default Vue;

new Vue({
  el: '#app',
  render: app => app(App)
});
