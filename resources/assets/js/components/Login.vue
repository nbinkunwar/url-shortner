<template>
    <div class="container">
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" class="form-control" v-model="fields.email" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" v-model="fields.password" id="inputPassword" placeholder="Password">
                <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
            </div>
<!--            <div class="form-check">-->
<!--                <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--                -->
<!--            </div>-->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script>
    import router from "../routes";

    export default {
        data(){
            return {
                fields:{},
                errors:{},
            }
        },
        mounted() {
            // console.log(this.apiUrl);
        },
        methods:{
            submit(){
                this.erros = {};
                axios.post('http://url-shortner.local.com/api/v1/login',this.fields).then(response => {
                    console.log(response);
                    localStorage.setItem('token',response.data.token);
                    this.$router.push('dashboard');
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>