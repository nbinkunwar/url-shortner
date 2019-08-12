
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

import  axios from 'axios';
import Routes from './routes.js';

import App from './views/App';
// Vue.use(HTTP);

axios.create({
    baseURL: 'http://url-shortner.local.com/api/v1/',
    headers: {
        'Content-Type': 'application/json'
    }
});

const app = new Vue({
    el:'#app',
    router: Routes,
    render: h => h(App)
});

export default app;
