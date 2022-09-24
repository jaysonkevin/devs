<template>
    <div id="my-applications" class="tab-pane fade">
        <section>
            <table class="table">
                <thead>
                    <tr class="thead">
                        <th scope="col">Job Type</th>
                        <th scope="col">Job Name</th>
                        <th scope="col">Date Applied</th>
                        <th scope="col">View Full Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item , index) in myApplicationData.data" :key="item" :value="item.id"  scope="row">
                        <td>{{item.job_type}}</td>
                        <td>{{item.job_title}}</td>
                        <td>{{item.date_applied}}</td>
                        <td>
                            <div class="d-grid gap-2">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view_job_modal_application" @click="viewJobData(item)" class="btn view btn-theme">View</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="card-footer">
                <Pagination class="pull-right" :data="myApplicationData" @pagination-change-page="getResults">
                    
                </Pagination>
            </div>
        </section>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="view_job_modal_application" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" >Job Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                   <div class="row">
                                        <div class="col col-md-4">
                                            <p><i class="fa-solid fa-briefcase"></i> Job Type <b>{{activeJob.job_type}}</b> </p>
                                            
                                        </div>
                                        <div class="col col-md-4">
                                            <p><i class="fa-solid fa-sack-dollar"></i> Salary <b> ${{activeJob.salary}}</b>
                                            </p>
                                            
                                        </div>
                                        <div class="col col-md-4">
                                           <p><i class="fa-solid fa-calendar"></i> Date Posted <b>{{activeJob.created_at}}</b> </p>
                                        </div>
                                   </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3><i class="fa-solid fa-newspaper"></i> Job Overview</h3>
                                </div>
                                <div class="card-body">
                                    <p class="p_textarea">{{activeJob.job_description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</template>


<script>
    import LaravelVuePagination from '../../../../../../../node_modules/laravel-vue-pagination';
    export default { 
        props: ['myApplication'],
        data(){
            return  {
                myApplicationData : [],
                activeJob : ''
            }
        },
        components: {
            'Pagination': LaravelVuePagination
        },
        methods :{
            
            getResults(page = 1) {
                axios.post('api/myapplication?page='+page).then(response => {
                    this.myApplicationData = response.data;
                }).catch((error) => { });
            } ,

            viewJobData (data) {
                this.activeJob = data;
            }
           
        },
        watch: {
            myApplication() {
                if(this.myApplication){
                    this.getResults()
                }
            }
        },
        mounted() {
            
        }
    }
</script>
<style>
    .view{
        font-size: 10px;
        width:150px;
    }
</style>