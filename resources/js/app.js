require('./bootstrap');

window.Vue = require('vue');

import Dropdown from 'vue-simple-search-dropdown';

Vue.use(Dropdown);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/* Register our new component: */
Vue.component('stream-form', require('./components/StreamForm.vue').default);
Vue.component('search-dropdown', require('./components/SearchDropdown.vue').default);

const app = new Vue({
    el: '#app'
});
