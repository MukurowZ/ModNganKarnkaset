/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
// import VueSelectImage from 'vue-select-image'

require('./bootstrap');
// require('vue-select-image/dist/vue-select-image.css')

Vue.use(BootstrapVue);
// Vue.use(VueSelectImage);
window.Vue = require('vue');
window.axios = require('axios');

import { library }  from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(fas,fab);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('font-awesome-icon', FontAwesomeIcon);

// Event component
Vue.component('event-component',require('./components/Event/EventComponent.vue').default);
Vue.component('create-event-component',require('./components/Event/CreateEventComponent.vue').default);
Vue.component('edit-event-component',require('./components/Event/EditEventComponent.vue').default);
Vue.component('show-event-component',require('./components/Event/ShowEventComponent.vue').default);

// Core
Vue.component('navbar-component',require('./components/Core/NavbarComponent.vue').default);

// Category
Vue.component('category-component',require('./components/ServiceAndProduct/CategoryComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.onload = function (){
    const app = new Vue({
        el: '#app',
    });
    const nav = new Vue({
        el: '#nav',
    })
}
