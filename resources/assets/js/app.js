
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

import  axios from 'axios';
import Routes from './routes.js';
import Vuetify from 'vuetify';
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';


import App from './views/App';

import interceptor from './axios-interceptor';

Vue.use([axios,interceptor]);
Vue.use(Vuetify);
const opts = {};
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

const app = new Vue({
    el:'#app',
    axios,
    vuetify: new Vuetify(opts),
    router: Routes,
    render: h => h(App)
});

export default app;
