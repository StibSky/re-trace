require('./bootstrap');

window.Vue = require('vue');

import Dropdown from 'vue-simple-search-dropdown';

Vue.use(Dropdown);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/* Register our new component: */
Vue.component('stream-form', require('./components/StreamForm.vue').default);

const app = new Vue({
    el: '#app',
    components: {
        'search-dropdown': require('./components/SearchDropdown.vue'.default),
    }
});
