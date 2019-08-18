import  axios from 'axios';
import  Vue from 'vue';
import VueProgressBar from 'vue-progressbar';
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
};

Vue.use(VueProgressBar, {});
let vm = new Vue({});

axios.defaults.baseURL = '/api/v1';

axios.interceptors.response.use((response) => { // intercept the global error
    vm.$Progress.finish();
    return response
}, function (error) {
    let originalRequest = error.config;
    console.log('here');
    if (error.response.status === 401 ) { // if the error is 401 and hasn't already been retried
        localStorage.removeItem('token');
        //logout();
        this.$router.push('/login');
    }
    return Promise.reject(error)
});

axios.interceptors.request.use(config=>{
    vm.$Progress.start();
    const token = localStorage.getItem('token');
    if(token){
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});
