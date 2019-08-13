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
        <v-data-table
                :headers="headers"
                :items="links"
                :options.sync="options"
                :server-items-length="totalItems"
                :loading="loading"
                :items-per-page="10"
                class="elevation-1"
        ></v-data-table>
    </div>
</template>
<script>
    import router from "../routes";

    export default {
        data(){
            return {
                fields:{},
                links:[],
                totalItems: 0,
                loading: true,
                errors:{},
                options:{},
                headers:[
                    {text:'Long Url',value:'long_url'},
                    {text:'Short Url',value:'short_url'},
                    {text:'Clicks',value:'clicks'},
                    {text:'Created At',value:'created_at'}
                ]
            }
        },
        watch: {
            options: {
                handler () {
                    this.getDataFromApi()
                        .then(data => {
                            this.links = data.links
                            this.totalItems = data.meta.total
                        })
                },
                deep: true,
            },
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
                    this.links = response.data.data;
                    this.totalItems = response.data.meta.total;
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