/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-form', require('./components/Login.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from "./vue_route/router";
import store from "./store/store";
// import VueSessionStorage from 'vue-sessionstorage'
// Vue.use(VueSessionStorage)



Vue.component(
    "stripe-card-element",
    require("./components/frontEnd/StripeElement").default
);
import Vue from "vue";
// import VueConfirmDialog from 'vue-confirm-dialog';
// Vue.use(VueConfirmDialog);
// Vue.component('vue-confirm-dialog', VueConfirmDialog.default);
import * as VueGoogleMaps from "vue2-google-maps";
import JsonExcel from "vue-json-excel";
Vue.component("downloadExcel", JsonExcel);
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyBc2ZXH7-3LBYrswWTFjT7UcaLwmhoL5KI",
        libraries: "places" // necessary for places input
    }
});

const app = new Vue({
    el: '#app',
    router,
    store
});
