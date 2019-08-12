<template>

    <div class="container">
        <form @submit.prevent="getLinks">
            <div class="form-group">
                <label for="longUrlInput">Search By Long Url</label>
                <input type="text" name="long_url" class="form-control" id="longUrlInput" v-model="fields.long_url" placeholder="Enter URl">
                <div v-if="errors && errors.long_url" class="text-danger">{{ errors.long_url[0] }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    <div class="table">
    <table>
        <thead>
        <tr>
        <th>ID</th>
        <th>Long Url</th>
        <th>Short Url</th>
        <th>Created At</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="links" v-for="link in links"></tr>
        </tbody>
    </table>
    </div>
    </div>
</template>
<script>
    import router from "../routes";

    export default {
        data(){
            return {
                fields:{},
                links:[],
                errors:{},
            }
        },
        mounted() {
            this.getLinks();
            // console.log(this.apiUrl);
        },
        methods:{
            submit(){

            },
            getLinks(){
                this.erros = {};
                let request_url = 'http://url-shortner.local.com/api/v1/links';
                if(this.fields.long_url)
                {
                    request_url+='?long_url='+this.fields.long_url;
                }
                axios.get(request_url).then(response => {
                    console.log(response);
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>