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
            component: Login,
            meta:{
                guest : true
            }
        },
        {
            path:'/dashboard',
            name:'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth : true
            }
        }
    ]
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('token') == null) {
            next({
                path: '/login',
            })
        } else {
            next();
        }
    }else if(to.matched.some(record => record.meta.guest)){
        if (localStorage.getItem('token') == null) {
            next()
        }else{
            next({
                path: '/dashboard',
            })
        }
    }else{
        next();
    }

});

export default router;