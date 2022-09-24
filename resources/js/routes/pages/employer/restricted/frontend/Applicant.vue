<template>
    <section>
        <HeaderEmployer :uData="userData"></HeaderEmployer>
        <div class="container">
            <div class="text-center mt-2" v-if="job_details.is_purchased == 'N'">
                <button class="btn btn-md btn-theme"><i class="fa fa-cart-shopping"></i> Upgrade this job ad to see full info of applicants</button>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-briefcase"></i> Job Type <b>{{job_details.job_type}}</b> </p>
                            
                        </div>
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-sack-dollar"></i> Salary <b> ${{job_details.salary}}</b>
                            </p>
                            
                        </div>
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-calendar"></i> Date Posted <b>{{job_details.accepted_date}}</b> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mt-2"  v-for="(item , index) in applicant_lists" :key="item">
                    <div class="card" >
                        <div class="card-header">
                            <h4>Applicant</h4>
                        </div>
                        <div class="card-body text-center"  >
                            <img 
                                :src="item.profile_image"
                                alt="avatar" 
                                class="rounded-circle img-fluid"
                                style="width: 200px;"/>

                            <p class="mt-3 mb-1"> {{item.firstname}}  {{item.lastname}}</p>
                            <small></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>
<script>
    import HeaderEmployer from './../../../HeaderEmployer';
    export default {
        components : {
            HeaderEmployer
        },
        data() {
            return {
                userData : [] ,
                applicant_lists : [] ,
                job_details : []
            }
        },
        beforeMount (){ 
            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                        this.userData = response.data.u
                    });
                } 
            }).catch((error) => {
                location.href = '/';
            });

            
            axios.post('api/applicants' , this.$route.query).then(response => {
               this.job_details = response.data.job_details
               this.applicant_lists = response.data.applicant_lists
            }).catch((error) => {
                location.href = '/';
            });
        },
       
    }
</script>