<template>
   
    <section>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="container py-5">
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
                            <div id="img-tab" class="tab-pane fade in active show">
            
                                <section class="mt-5">
                                    <h5>Upload your updated photos and attract your employers!</h5>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        @click="showImg('https://scontent.fmnl8-1.fna.fbcdn.net/v/t39.30808-6/302588525_152137237446191_907729150595214515_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeGMbGmIUR8CABlVRFmYiPWI794Z3AYH1Cvv3hncBgfUK5A4VqEPb3Vld_n3EloGvhhKMWhnQXEBSqZ4ezb4UeMW&_nc_ohc=BtfhCw482tMAX9CLnXd&tn=0dyQ7GsPfDh4ye-7&_nc_ht=scontent.fmnl8-1.fna&oh=00_AT_a1-CEWMJhQl780GGQWMgb-dzPv8gXCWUuwJUGvjyvYg&oe=631A41F1')"
                                                        src="https://scontent.fmnl8-1.fna.fbcdn.net/v/t39.30808-6/302588525_152137237446191_907729150595214515_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeGMbGmIUR8CABlVRFmYiPWI794Z3AYH1Cvv3hncBgfUK5A4VqEPb3Vld_n3EloGvhhKMWhnQXEBSqZ4ezb4UeMW&_nc_ohc=BtfhCw482tMAX9CLnXd&tn=0dyQ7GsPfDh4ye-7&_nc_ht=scontent.fmnl8-1.fna&oh=00_AT_a1-CEWMJhQl780GGQWMgb-dzPv8gXCWUuwJUGvjyvYg&oe=631A41F1"
                                                        class="img-fluid image-tab"
                                                        data-bs-toggle="modal" data-bs-target="#imgModal"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid image-tab"
                                                        @click="showImg('https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp')"
                                                        data-bs-toggle="modal" data-bs-target="#imgModal"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid image-tab"
                                                        @click="showImg('https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp')"
                                                        data-bs-toggle="modal" data-bs-target="#imgModal"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                     
                                    </div>
                                </section>
                            </div>
                            <!-- PROFILE -->
                            <div id="profile-tab"  class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <div class="">
                                                <h5 class="mb-4">Update Personal Infomations</h5>
                                                <div class="row">
                                                    <Form  @submit="updateinfo" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                                                        
                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label">Firstname</label>
                                                                <Field name="firstname"  v-model="userData.firstname" type="text" class="flat-input form-control" placeholder="First Name" />
                                                                <ErrorMessage class="text-danger errormessage " name="firstname" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Lastname</label>
                                                                <Field name="lastname"  v-model="userData.lastname" type="text" class="flat-input form-control" placeholder="Last Name" />
                                                                <ErrorMessage class="text-danger errormessage " name="lastname" />
                                                            </div>
                                                        </div>
                                                      
                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Date of Birth</label>
                                                            
                                                                <Field name="date_of_birth" v-model="userData.date_of_birth" type="date" class="flat-input datepicker form-control"  placeholder="Date of Birth" />
                                                                <ErrorMessage class="text-danger errormessage " name="date_of_birth" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Height</label>
                                                                <div class="input-group mb-3">
                                                                    <Field name="height" type="number" v-model="userData.height" min="1" max="350" class="flat-input  form-control"  placeholder="height" />
                                                                    <span class="input-group-text">cm</span>
                                                                </div>      
                                                                <ErrorMessage class="text-danger errormessage " name="height" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Country</label>
                                                                <Field name="country" v-model="userData.country_code">
                                                                    <country-select name="country"  class="flat-input  form-control" v-model="userData.country_code" :country="userData.country_code" v-bind:value="userData.country_code"  />
                                                                    <ErrorMessage class="text-danger errormessage " name="country" />
                                                                 </Field>  
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Region</label>
                                                                <Field name="regions" v-model="region">
                                                                    <region-select @change="changeRegion($event)" class="flat-input form-control"  :country="userData.country_code"  v-model="region" placeholder="Select Region" :region="userData.region"  />
                                                                </Field>
                                                                
                                                                <Field class="hide"  name="region" v-model="userData.region" >

                                                                </Field>
                                                                
                                                                <ErrorMessage class="text-danger errormessage " name="region" />
                                                                
                                                            </div>
                                                          
                                                        </div> 
                                                        <Field name="next" type="text" id="loginfield_" />
                                                        <!-- Submit button -->
                                                        <div class="d-grid gap-2 col-md-6">
                                                            <button class="btn  mt-3 btn-theme"  :disabled="isSubmitting">Update  <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
                                                        </div>
                                                    </Form>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
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
  
</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    import parse from "date-fns/parse";

    export default {
        components: {
            Form,
            Field,
            ErrorMessage,
            
        },
       
        data () {
            const schema = yup.object({
             
                firstname: yup.string().required(),
                lastname: yup.string().required(),
                date_of_birth: yup.date()
                                .transform(function (value, originalValue) {
                                if (this.isType(value)) {
                                    return value;
                                }
                                const result = parse(originalValue, "dd.MM.yyyy", new Date());
                                    return result;
                                })
                                .typeError("please enter a valid date")
                                .required()
                                .min("1969-11-13", "Date is too early"),
                height: yup.number().required().typeError("please enter your height in cm"), 
                region: yup.string().required(),
                country: yup.string().required(),
    
             
            });

            const schemaSocial = yup.object({
             
                twitter: yup.string().max(15).nullable(),
                instagram: yup.string().max(30).nullable(),
                facebook: yup.string().max(50).nullable(),
                snapchat: yup.string().max(30).nullable(),
                tiktok: yup.string().max(24).nullable(),

            });


            return {
                country: '',
                region: '',
                schema , 
                userData : [] ,
                country_code :[],
                socialEdit : false,
                schemaSocial,
                imgSrc : ''
               
            }
           
        }, 
        methods : {
            updateinfo(values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;
                axios.post('api/updateinfo',values).then(response => {

                }).catch((error) => {
                
                });
            } ,
            updatesocial (values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/updateinfosocial',values).then(response => {

                }).catch((error) => {

                });
            },
            changeRegion (event) {
                console.log(event)
                this.userData.region = event.target.value
            },
            showImg (url) {
                this.imgSrc = ''; 
                this.imgSrc = url;

            },
          
     
        } ,
        mounted(){
            const token =  localStorage.getItem('u_t'); 
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
           
            // get user token
            axios.get('api/cUL',config).then(response => {
                this.userData = response.data.u
                this.userData.lastname = this.userData.lastname.charAt(0).toUpperCase() + this.userData.lastname.slice(1);             
                if(this.userData.height == null) { this.userData.height = "" }; 
                if(this.userData.date_of_birth == null) { this.userData.date_of_birth = "" } ; 
                
            
              
            }).catch((error) => {
               
            });

            // get country code 
            // axios.get('api/country_code',config).then(response => {
            //     this.country_code = response.data
            // }).catch((error) => {
               
            // });

        } ,
    
    }

</script>

<style scoped>

.popup-image {
    margin-top:10%;
}

.overlay {
    text-align : center;
    position: absolute; /* Sit on top of the page content */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
}

#loginfield_{
  display: none;     
}
.profile-form{
    margin-bottom: 1rem;
}
.countries-cities {
  display: flex;
  justify-content: space-around;
  box-sizing: border-box;
}
  .select-box {
    height: 40px;
    min-width: 300px;
    background: #fff;
    border: 1px solid #e9e9e9;
    position: relative;
}
select {
      background: none;
      border: none;
      outline: none;
      padding-left: 7px;
      padding-right: 65px;
      appearance: none;
      width: 100%;
      height: 100%;
    }
    svg {
      position: absolute;
      right: 0;
      top: 0;
      width: 50px;
      height: 100%;
      background: darken(#fff, 3%);
      pointer-events: none;
      box-sizing: border-box;
      padding: 5px;
     
    }



    .shadow-2-strong {  
        height: 250px;
    }
    .img-card{
        margin-bottom: 1rem;
    }
    .nav-link.active{
        background-color: var(--theme) !important;
        color : #fff !important;
    }
    .nav-link{
        color :black
    }

    .navs{
        --bs-nav-link-padding-x: 1rem;
        --bs-nav-link-padding-y: 0.5rem;
        --bs-nav-link-font-weight: ;
        --bs-nav-link-color: var(--bs-link-color);
        --bs-nav-link-hover-color: var(--bs-link-hover-color);
        --bs-nav-link-disabled-color: #6c757d;
        display: flex;
        /* flex-wrap: wrap; */
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        white-space: nowrap;
        
    }

    .navigation-top{
        align-content: center;
        align-items: center;
    }

    .input-group-text {
        /* display: flex; */
        /* align-items: center; */
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        /* border: 1px solid #ced4da; */
        border-radius: 0.375rem;
    }

    .input-group-prepend {
        width: 21%;
    }

    .country_code_class {
        position: absolute;
    }


    .image-tab {
        height: 270px;
    }

/* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {
    .navigation-top{
        margin-top: 1rem;
    }
    .navs {
        font-size: 12px;
    }

    .image-tab {
        height: auto;
       
    }

  }

  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {
    .image-tab {
        height: auto;
       
    }
  }

  /* Medium devices (landscape tablets, 768px and up) */
  @media only screen and (min-width: 768px) {
    .image-tab {
        height: auto;
       
    }
  }

  /* Large devices (laptops/desktops, 992px and up) */
  @media only screen and (min-width: 992px) {
    .image-tab {
        height: 270px;
       
    }
  }

  /* Extra large devices (large laptops and desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {
    .image-tab {
        height: 270px;
       
    }
  }


</style>