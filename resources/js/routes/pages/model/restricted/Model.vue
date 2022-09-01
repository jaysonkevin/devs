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
                                    <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                </div>

                            </p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                        </div>
                    </div>

                    <div class="card  mt-2 toggle ">
                        <div class="card-body" id="social-toggle">
                            <h5 class="my-3">Social Links</h5>
                         
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-twitter fa-lg" style="color: rgb(85, 172, 238);"></i><p class="mb-0">@mdbootstrap</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-instagram fa-lg" style="color: rgb(172, 43, 172);"></i><p class="mb-0">mdbootstrap</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-facebook-f fa-lg" style="color: rgb(59, 89, 152);"></i><p class="mb-0">mdbootstrap</p></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3"><i class="fab fa-snapchat fa-lg" style="background-color:yellow"></i><p class="mb-0">mdbootstrap</p></li>
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
                            <div id="img-tab" class="tab-pane fade in active">
                                <section class="mt-5">
                                    <h5>Upload your updated photos and attract your employers!</h5>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
                                                    />
                                                </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4 col-xs-4">
                                           <div class="card img-card">
                                                <div class="card-body">
                                                    <img
                                                        src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp"
                                                        class="img-fluid"
                                                    
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
                                                                <label class="form-label control-label">Mobile Number</label>
                                                                
                                                                <select v-model="selected">
                                                                    <option :value="citizen" v-for="citizen of this.$store.state.country_code" :key="key">{{citizen}}</option>
                                                                </select>
                                                                <Field name="mobile"  type="text" class="flat-input form-control" placeholder="Mobile" />

                                                                <!-- <vue-tel-input mode="international" name="mobile" v-model="userData.mobile"></vue-tel-input> -->
                                                                
                                                                <ErrorMessage class="text-danger errormessage " name="mobile" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Date of Birth</label>
                                                            
                                                                <Field name="birthday" type="date" class="flat-input datepicker form-control"  placeholder="Date of Birth" />
                                                                <ErrorMessage class="text-danger errormessage " name="birthday" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                               <div class="row">
                                                                    <div class="col col-6">
                                                                        <label class="form-label control-label">Feet</label>
                                                                        <Field name="feet" type="number" min="1" max="10" class="flat-input datepicker form-control"  placeholder="Feet" />
                                                                        <ErrorMessage class="text-danger errormessage " name="feet" />
                                                                    </div>
                                                                
                                                                    <div class="col col-6">
                                                                        <label class="form-label control-label">Inches</label>
                                                                        <Field name="inches"  min="1" max="11" type="number" class="flat-input datepicker form-control"  placeholder="Inches" />
                                                                        <ErrorMessage class="text-danger errormessage " name="inches" />
                                                                    </div>
                                                               </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Country</label>
                                                                <Field name="country" v-model="country">
                                                                    <country-select name="country"  class="flat-input datepicker form-control" v-model="country" :country="country" topCountry="US" />
                                                                    <ErrorMessage class="text-danger errormessage " name="country" />
                                                                 </Field>   
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 profile-form">
                                                            <div class="form-outline">
                                                                <label class="form-label control-label">Region</label>
                                                                <Field name="region" v-model="region">
                                                                    <region-select class="flat-input datepicker form-control" v-model="region" :country="country" :region="region" />
                                                                </Field>
                                                                <ErrorMessage class="text-danger errormessage " name="region" />
                                                               
                                                            </div>
                                                        </div> 
                                                        <Field name="next" type="text" id="loginfield_" />
                                                        <!-- Submit button -->
                                                        <div class="d-grid gap-2">
                                                            <button class="btn  mt-3 btn-theme" :disabled="isSubmitting">Login <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
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

</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';

    export default {
        components: {
            Form,
            Field,
            ErrorMessage
            
          
        },
        data () {
            const schema = yup.object({
             
                // firstname: yup.string().required(),
                // lastname: yup.string().required(),
                // //mobile: yup.string().required(),
                // birthday: yup.string().required(),
                // feet: yup.number().required().min(1).max(10), 
                // inches: yup.number().required().min(1).max(11),
                // region: yup.string().required(),
                // country: yup.string().required(),
    
             
            });
            return {
                country: '',
                region: '',
                schema , 
                userData : []
            }
           
        }, 
        methods : {
            updateinfo(value , actions) {
                console.log(value)
            }
        } ,
        mounted(){

            console.log(this.$store.state.country_code)
            const token =  localStorage.getItem('u_t'); 
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };

           
            // get user token
            axios.get('api/user',config).then(response => {
                this.userData = response.data
                
                this.userData.lastname = this.userData.lastname.charAt(0).toUpperCase() + this.userData.lastname.slice(1);
            }).catch((error) => {
               
            });

        }
    }

</script>

<style scoped>

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
/* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {
    .navigation-top{
        margin-top: 1rem;
    }
    .navs {
        font-size: 12px;
    }

  }

  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {

  }

  /* Medium devices (landscape tablets, 768px and up) */
  @media only screen and (min-width: 768px) {
  
  }

  /* Large devices (laptops/desktops, 992px and up) */
  @media only screen and (min-width: 992px) {}

  /* Extra large devices (large laptops and desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {}


</style>