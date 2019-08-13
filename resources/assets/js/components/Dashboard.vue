<template>

    <div class="container">
        <form @submit.prevent="getLinks">
            <div class="form-group">
                <label for="longUrlInput">Search By Long Url</label>
                <input type="text" name="long_url" class="form-control" id="longUrlInput" v-model="fields.long_url" placeholder="Enter URl">
                <div v-if="errors && errors.long_url" class="text-danger">{{ errors.long_url[0] }}</div>
            </div>
            <div class="form-group">
                <label for="shortUrlInput">Search By Short Url</label>
                <input type="text" name="short_url" class="form-control" id="shortUrlInput" v-model="fields.short_url" placeholder="Enter URl">
                <div v-if="errors && errors.short_url" class="text-danger">{{ errors.short_url[0] }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <v-data-table
                :headers="headers"
                :items="links"
                :options.sync="options"
                :server-items-length="totalItems"
                :loading="loading"
                :items-per-page="15"
                class="elevation-1"
        data-app> <template v-slot:item.is_deleted="{ item }">{{ item.is_deleted?'Yes':'No' }}
        </template>
            <template v-slot:item.is_expired="{ item }">{{ item.is_expired?'Yes':'No' }}
            </template>
            <template v-slot:item.action="{ item }">
            <v-icon
                    v-if="!item.is_deleted"
                small
                @click="deleteItem(item)"
        >delete</v-icon>
        </template>
        </v-data-table>
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
                base_url:'http://url-shortner.local.com/api/v1/',
                headers:[
                    {text:'Long Url',value:'long_url'},
                    {text:'Short Url',value:'short_url'},
                    {text:'Clicks',value:'clicks'},
                    {text:'Expire At',value:'expire_at'},
                    {text:'Expired?',value:'is_expired'},
                    {text:'Created At',value:'created_at'},
                    {text:'Deleted?',value:'is_deleted'},
                    { text: 'Actions', value: 'action', sortable: false },
                ]
            }
        },
        watch: {
            options: {
                handler () {
                    this.getLinks();
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
            deleteItem (item) {
                const index = this.links.indexOf(item);

                if(confirm('Are you sure you want to delete this item?'))
                {
                    axios.delete(this.base_url+'links/'+item.id).then(response => {
                        this.getLinks();
                    }).catch(error => {

                    })
                }
            },
            getLinks(){
                this.erros = {};
                let request_url = this.base_url+'links';

                if(this.fields.long_url || this.fields.short_url)
                {
                    request_url+='?';
                    if(this.fields.long_url)
                    {
                        request_url+='long_url='+this.fields.long_url;
                    }
                    if(this.fields.short_url)
                    {
                        request_url+='short_url='+this.fields.short_url;
                    }
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