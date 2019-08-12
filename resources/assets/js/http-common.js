import axios from 'axios'

export const http = axios.create({
    baseURL: 'https://maddox.auth.eu-west-1.amazoncognito.com/oauth2/',
    headers: {
        'Content-Type': 'application/json'
    }
});