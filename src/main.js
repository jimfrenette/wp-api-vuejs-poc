var Vue = require('vue');

import App from './App.vue'

export default Vue;

new Vue({
  el: '#app',
  render: app => app(App)
});
