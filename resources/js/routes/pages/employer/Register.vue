<template>
   
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light nav-header-theme fixed-top-nav">
        <div class="container">
           <router-link class="" to="/">Freelance Logo</router-link>
           <router-view/>
        </div>
    </nav>

    <div class="container-fluid vh-100" v-if="!preloading">
        <div class="rounded d-flex justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                <div class="text-center">
                    <h3>Hire models for your business now!</h3>
                </div>
                <div class="p-1">
                    <Form  class="form" @submit="registerEmployer"  :validation-schema="schema"  ref="form">
                        <div class="col-md-12 mb-3">
                            <Field name="firstname" type="text" class="flat-input form-control" placeholder="First Name" />
                            <ErrorMessage class="text-danger errormessage " name="firstname" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <Field name="lastname" type="text" class="flat-input form-control" placeholder="Last Name" />
                            <small><ErrorMessage class="text-danger errormessage " name="lastname" /></small>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <Field name="email" type="email" class="flat-input form-control" placeholder="Email" />
                            <ErrorMessage class="text-danger errormessage " name="email" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <Field name="companyName" type="etxt" class="flat-input form-control" placeholder="Company Name" />
                            <ErrorMessage class="text-danger errormessage " name="companyName" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <Field name="companyDisplay" type="text" class="flat-input form-control" placeholder="Company Name to be displayed on job posting" />
                            <ErrorMessage class="text-danger errormessage " name="companyDisplay" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <vSelect class="flat-input" :options="countryList" label="country_name" :reduce="countryList => countryList.country_code" v-model="country">
                                <template #search="{attributes, events}">
                                    <input
                                        class="vs__search "
                                        v-bind="attributes"
                                        v-on="events"
                                    />
                            </template>
                            </vSelect>
                            <small><span role="alert" v-if="countryError" class="text-danger errormessage">select country </span></small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-group">
                                <Field name="password" v-if="hidepass"  autocomplete  type="password" class="flat-input form-control" placeholder="Password (Min 6 Characters)" />
                                <Field name="password" v-else type="text" class="flat-input form-control" placeholder="Password (Min 6 Characters)" />
                               
                                <a href="javascript:void(0);" class=" icon-a button" @click="toggleShow">
                                    <span class="icon is-small is-right">
                                        <i class="fas eye-icon" :class="{ 'fa-eye-slash': hidepass, 'fa-eye': !hidepass }"></i>
                                    </span>
                                </a>
                            </div>
                            <small><ErrorMessage class="text-danger errormessage " name="password" /></small>
                        </div>


                        <div class="col-md-12 mb-3">
                            <Field class="form-control" placeholder="Company Description " name="company_description" as="textarea">
                              
                            </Field>
                            <small><ErrorMessage class="text-danger errormessage " name="company_description" /></small>
                        </div>


                        <div class="col-md-12 m-3">
                            <label class="form-check-label">
                            <Field name="agree" type="checkbox"  :value="false"/>
                            <small><ErrorMessage class="text-danger errormessage-checkbox " name="agree" /></small>
                            I accept the 
                            <a href="#" @click="modalTerms">Terms of Use</a> &amp; <a href="#" @click="modalPrivacy" >Privacy Policy</a></label>
                        </div>
                        <div class="d-grid col-12 mx-auto">
                            <button type="submit"  class="btn btn-theme btn-md">Sign Up</button>
                        </div>
                    </Form>
                    <span> Already have an account ?
                        <router-link class="" to="/employer/login">Login</router-link>
                        <router-view/>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid vh-100"  v-else>
        <div class=" justify-content-center text-center">
            <i class="fa-solid fa-star fa-beat" style="--fa-animation-duration: 0.5s;" ></i>
            
        </div>
    </div>


    <TermsModal></TermsModal>
    <PrivacyModal></PrivacyModal>

</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import TermsModal from '../../../components/TermsModal.vue';
import PrivacyModal from '../../../components/PrivacyModal.vue';
import vSelect from 'vue-select'

export default {
components: {
    Form,
    Field,
    ErrorMessage,
    TermsModal,
    PrivacyModal,
    vSelect
},

data() {
   
    const schema = yup.object({
        firstname: yup.string().required("required field"),
        lastname: yup.string().required("required field"),
        email: yup.string().required("must be a valid email").email(),
        password: yup.string().required().min(6),
        agree : yup.bool().required("You need to accept"),
        company_description: yup.string().required("please provide company description"),
        companyName: yup.string().required("required field"),
        companyDisplay: yup.string().required("required field"),
        
        
    });

    return {
        schema,
        hidepass : true,
        isShow : true,
        modalShowTerms : false,
        modalShowPrivacy : false,
        preloading : true ,
        country : 'Select Country',
        countryError : false,
        countryList : []
    };
},
methods: {
    toggleShow() {
        this.hidepass = !this.hidepass;
    },
    registerEmployer(values , actions) { 
        
        if(this.country == "" || this.country == null){
            this.countryError = !this.countryError
            return false
        }
    
        values.country_code = this.country;
        values.type = 'E';
        axios.post("/api/register" ,values)
        .then(response =>{
            
            if(response.data.has_error){
                //error message from api
                const errorApi = {
                    email  : response.data.message
                };

                //set multiple errors
                actions.setErrors(
                    errorApi
                );
            } else{
                
            }
        });
      
        
    },
    modalTerms () {
        this.$store.commit("setModalTerms", !this.modalShowTerms);
    },
    modalPrivacy () {
        this.$store.commit("setModalPrivacy", !this.modalShowPrivacy);
    },

},
mounted () {
    this.$nextTick(function () {
        this.preloading = !this.preloading 
    })

    axios.get("/api/country").then(response =>{
        this.countryList = response.data
    }); 
}
};
</script>

<style scoped>

.icon-a{
    background-color:var(--theme);
    color: #fff;
    width: 50px;
    text-align: center;
    border-radius: 30px;
}

.eye-icon{
    margin-top:10px;
    width : fit-content
}
.col-12{
    margin-bottom: 2rem;
}

.errormessage{
    margin-left: 1rem;
    font-weight: italic;
}

.navbar-light {
    margin-bottom : 5rem
}

.input-group-text{
    background-color: var(--theme) !important ;
}
.navigations:hover {color:var(--theme)}



</style>