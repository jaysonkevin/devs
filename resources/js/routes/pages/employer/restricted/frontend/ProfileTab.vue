<template>
    <div id="employer-profile-tab"  class="tab-pane fade">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="">
                        <h5 class="mb-4">Update Personal Infomations</h5>
                        <div class="row">
                            <Form  @submit="updateinfo" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                                
                                <div class="col-md-6 profile-form">
                                    <div class="form-outline">
                                        <label class="form-label">Employer Firstname</label>
                                        <Field name="firstname"  v-model="userData.firstname" type="text" class="flat-input form-control" placeholder="Employer First Name" />
                                        <ErrorMessage class="text-danger errormessage " name="firstname" />
                                    </div>
                                </div>
                                <div class="col-md-6 profile-form">
                                    <div class="form-outline">
                                        <label class="form-label control-label"> Employer  Lastname</label>
                                        <Field name="lastname"  v-model="userData.lastname" type="text" class="flat-input form-control" placeholder="Employer Last Name" />
                                        <ErrorMessage class="text-danger errormessage " name="lastname" />
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
</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    import parse from "date-fns/parse";
    export default {
        
        components : {
            Form,
            Field,
            ErrorMessage,
        },
        data () {
            const schema = yup.object({
             
                firstname: yup.string().required(),
                lastname: yup.string().required(),
              
                region: yup.string().required().typeError("please select your region/state"),
                country: yup.string().required(),
    
             
            });
            return {
                country: '',
                region: '',
                schema , 
                userData : [] ,
                country_code :[],
      
                
               
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
                
                this.userData.region = event.target.value
            },
          
          
     
        } ,
  
        mounted(){

            // get user token
            axios.get('api/cUL').then(response => {
               
                this.userData = response.data.u
                this.userData.lastname = this.userData.lastname.charAt(0).toUpperCase() + this.userData.lastname.slice(1);             
                if(this.userData.height == null) { this.userData.height = "" }; 
                if(this.userData.date_of_birth == null) { this.userData.date_of_birth = "" } ; 

                this.$emit('uData', this.userData)
            
 
            }).catch((error) => {
                const token =  localStorage.getItem('u_t'); 
                if(token == null){
                    location.href = '/';
                
                }
               
            });
        } ,
    }
</script>