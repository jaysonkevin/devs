<template>
    <section>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <a href="javascript:void(0)" @click="logout" class="btn btn-primary">Logout</a>
                    </ul>
                </div>
            </div>
        </nav>

        <div v-if="valid" class="container py-5">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card sm-3">
                        <div class="card-body text-center">
                            <img src="https://media-exp1.licdn.com/dms/image/C4D03AQEaMaCGTtr-ew/profile-displayphoto-shrink_800_800/0/1654842580507?e=1667433600&v=beta&t=n276FpMWAHDk4B-_2E0yW91xCAC4W9T08BkUB-msGs8" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"/>
                            <p class="text-muted mt-3 mb-1">{{companyData.company_display}}</p>
                        </div>
                    </div>

                    <div class="card  mt-2 toggle ">
                        <div class="card-body" id="social-toggle">
                            <h5 class="my-3">Company Info </h5>    
                            <div class="row">
                               <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">{{companyData.company_name}}</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">{{companyData.company_display}}</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3 p_textarea">{{companyData.company_description}}</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="" style="color: rgb(85, 172, 238);"></i> <p class="mb-0"><i data-bs-toggle="modal" data-bs-target="#company_modal" class="fa fa-pencil" title="edit social media"></i></p></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class=" navigation-top sm-9">
                        <ul class="navs nav-tabs"  role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active"  data-bs-toggle="tab" href="#job-lists" role="tab" aria-controls="job-lists" aria-selected="true">Job Ads</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#employer-profile-tab" role="tab" aria-controls="employer-profile-tab" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#archive" role="tab" aria-controls="#archive" aria-selected="false">Archived Job Ads</a>
                            </li>
                            
                        </ul>
                   </div>
                </div>
            </div>
        </div>
        <div v-else class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-spinner invalid fa-spin"></i>
                </div>
            </div>
        </div>
    </section>


      <!-- MODALS -->
      <div class="modal fade" id="company_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" >Update Company Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form @submit="updateCompany" :validation-schema="schemaCompany" ref="form"  v-slot="{ isSubmitting }">
                    <div class="modal-body">
                        <div class="mb-5">
                            <label  class="form-label"><strong>Company Name</strong></label>
                            <Field name="company_name" placeholder="Company Name" class="flat-input" v-model="companyData.company_name"></Field>
                            <ErrorMessage class="text-danger errormessage " name="company_name" />
                        </div>

                        <div class="mb-5">
                            <label  class="form-label"><strong>Company Display Name</strong></label>
                            <Field name="company_display" placeholder="Company Name" class="flat-input" v-model="companyData.company_display"></Field>
                            <ErrorMessage class="text-danger errormessage " name="company_display" />
                        </div>

                        <div class="mb-5">
                            <label  class="form-label"><strong>Company Description</strong></label>
                            <Field class="form-control" placeholder="Company Description " rows="10" cols="40" v-model="companyData.company_description" name="company_description" as="textarea"></Field>
                            <ErrorMessage class="text-danger errormessage " name="company_description" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-theme">Save changes</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    export default {
        components: {
            Form,
            Field,
            ErrorMessage,
            
        },
        data() {

            const schema = yup.object({
                company_name: yup.string().required("Required Field"),
                company_display: yup.string().required("Required Field"),          
            });
            return {
                valid : false , 
                userData : [] ,
                companyData : []
            }
        },
        methods : {
            logout () {
                axios.post('api/logout').then(response => {
                    localStorage.clear();
                    location.href = '/employer';
                }).catch((error) => {

                });
            } 
        } ,
        mounted () {

            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                       if(response.data.u.type == 'E'){
                            this.valid = true;

                            this.userData = response.data.u;
                            this.companyData = response.data.c;

                            console.log(this.companyData)
                       } else {
                            location.href = '/model';
                       }
                    });
                }
            }).catch((error) => {
            
            });
        }
    }

</script>
<style scoped>
@import '../../../../../sass/employer.scss'; 
</style>
