<template>
    <section>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <router-link :to="'/'" ><img :src="'/image/logo.png'" height="150" style="margin-bottom:-80px;"  /></router-link>
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
        <div class="container p-y">
            <div class="row mt-2">
                <div class="col-12">
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
                                <div class="col text-center mb-2 mb-1">
                                    <button @click="apply" class="btn btn-theme apply_btn">Apply</button>
                                </div>
                            </div>
                           
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                activeJob : [] ,
                job_id  :''
            }
        },
        methods : {
            apply() {
                var me  = this.$swal;
                let id = this.$route.params.id;
                this.$swal({
                    title: "Are you sure you want to apply for this job ad ?",
                    text: "The employer can see your images and contact info if you accept it , this will serve as your resume to this site!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonColor: 'grey',
                    confirmButtonColor: "green",
                    confirmButtonText: "Continue to Apply"
                }).then(function(result){
                   if(result.isConfirmed){      

                    var array =  {
                        job_id : id
                    }
                    
                    axios.post('api/apply', array).then(response => {
                        console.log(response.data.status)
                       if(response.data.status == true){
                            me("Goodluck on your application!");
                       } else{
                            me({
                                title: "!",
                                text: "Something went wrong",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 1000
                            });
                       }
                    }).catch((error) => {

                    });
                     
                   }
                }, function(result) {
                   
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (result.dismiss === 'cancel') { 
                       
                    } else {
                    throw dismiss;
                    }
                })
            }
        } ,
        mounted () {
            axios.get('api/job/'+this.$route.params.id).then(response => {
               this.activeJob  = response.data;
            }).catch((error) => {

            });

            
        }
    }
</script>

<style>
    .p_textarea {
        white-space:pre-line;
    }

    .swal2-title{
        color:black;
        font-family: inherit;
    }
</style>