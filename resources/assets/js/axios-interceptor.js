import  axios from 'axios';
import  Vue from 'vue';

axios.interceptors.response.use((response) => { // intercept the global error
    console.log('here now');
    return response
}, function (error) {
    let originalRequest = error.config;
    if (error.response.status === 401 ) { // if the error is 401 and hasent already been retried
        localStorage.removeItem('token');
        //logout();
        this.$router.push('/login');
    }
    return Promise.reject(error)
});

axios.interceptors.request.use(config=>{
    const token = localStorage.getItem('token');
    if(token){
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});