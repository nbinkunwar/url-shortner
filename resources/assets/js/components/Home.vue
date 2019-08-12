<template>
    <div class="container">
<form @submit.prevent="submit">
    <div class="form-group">
        <label for="longUrlInput">Url</label>
        <input type="text" name="long_url" class="form-control" id="longUrlInput" v-model="fields.long_url" placeholder="Enter URl">
        <div v-if="errors && errors.long_url" class="text-danger">{{ errors.long_url[0] }}</div>
        <div v-if="shortUrl" class="">{{ shortUrl }}</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>
</template>
<script>
    export default {
        data(){
          return {
              fields:{},
              errors:{},
              shortUrl:''
          }
        },
        mounted() {
            // console.log(this.apiUrl);
        },
        methods:{
            submit(){
                this.erros = {};
                axios.post('http://url-shortner.local.com/api/v1/shorten',this.fields).then(response => {
                    console.log(response);
                    this.shortUrl = response.data.data.modified_url;
                    console.log(this.shortUrl);
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>