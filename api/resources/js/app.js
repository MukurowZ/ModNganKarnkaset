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
window.dropzone = require('./dropzone.js');


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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('event-component',require('./components/EventComponent.vue').default);
Vue.component('img-upload-component',require('./components/ImgUploadComponent.vue').default);
Vue.component('create-event-component',require('./components/CreateEventComponent.vue').default);
Vue.component('edit-event-component',require('./components/EditEventComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.onload = function (){
    const app = new Vue({
        el: '#app',
    });
}
