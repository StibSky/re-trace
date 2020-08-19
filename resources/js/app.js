require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/* Register our new component: */
Vue.component('contact-form', require('./components/ContactForm.vue'));

const app = new Vue({
    el: '#app'
});
