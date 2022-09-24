<template>
<div id="archive" class="tab-pane fade in ">
    <section class="mt-3">
        <div class="panel">
            <div class="row mt-2 mb-2">
               <!-- <form @submit="searchJobActive">
                    <div class="col-sm-3 col-xs-6">
                        <input type="text" class="flat-input"  v-model="searchArray.job_title"  name="job_title" placeholder="Search Job" >
                    </div>
                    <div class="col-sm-6 col-xs-6 ">
                        <div class="form-check form-check-inline"   v-for="(item,index) in jobType" :key="item" >
                            <input class="form-check-input"  type="checkbox" :id="index" name="job_type" :value="item" v-model="searchArray.job_type"  />
                            <label class="form-check-label" :for="index">{{item.job_type}}</label>
                        </div>
                    </div>
                    <div class="pull-left mt-2">
                        <button type="submit"  class="btn btn-xs btn-theme"><i class="fa fa-search"></i> Search</button>
                    </div>
               </form> -->
            </div>
        </div>

        <table class="table">
            <thead>
                <tr class="thead">
                    <th scope="col">Job Type</th>
                    <th scope="col">Job Name</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item , index) in jobListsArchive" :key="item" :value="item.id"  scope="row">
                    <td>{{item.job_type}}</td>
                    <td>{{item.job_title}}</td>
                    <td>$ {{item.salary}}</td>
                    <td>
                        <div class="btn-group">
                        <button class="btn btn-theme btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_job_modalArchive" @click="viewJobData(item)">View </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Applicants</a></li>
                        </ul>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </section>
</div>
<!-- MODAL -->
<div class="modal fade" id="view_job_modalArchive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                                        <p><i class="fa-solid fa-briefcase"></i> Job Type <b>{{activeJobArchive.job_type}}</b> </p>
                                        
                                    </div>
                                    <div class="col col-md-4">
                                        <p><i class="fa-solid fa-sack-dollar"></i> Salary <b> ${{activeJobArchive.salary}}</b>
                                        </p>
                                        
                                    </div>
                                    <div class="col col-md-4">
                                        <p><i class="fa-solid fa-calendar"></i> Date Posted <b>{{activeJobArchive.created_at}}</b> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-newspaper"></i> Job Overview</h3>
                            </div>
                            <div class="card-body">
                                <p class="p_textarea">{{activeJobArchive.job_description}}</p>
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

    export default {
        props: ['archive'],
        data () {
            return {
              jobType :[] ,
              jobListsArchive : [] ,
              activeJobArchive : [
              
              ] 
            
            }
        },

        methods : {
            showDataJob (data) {
                this.activeJobArchive = data;
            } ,
            viewJobData (data){
                this.activeJobArchive = data;
            },    
            async getArchiveStatus (){
                if(this.archive){
                    axios.get('api/jobType').then(response => {
                        this.jobType = response.data;
                    }).catch((error) => {
                        
                    });

                    var array = {
                        status : 'H'
                    };
                    axios.post('api/jobs' , array).then(response => {
                       
                        this.jobListsArchive = response.data;
                    }).catch((error) => {
                        
                    });
                }
            }
           
        },
        
        watch: {
            archive() {
                this.getArchiveStatus()
            }
        },
        mounted(){
    
        }
    }
</script>