import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/Dashboard';
import Home from './components/Home';
import Login from './components/Login';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path:'/',
            name:'home',
            component: Home
        },
        {
            path:'/login',
            name:'login',
            component: Login
        },
        {
            path:'/dashboard',
            name:'dashboard',
            component: Dashboard
        }
    ]
});

export default router;