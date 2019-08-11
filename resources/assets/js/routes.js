import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/Dashboard';
import Home from './components/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path:'/',
            name:'home',
            component: Home
        },
        {
            path:'/dashboard',
            name:'dashboard',
            component: Dashboard
        }
    ]
});

export default router;