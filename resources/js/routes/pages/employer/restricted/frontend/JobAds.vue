<template>

<div id="job-lists" class="tab-pane fade in active show">
    <i class="fas fa-plus add-job-btn  mt-2" data-bs-toggle="modal" data-bs-target="#add_job_modal">add job</i>
    <section class="mt-3">
        <div class="panel">
            <div class="row mt-2 mb-2">
               <form @submit="searchJobActive">
                    <div class="col-sm-3 col-xs-6">
                        <input type="text" class="flat-input" v-model="searchArray.job_title"  name="job_title" placeholder="Search Job" >
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
               </form>
            </div>
        </div>

        <!-- <div class="input-group mb-3 search-input-group">
            <input type="text" class="form-control " placeholder="Search" >
            <span class="input-group-text" > Search job</span>
        </div> -->
        <table class="table">
            <thead>
                <tr class="thead">
                    <th class="col-header" scope="col ">Job Name </th>
                    <th class="col-header" scope="col">Salary</th>
                    <th class="col-header" scope="col">Applicants</th>
                    <th class="col-header" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="jobLists.length > 0" v-for="(item , index) in jobLists" :key="item" :value="item.id"  scope="row">
                    <td>
                       <div>
                            <small :class="'badge jt-' + item.job_type_id">{{item.job_type}}</small> 
                            <p >{{item.job_title}}</p>
                       </div>
                    </td>
                    <td>${{item.salary}}</td>
                    <td><span class="badge rounded-pill bg-info ">{{item.applicants}}</span> </td>
                    <td>
                        <div class="btn-group">
                        <button class="btn btn-theme actionbtn btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_job_modal" @click="viewJobData(item)">View </a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#update_job_modal" @click="showDataJob(item)"  href="javascript:void(0);">Edit </a></li>
                            <li>
                                <router-link class="dropdown-item" :to="'/employer/home/applicants?job=' + item.id"  >
                                    Applicants
                                </router-link>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" @click="removeJob(item.id , index)">Remove Job </a></li>
                        </ul>
                        </div>
                    </td>
                </tr>
                <tr v-else class="text-center">
                    <td colspan="4">
                        <button class="btn btn-theme text-center mt-2" data-bs-toggle="modal" data-bs-target="#add_job_modal">
                            Post Your First Ad Job 
                        </button>
                       
                    </td>
                </tr>
                <router-view/>
            </tbody>
        </table>
    </section>
</div>

     <!-- MODALS -->
    <div class="modal fade" id="add_job_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" >Add New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form @submit="addJob" :validation-schema="schemaAddJob" ref="form"  v-slot="{ isSubmitting }">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Job Title<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" type="text" placeholder="What type of model you need? " name="job_title"></Field>
                            <ErrorMessage class="text-danger errormessage " name="job_title" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job Description<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" placeholder="Company Description " rows="5" cols="20" name="job_description" as="textarea"></Field>
                                <ErrorMessage class="text-danger errormessage " name="job_description" />
                            <Field name="next" type="text" id="loginfield_" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job Type<i class='fa-solid fa-asterisk'></i> </label>
                            <Field name="job_type" class="flat-input" as="select">
                                <option value="" selected>Select Employment Type</option>
                                <option v-for="item in jobType" :key="item" :value="item.id"  >{{ item.job_type }}</option>
                            </Field>
                            <ErrorMessage class="text-danger errormessage " name="job_type" />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Salary in USD<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" type="number" placeholder="eg. 400"  name="salary"></Field>
                            <ErrorMessage class="text-danger errormessage " name="salary" />
                        </div>
                        <div class="text-center">
                            <span v-if="limitErrorMessage" class="badge bg-danger">Free Daily Limit Post Exceed</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-theme">Add Job</button>
                    </div>             
                </Form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_job_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" >Update Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form @submit="editjob" :validation-schema="schemaEditJob" ref="form"  v-slot="{ isSubmitting }">
                    <Field class="hide" v-model="activeJob.id" name="_id_"></Field>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Job Title<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" type="text" placeholder="What type of model you need? "  v-model="activeJob.job_title" name="job_title"></Field>
                            <ErrorMessage class="text-danger errormessage " name="job_title" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job Description<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" placeholder="Company Description " rows="5" cols="20"  v-model="activeJob.job_description" name="job_description" as="textarea"></Field>
                                <ErrorMessage class="text-danger errormessage " name="job_description" />
                            <Field name="next" type="text" id="loginfield_" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job Type<i class='fa-solid fa-asterisk'></i> </label>
                            <Field name="job_type" class="flat-input" as="select"  v-model="activeJob.job_type_id">
                                <option  v-for="item in jobType" :key="item" :value="item.id"  >{{ item.job_type }} </option>
                            </Field>
                            <ErrorMessage class="text-danger errormessage " name="job_type" />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Salary in USD<i class='fa-solid fa-asterisk'></i> </label>
                            <Field class="flat-input" type="number" placeholder="eg. 400" v-model="activeJob.salary" name="salary"></Field>
                            <ErrorMessage class="text-danger errormessage " name="salary" />
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-theme">Update Job</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_job_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    export default {
        props: ['jobs'],
        components: {
            Form,
            Field,
            ErrorMessage
        },
        data () {
             
            const schemaAddJob = yup.object({
                salary: yup.number().required("Please indicate salary").typeError("Salary must be a number"),
                job_type: yup.string().required("Job Type is Required"),
                job_description: yup.string().required("Job Description is Required").max(1500 , "Maximum of 1500 characters only"),
                job_title: yup.string().required("Job Title is Required").max(50 , "Maximum of 50 characters only")
            });

               
            const schemaEditJob = yup.object({
                salary: yup.number().required("Please indicate salary").typeError("Salary must be a number"),
                job_type: yup.string().required("Job Type is Required"),
                job_description: yup.string().required("Job Description is Required").max(1500 , "Maximum of 1500 characters only"),
                job_title: yup.string().required("Job Title is Required").max(50 , "Maximum of 50 characters only")
            });

            
            return {
              jobType :[] ,
              schemaAddJob ,
              schemaEditJob,
              jobLists : [] ,
              activeJob : [] ,
              searchArray  : {
                job_title  :'' ,
                job_type : [] ,
                status : 'A'
              } ,
              limitErrorMessage : false
            }
        },

        methods : {
            addJob(values , actions){
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/addjob' , values).then(response => {
                    console.log(response.data.status)
                    if(response.data.status == false){
                        this.limitErrorMessage = true
                        return false;
                    } else{
                        window.location.reload() 
                    }
                }).catch((error) => {
                    
                });
            },
            showDataJob (data) {
                this.activeJob = data;
            } ,
            viewJobData (data){
                this.activeJob = data;
            },
            editjob (values , actions){
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/editjob' , values).then(response => {
                    
                }).catch((error) => {
                    
                });

            },
            removeJob (id , index) {
                let jL  = this.jobLists
                var me = this;
                this.$swal({
                    title: "Are you sure you want to remove this job?",
                    text: "You can still view it on the archive tab",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonColor: 'grey',
                    confirmButtonColor: "red",
                    confirmButtonText: "Remove Job"
                }).then(function(result){
                   if(result.isConfirmed){      
                        axios.post('api/removejob' , {id : id}).then(response => {
                            if(response.data.status == true){
                                me.$swal({
                                    title: "",
                                    text: "Success!",
                                    iconHtml: '<i class="fa-solid fa-check" style="color:green"></i>',
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : false,
                                    timer: 1500
                                });
                                jL.splice(index, 1)
                            } else{
                                me.$swal({
                                    title: "",
                                    text: "Something went wrong!",
                                    iconHtml: '<i style="color:red" class="fa">&#xf12a;</i>',
                                    type: "error",
                                    showCancelButton: false,
                                    showConfirmButton : false,
                                    timer: 1500
                                });
                            }
                        }).catch((error) => {
                            
                        });
                   }
                }, function(result) {
                   
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (result.dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those
                       
                    } else {
                    throw dismiss;
                    }
                })
            } ,

            async getActiveJobs (){
                if(this.jobs){
                    axios.get('api/jobType').then(response => {
                        this.jobType = response.data;
                    }).catch((error) => {
                        
                    });

                    var array = {
                        status : 'A'
                    };
                    axios.post('api/jobs' , array).then(response => {
                        this.jobListsArchive = response.data;
                    }).catch((error) => {
                        
                    });
                }
            } ,
            searchJobActive (e) {
                e.preventDefault();
                axios.post('api/jobs' , this.searchArray).then(response => {
                    this.jobLists = response.data;
                }).catch((error) => {
                    
                });
               
            }
    
        },
        watch: {
            jobs() {
                this.getActiveJobs()
            }
        },
        mounted(){
         
            axios.get('api/jobType').then(response => {
                this.jobType = response.data;
            }).catch((error) => {
                
            });
            var array = {
                status : 'A'
            };
            axios.post('api/jobs' , array).then(response => {
               this.jobLists = response.data;
            }).catch((error) => {
                
            });
        }
    }
</script>