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
                            <h5 class="my-3">{{userData.firstname}} <b>{{userData.lastname}}</b></h5>
                            <p class="text-muted mb-1">
                                <div class="star-rating">
                                    <span class="fa fa-star" data-rating="1"></span>
                                    <span class="fa fa-star" data-rating="2"></span>
                                    <span class="fa fa-star" data-rating="3"></span>
                                    <span class="fa fa-star" data-rating="4"></span>
                                    <span class="fa fa-star" data-rating="5"></span>
                                    <input type="hidden" name="rating_percentage" class="rating-value" value="2.56">
                                </div>

                            </p>
                           
                        </div>
                    </div>

                    <div class="card  mt-2 toggle ">
                        <div class="card-body" id="social-toggle">
                            <h5 class="my-3">Social Links</h5>
                        
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-twitter fa-lg" style="color: rgb(85, 172, 238);"></i><p class="mb-0"> {{userData.twitter}}</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-instagram fa-lg" style="color: rgb(172, 43, 172);"></i><p class="mb-0">{{userData.instagram}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-facebook-f fa-lg" style="color: rgb(59, 89, 152);"></i><p class="mb-0">{{userData.facebook}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-snapchat fa-lg" style="background-color:yellow"></i><p class="mb-0">{{userData.snapchat}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-tiktok fa-lg" style="background-color:yellow"></i><p class="mb-0">{{userData.tiktok}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="" style="color: rgb(85, 172, 238);"></i> <p class="mb-0"><i data-bs-toggle="modal" data-bs-target="#social_modal" class="fa fa-pencil" title="edit social media"></i></p></li>
                            </ul>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-9">
                   <div class=" navigation-top sm-9">
                        <ul class="navs nav-tabs"  role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active"  data-bs-toggle="tab" href="#img-tab" role="tab" aria-controls="img-tab" aria-selected="true">Images</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#profile-tab" role="tab" aria-controls="profile-tab" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#my-applications" role="tab" aria-controls="#my-applications" aria-selected="false">My Applications</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#saved-jobs" role="tab" aria-controls="saved-jobs" aria-selected="false">Saved Jobs</a>
                            </li>
                        </ul>
                   </div>
                   <div class="container mt-2">
                        <div class="tab-content" >
                            <!-- IMAGE -->
                            <ImageTab></ImageTab>
                            <!-- PROFILE -->
                            <ProfileTab @uData="getUserData"></ProfileTab>
                        </div>
                   </div>
                </div>
            </div>
        </div>
        <div v-else  class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-spinner invalid fa-spin"></i>
                </div>
            </div>
            <ProfileTab @uData="getUserData"></ProfileTab>
        </div>
    </section>

    <!-- MODALS -->
    <div class="modal fade" id="social_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Update Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form @submit="updatesocial" :validation-schema="schemaSocial" ref="form"  v-slot="{ isSubmitting }">
                    <div class="modal-body">
                        
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-twitter fa-lg" style="color: rgb(85, 172, 238);"></i><p class="mb-0">
                                    <Field name="twitter" placeholder="Twitter" class="flat-input" v-model="userData.twitter"></Field>
                                    <ErrorMessage class="text-danger errormessage " name="twitter" />
                                 </p>
                                    
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-instagram fa-lg" style="color: rgb(172, 43, 172);"></i><p class="mb-0">
                                    <Field name="instagram" class="flat-input" placeholder="Instagram " v-model="userData.instagram"></Field>
                                    <ErrorMessage class="text-danger errormessage " name="instagram" />  </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-facebook-f fa-lg" style="color: rgb(59, 89, 152);"></i><p class="mb-0">
                                    <Field name="facebook" class="flat-input" placeholder="Facebook" v-model="userData.facebook"></Field>
                                    <ErrorMessage class="text-danger errormessage " name="facebook" />  </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-snapchat fa-lg" style="background-color:yellow"></i><p class="mb-0">
                                    <Field name="snapchat" class="flat-input" placeholder="Snapchat" v-model="userData.snapchat"></Field>
                                    <ErrorMessage class="text-danger errormessage " name="snapchat" />  </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-tiktok fa-lg" style="background-color:yellow"></i><p class="mb-0">
                                    <Field name="tiktok" class="flat-input" v-model="userData.tiktok" placeholder="Tiktok"></Field>
                                    <ErrorMessage class="text-danger errormessage " name="tiktok" /> 
                                    <Field name="next" type="text" id="loginfield_" />
                                 </p>
                                </li>
                            </ul>
                
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
   
    import ImageTab from './frontend/ImageTab'
    import ProfileTab from './frontend/ProfileTab'
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    export default {
        components: {
            ImageTab,
            ProfileTab,
            Form,
            Field,
            ErrorMessage,
            
        },
        data () {
            return {
                userData : [] ,
                valid : false
            }
        },
        methods : {
            getUserData (data) {
                this.userData = data
                if(data.type == 'E'){
                    location.href = '/employer/home';
                } else{
                    this.valid = true;
                }
            },
            updatesocial (values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/updateinfosocial',values).then(response => {

                }).catch((error) => {

                });
            },
            logout () {
                axios.post('api/logout').then(response => {
                    localStorage.clear();
                    location.href = '/';
                }).catch((error) => {

                });
            } 
        } ,

        mounted () {
            //console.log(uData)
        }
    }

</script>

<style scoped>
 @import '../../../../../sass/model.scss'; 
</style>