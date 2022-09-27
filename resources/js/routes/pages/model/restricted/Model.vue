<template>
   
    <section>
        <HeaderModel :uData="userData"></HeaderModel>
        <div v-if="valid" class="container py-5">
            <div class="container search-container mb-3 mt-2">
                <input type="search"  @keyup.enter="searchJob" v-model="searchInput" placeholder="Search Job e.g Tshirt Model" aria-describedby="button-addon2" class="flat-input">
            </div>
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
                                <li  class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="" style="color: rgb(85, 172, 238);"></i> <p class="mb-0 ispointer" data-bs-toggle="modal" data-bs-target="#social_modal">update <i  class="fa-solid  fa-pencil" title="update social media"></i> </p></li>
                            </ul>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-9">
                   <div class=" navigation-top sm-9">
                        <ul class="navs nav-tabs"  role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active"  data-bs-toggle="tab" href="#img-tab"  role="tab" aria-controls="img-tab" aria-selected="true">Images</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#profile-tab"  role="tab" aria-controls="profile-tab" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link"  data-bs-toggle="tab" href="#my-applications"  @click="getMyApplicationClick" role="tab" aria-controls="#my-applications" aria-selected="false">My Applications</a>
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
                            <!-- APPLICATION -->
                            <MyApplication :myApplication="getMyApplication" ></MyApplication>
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
    import MyApplication from './frontend/MyApplication'
    import ProfileTab from './frontend/ProfileTab'
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import HeaderModel from './../../HeaderModel';
    import * as yup from 'yup';
    export default {
        components: {
            ImageTab,
            ProfileTab,
            MyApplication,
            Form,
            Field,
            ErrorMessage,
            HeaderModel
            
        },
        data () {
            return {
                userData : [] ,
                valid : false ,
                searchInput : '',
                getMyApplication : false ,
                imgHolder : [],
                image: '',
                triggerUpload : false
            }
        },
        methods : {
            
            getMyApplicationClick (){
               
                this.getMyApplication = true;
            },
            searchJob() {
                if(this.searchInput.trim() != ""){
                    localStorage.removeItem("_search_");
                    localStorage.setItem('_search_',this.searchInput.trim()); 
                     this.$router.push({
                        path: '/joblists', 
                    })
                }
               
            },
            getUserData (data) {
                this.userData = data
                this.image = data.profile_image;
            
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
                  
                   if(response.data.has_error == false){
                    this.$swal("Updated");
                   }
                }).catch((error) => {

                });
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
            //console.log(uData)
        }
    }

</script>

<style scoped>
.update-profile {
    font-size: 20px;
    position: absolute;
    visibility: hidden;
    color: var(--theme);
    top:40%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
    transition: opacity .2s, visibility .2s;
}

.update-profile {
   cursor: pointer;
}

.profile-container:hover .update-profile {
  visibility: visible;
}

.profile-container:hover > .profImg {
    opacity:  0.3;
}

  
 @import '../../../../../sass/model.scss'; 

</style>