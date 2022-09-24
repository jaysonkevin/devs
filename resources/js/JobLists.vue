<template>
    <section>
         <!-- Navigation -->
         <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#model-header-nav" aria-controls="model-header-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="model-header-nav">                    
                    <ul class="navbar-nav ms-auto">
                        <a href="javascript:void(0)" @click="logout" class="">Logout</a>
                    </ul>
                </div>
               
            </div>
        </nav>

        <div class="container py-5">
            <div class="row">
                <div class="col-sm-2 border-right">
                    <form>
                        <div class="d-grid gap-2">
                            <p><h5>Job Search</h5></p>
                            <div class="container mb-3 mt-2" style="display:flex">
                                <input type="search" v-model="searchInput" placeholder="Search Job" aria-describedby="button-addon2" class="flat-input">
                            </div>
                        </div>
                        <hr class="hrdivider"/>
                        <div class="d-grid gap-2">
                            <p><h5>Job Type</h5></p>
                            <span class="job_type"  v-for="(item,index) in jobType" :key="item">
                                <input type="checkbox"  class="custom-control-input" :id="index" :value="item.id" :true-value="1"  :check="true" name="job_type" v-model="checkedLists">
                                <label class="" :for="index">{{item.job_type}}</label>
                            </span>
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <button  @click="searchJob" type="button" class="mt-2 btn btn-sm btn-theme">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-10">
                   <div class="job-div">
                       <div class="card card-job" v-for="(item , index) in jobLists.data" :key="item" :value="item.id" >
                            <div class="card-body list-job ">
                                <router-link  class="a_desc" :to="{ path: '/job/'+item.id}">
                                    <dt class="mb-3">
                                        <h4 class="jobtitle-heading">{{item.job_title}} 
                                            <span :class="'badge jt-' + item.job_type_id">{{item.job_type}}</span> 
                                        </h4>
                                        <small class="jobtitle-heading-small"> 
                                            <p>{{item.firstname}} {{item.lastname}}, Posted on: {{item.accepted_date}} <b class="country">{{item.country.country_name}}</b></p> 
                                            
                                        </small>
                                    </dt>
                                    <p class="job_description" >
                                    {{item.job_description}}
                                    </p>
                                </router-link>
                                <router-view/>
                            </div>
                       </div>
                       <div class="card-footer">
                            <Pagination class="pull-right" :data="jobLists" @pagination-change-page="getResults">
                              
                            </Pagination>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import LaravelVuePagination from '../../node_modules/laravel-vue-pagination';
    import {ref} from 'vue'
    export default {
        components: {
            'Pagination': LaravelVuePagination
        },
        props : ["id"],
 
        data() {
            return {
                modelLogged : false ,
                searchInput : '',
                jobType : [],
                jobLists : [],
                searchArray  : {
                    job_title  :'' ,
                    status : 'A',
                    country_code :  '',
                    jobType : '',
                    id : '',
                    testing : ''
                   
                },
                checkedLists :[
                ],
                checkall : true ,
 
               
               
            }
        },
        methods : {
            searchJob(e) {
                e.preventDefault();
                localStorage.removeItem("_search_");
                this.searchArray.job_title = this.searchInput;
                this.searchArray.jobType = this.checkedLists;
                this.getResults();
            },

            async getResults(page = 1) {
              
                await axios.post('api/activejobs?page='+page, this.searchArray ).then(response => {
                    this.jobLists = response.data;
                }).catch((error) => { });
            } ,
        },
        logout () {
            axios.post('api/logout').then(response => {
                localStorage.clear();
                location.href = '/';
            }).catch((error) => {});
        } ,

        mounted () {    
           
            axios.get('api/jobType?s=true').then(response => {
                this.jobType = response.data;
             }).catch((error) => { });       
        },
        async beforeCreate (){
            await axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){ axios.get('api/cUL').then(response => { 

                    localStorage.removeItem("_agent");
                    localStorage.setItem('_agent',response.data.u.id); 
                 
                    this.searchArray.id = response.data.u.id
                    this.searchArray.testing = response.data.u.id
                });
                }
            }).catch((error) => { });
            await  axios.get('api/location').then(response => {
                localStorage.removeItem("_country");
                localStorage.setItem('_country',response.data.country_code); 
                this.searchArray.country_code = response.data.country_code
            }).catch((error) => {});  

            this.getResults();
           
        } ,

        async created(){
           
           
        } ,

    

    }
</script>


<style scoped>
    @import '../sass/joblists.scss';
</style>