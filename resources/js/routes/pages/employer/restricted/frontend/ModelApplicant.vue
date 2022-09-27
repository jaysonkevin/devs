<template>
   <section>
    <HeaderEmployer :uData="userData"></HeaderEmployer>
    <div class="container py-5">
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <router-link style="font-size:10px"  class="btn btn-warning"  :to="'/employer/home/applicants?job=' +this.$route.query.job"  >
                        <i class="fa fa-arrow-left"></i>  Back To Job Applicants 
                    </router-link>
                </div>
                <div class="col-sm-3">
                    <div class="card sm-3">
                        <div class="card-body text-center">
                            <p class="p_country">Philippines</p>
                            <div class="profile-container">
                                <img 
                                        :src="image" 
                                        alt="avatar" class="rounded-circle  img-fluid" style="width: 150px;height: 150px;"/>
                                    
                            </div>
                            <h5 class="my-3">
                                <b class="p_fullname"> {{applicant.firstname}} {{applicant.lastname}}</b>
                                <p class="p_email">{{applicant.email}}</p>
                            </h5>
                            <div class=" text-center">
                                <ul class="list-group list-group-flush">
                                    <li  class="list-group-item borderless" v-if="applicant.age > 0">
                                        <small class="age"> Age : {{applicant.age}} </small>
                                    </li>
                                    <li  class="list-group-item borderless" v-if="applicant.height != null">
                                        <small lass="height"> Height : {{applicant.height}}cm</small>
                                    </li>
                                    
                                </ul>
                            </div>
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
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-twitter fa-lg" style="color: rgb(85, 172, 238);"></i><p class="mb-0"> {{applicant.twitter}}</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-instagram fa-lg" style="color: rgb(172, 43, 172);"></i><p class="mb-0">{{applicant.instagram}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-facebook-f fa-lg" style="color: rgb(59, 89, 152);"></i><p class="mb-0">{{applicant.facebook}} </p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-snapchat fa-lg" style="background-color:yellow"></i><p class="mb-0">{{applicant.snapchat}}</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-tiktok fa-lg" style="background-color:yellow"></i><p class="mb-0">{{applicant.tiktok}} </p></li>
                                
                            </ul>
                            
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-sm-9">
                    <small>
                        <h4>
                           Applicant's Gallery
                        </h4>
                    </small>
          
                    <div class="row" v-if="images.length > 0">
                        <div class="col-md-4 col-xs-4" v-for="(item, index) in images">
                            <div class="card img-card">
                                <div class="card-body">
                                    <img
                                        @click="showImg('../../storage/photo/'+item._p_+'/'+item.image)"
                                        :src="'../../storage/photo/'+item._p_+'/'+item.image"
                                        class="img-fluid image-tab"
                                        data-bs-toggle="modal" data-bs-target="#imgModal"
                                        />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-else>
                        <div class="col-md-12 col-xs-12 mt-4" >
                            <p class="text-center">Gallery is Empty...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODALS -->
        <div class="modal fade" id="imgModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <img
                        v-bind:src="imgSrc"
                        class="img-fluid" />
                </div>
            </div>
        </div>
   </section>
</template>
<style>
    .p_email , .p_country {
        font-size: 10px;
        margin-bottom: 5px !important;
    }
    .p_country {
        font-weight: bold;
        text-transform: uppercase !important;
    }

    .age {
        margin-bottom: -8px !important;
    }
    li.borderless { border-top: 0 none; }

    .image-tab {
        height: 270px;
    }

    .img-card{
        margin-bottom: 1rem;
    }
</style>
<script>
    import HeaderEmployer from './../../../HeaderEmployer';
    export default {
        components : {
            HeaderEmployer
        },
        data(){
            return {
                image  :'' ,
                applicant : [] ,
                images : [],
                userData : [] ,
                imgSrc : ''
            }
        },
        methods : {
            showImg (url) {
                this.imgSrc = ''; 
                this.imgSrc = url;

            },
        },
        beforeCreate(){

            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                        this.userData = response.data.u
                    });
                } 
            }).catch((error) => {
                location.href = '/employer';
            });

            axios.post('api/applicant' , this.$route.query).then(response => {
                this.applicant = response.data.applicant
                this.images = response.data.images
                this.image = response.data.applicant.profile_image
            }).catch((error) => {
                location.href = '/employer';
            });
        }
    }
</script>