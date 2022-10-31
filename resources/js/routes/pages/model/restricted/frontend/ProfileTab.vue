<template>
    <div id="profile-tab"  class="tab-pane fade">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="">
                        <h5 class="mb-4">Update Personal Infomation</h5>
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
                                .max(new Date(), "Future dates are not allowed"),
                height: yup.number().required().typeError("please enter your height in cm"), 
               // region: yup.string().required().typeError("please select your region/state"),
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
                
               
            }
           
        }, 
        methods : {
            updateinfo(values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;
                axios.post('api/updateinfo',values).then(response => {
                    this.$toast.success('updated!',{
                        position:'top'
                    }) 
                }).catch((error) => {
                
                });
            } ,
            updatesocial (values , actions) {
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/updateinfosocial',values).then(response => {
                    this.$toast.success('updated!',{
                        position:'top'
                    }) 
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