<template>
    <section>
        <HeaderEmployer :uData="userData"></HeaderEmployer>
        <div v-if="valid" class="container py-5">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card sm-3">
                        <div class="card-body text-center">
                            <div class="profile-container">
                                <img 
                                        :src="image" 
                                        alt="avatar" class="rounded-circle profImg img-fluid" style="width: 150px;height: 150px;"/>
                                    <label for="file-image" class="update-profile"><i class=" fa fa-camera" for="file-image"></i></label>
                                    <input type="file" name="file" id="file-image" @change="onChange" />
                            </div>
                            <p v-if="triggerUpload">
                                <a  href="javascript:void(0)" @click="submitUpload" class="btn btn-theme">save</a>
                                <a  href="javascript:void(0)" @click="cancelUpload" class="btn btn-danger">cancel</a>
                            </p>
                            <p class="text-muted mt-3 mb-1">{{companyData.company_display}}</p>
                            <small>{{userData.firstname}} {{userData.lastname}} </small>
                        </div>
                    </div>

                    <div class="card  mt-2 toggle ">
                        <div class="card-body" id="social-toggle">
                            <p><h5 class="text-center"><b>Company Info</b></h5></p> 
                    
                            <div class="row">
                               <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item  justify-content-between align-items-center "> <i class="fa-solid fa-building"></i> {{companyData.company_name}}</li>
                                    <li class="list-group-item  justify-content-between align-items-center "> <i class="fa-solid fa-clipboard"></i> {{companyData.company_display}}</li>
                                    <li class="list-group-item  justify-content-between align-items-center "> <i class="fa-solid fa-mobile"></i> {{companyData.company_phone}}</li>
                                    <li class="list-group-item  justify-content-between align-items-center "> <i class="fa-solid fa-home"></i> {{companyData.company_address}}</li>
                                    <li class="list-group-item  justify-content-between align-items-center  p_textarea">
                                        <p class="text-center"><strong>Company Overview</strong></p>
                                        {{companyData.company_description}}</li>
                                    <li class="list-group-item  justify-content-between align-items-center "  data-bs-toggle="modal" data-bs-target="#company_modal" ><p class="mb-0 editcompany"><i class="fa-solid fa-pencil" title="edit social media"></i> Edit Company</p></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class=" navigation-top sm-9">
                        <ul class="navs nav-tabs"  role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active"  data-bs-toggle="tab" href="#job-lists" @click="getActiveJobs" role="tab" aria-controls="job-lists" aria-selected="true">Job Ads</a>
                            </li>
                 
                            <!-- <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#archive" role="tab" @click="getArchiveData" aria-controls="#archive" aria-selected="false">Archived Job Ads</a>
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#currenct_subscription" role="tab" aria-controls="#currenct_subscription" aria-selected="false">Subscription History</a>
                            </li>
                        </ul>
                   </div>
                   <div class="container mt-2">
                        <div class="tab-content" >
                            <JobAds  :jobs="getActiveJobsStatus"></JobAds>
                            <Archive :archive="getArchive"></Archive>
                        </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" >Update Company Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <Form @submit="updateCompany" :validation-schema="schemaCompany" ref="form"  v-slot="{ isSubmitting }">
                   <div class="modal-body">
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Employer First Name</label>
                                <Field name="firstname"  v-model="userData.firstname" type="text" class="flat-input form-control" placeholder="Employer First Name" />
                                <ErrorMessage class="text-danger errormessage " name="firstname" />
                            </div>
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Employer Last Name</label>
                                <Field name="lastname"  v-model="userData.lastname" type="text" class="flat-input form-control" placeholder="Employer Last Name" />
                                <ErrorMessage class="text-danger errormessage " name="lastname" />
                            </div>
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Company Name</label>
                                <Field name="company_name" placeholder="Company Name" class="flat-input" v-model="companyData.company_name"></Field>
                                <ErrorMessage class="text-danger errormessage " name="company_name" />
                            </div>
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Company Display Name</label>
                                <Field name="company_display" placeholder="Company Name" class="flat-input" v-model="companyData.company_display"></Field>
                                <ErrorMessage class="text-danger errormessage " name="company_display" />
                            </div>
                            <div class="mb-5 col-md-12">
                                <label class="form-label form-theme-label ">Country</label>
                                <Field name="country" v-model="userData.country_code">
                                    <country-select name="country"  class="flat-input  form-control" v-model="userData.country_code" :country="userData.country_code" v-bind:value="userData.country_code"  />
                                <ErrorMessage class="text-danger errormessage " name="country" />
                                </Field>  
                            </div>
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Company Address</label>
                                <Field class="flat-input" type="text" placeholder="Company Address " v-model="companyData.company_address" name="company_address"></Field>
                                <ErrorMessage class="text-danger errormessage " name="company_address" />
                            </div>
                            <div class="mb-5 col-md-6">
                                <label  class="form-label form-theme-label">Company Mobile Number</label>
                                <Field class="flat-input" type="text" placeholder="Company Mobile Number " v-model="companyData.company_phone" name="company_phone"></Field>
                                <ErrorMessage class="text-danger errormessage " name="company_phone" />
                            </div>
                            <div class="mb-5 col-md-12">
                                <label  class="form-label form-theme-label">Company Description</label>
                                <Field class="flat-input" placeholder="Company Description " rows="5" cols="20" v-model="companyData.company_description" name="company_description" as="textarea"></Field>
                                <ErrorMessage class="text-danger errormessage " name="company_description" />
                                <Field name="next" type="text" id="loginfield_" />
                            </div>
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
    import JobAds from './frontend/JobAds'
    import Archive from './frontend/Archive'
    import HeaderEmployer from './../../HeaderEmployer';
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    export default {
        components: {
            Form,
            Field,
            ErrorMessage,
            HeaderEmployer,
            JobAds,
            Archive
            
        },
        data() {

            const schemaCompany = yup.object({
                company_name: yup.string().required("Required Field").min(4 , "Minimum of 4 characters").max(50 , "Maximum of 50 characters only"),
                company_display: yup.string().required("Required Field").min(4 , "Minimum of 4 characters").max(50 , "Maximum of 50 characters only"),  
                company_description: yup.string().required("Required Field").min(4 , "Minimum of 4 characters").max(250 , "Maximum of 250 characters only"), 
                firstname: yup.string().required(),
                lastname: yup.string().required(),
              
                //region: yup.string().required().typeError("please select your region/state"),
                country: yup.string().required(),  
                company_phone : yup.string().required("Please Provide a Valid Mobile Number").max(255 , "Too long for mobile number").nullable(),       
                company_address : yup.string().required("Please Provide Company Address").min(5 ,"too short for complete address").max(255 , "Too long for mobile number").nullable(), 
            });
            return {
                valid : false , 
                userData : [] ,
                companyData : [],
                schemaCompany,
                getArchive : false ,
                getActiveJobsStatus : false,
                imgHolder : [],
                image: '',
                triggerUpload : false
            }
        },
        methods : {
            logout () {
                axios.post('api/logout').then(response => {
                    localStorage.clear();
                    location.href = '/employer';
                }).catch((error) => {

                });
            } ,
            updateCompany (values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

              
                axios.post('api/updateCompany',values).then(response => {

                }).catch((error) => {

                });
            },
            changeRegion (event) {
                this.userData.region = event.target.value
            },

            getArchiveData () {
                this.getArchive = true;
                this.getActiveJobsStatus = false;
            },
            getActiveJobs (){   
                this.getArchive = false;
                this.getActiveJobsStatus = true;
            },
            onChange(e) {
                var files = e.target.files;
                this.imgHolder = files;
                this.createFile(files[0]);

                this.triggerUpload = true
            },
            createFile(file) {
                if (!file.type.match('image.*')) {
                    alert('Select an image');
                return;
                }

                var img = new Image();
                var reader = new FileReader();
                var vm = this;
                
                reader.onload = function(e) {
                vm.image = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            cancelUpload () {
                this.image = this.userData.profile_image
                this.triggerUpload = false;
            } ,
            submitUpload (){
                let data = new FormData();
                data.append('image', this.imgHolder[0]);
                data.append('is_profile', 'Y')
            
                axios.post('/api/imageUpload',data).then(function (response) {
                    window.location.reload()
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
                            this.image = response.data.u.profile_image;
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
