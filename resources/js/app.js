require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/* Register our new component: */
Vue.component('stream-form', require('./components/StreamForm.vue'));

const app = new Vue({
    el: '#app'
});
