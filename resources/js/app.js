/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import VueLazyload from 'vue-lazyload'
import Multiselect from 'vue-multiselect'
import ProductCarousel from 'vue-product-carousel'
import Vuetify from 'vuetify/lib'

require('./bootstrap');

Vue.use(BootstrapVue);
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: '/storage/main/warning.svg',
    loading: '/storage/main/Double_Ring-1s-143px.svg',
    attempt: 1
});
Vue.use(Vuetify);

window.Vue = require('vue');
window.axios = require('axios');

import { library }  from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(fas,fab);

import { VueTelInput } from 'vue-tel-input'
import Loading from 'vue-loading-overlay';

import 'vue-loading-overlay/dist/vue-loading.css';
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
Vue.component('multiselect', Multiselect);
Vue.component('ProductCarousel', ProductCarousel);
Vue.component('VueTelInput', VueTelInput);
Vue.component('Loading',Loading);

// Event component
Vue.component('all-event-component',require('./components/Event/AllEventComponent.vue').default);
Vue.component('create-event-component',require('./components/Event/CreateEventComponent.vue').default);
Vue.component('edit-event-component',require('./components/Event/EditEventComponent.vue').default);
Vue.component('show-event-component',require('./components/Event/ShowEventComponent.vue').default);
Vue.component('single-event-component',require('./components/Event/ViewEventComponent.vue').default);
Vue.component('three-event-component',require('./components/Event/ShowEventListComponent.vue').default);

// Core
Vue.component('navbar-component',require('./components/Core/NavbarComponent.vue').default);
Vue.component('footer-component',require('./components/Core/FooterComponent.vue').default);
Vue.component('home-component',require('./components/Core/HomeComponent.vue').default);

// Img
Vue.component('img-select-component',require('./components/Img/ImgSelectComponent.vue').default);

// Contact
Vue.component('contact-form-component',require('./components/contact/contactformComponent.vue').default);
Vue.component('contact-report-component',require('./components/contact/contactreportComponent.vue').default);

// Product & Service
Vue.component('category-component',require('./components/ServiceAndProduct/ProductComponent.vue').default);   // For search product
Vue.component('create-pands-component',require('./components/ServiceAndProduct/CreatePandSComponent.vue').default); // For create
Vue.component('view-product-component',require('./components/ServiceAndProduct/ViewProductComponent.vue').default);     //  For view overall product
Vue.component('three-product-component',require('./components/ServiceAndProduct/ShowProductListComponent.vue').default);     //  For view overall product
Vue.component('all-product-component',require('./components/ServiceAndProduct/AllProductComponent.vue').default);     //  For view overall product
Vue.component('edit-product-component',require('./components/ServiceAndProduct/EditProductComponent.vue').default);     //  For view overall product

// Log in
Vue.component('login-component',require('./components/Login/LoginComponent.vue').default);

// User system
Vue.component('manager-menu-component',require('./components/user/managerMenu.vue').default);
Vue.component('user-creator-component',require('./components/user/createUser.vue').default);
Vue.component('user-manager-component',require('./components/user/userManager.vue').default);
Vue.component('user-editor-component',require('./components/user/editUser.vue').default);
Vue.component('department-creator-component',require('./components/user/createDepartment.vue').default);
Vue.component('department-manager-component',require('./components/user/departmentManager.vue').default);


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
    });
    const foot = new Vue({
        el: '#foot',
    })
}
