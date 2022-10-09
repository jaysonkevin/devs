<template>
    <div class="container d-flex flex-column">
      
      <div class="row align-items-center justify-content-center
          min-vh-100">
          <div>
              <router-link class="btn btn-xs btn-theme" :to="'/'" >Home Page</router-link>
              <router-view/>
          </div>
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>Reset Password</h5>
              </div>
              <span class="badge bg-danger" v-if="showError !='' ">{{showError}}</span>
              <Form class="form"  @submit="reset" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                <div class="mb-3">
                    <Field name="email" v-model="email" type="email" readonly class="flat-input form-control email" placeholder="Email" />
                    <ErrorMessage class="text-danger errormessage " name="email" />
                </div>
                <div class="mb-3">
                    <Field name="password" type="password" class="flat-input form-control" placeholder="New Password" />
                    <ErrorMessage class="text-danger errormessage " name="password" />
                </div>
                <div class="mb-3">
                    <Field name="password_confirmation" type="password" class="flat-input form-control" placeholder="Confirm New Password" />
                    <ErrorMessage class="text-danger errormessage " name="password_confirmation" />
                </div>
                <div class="mb-3 d-grid">
                    <button class="btn  mt-3 btn-theme" :disabled="isSubmitting">Reset Password <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
                </div>

                <div class="mb-3 d-grid" v-if="showResetLink">
                  <router-link class="btn btn-xs btn-warning" :to="'/forgotpassword/'" >Token Expired , Request Again?</router-link>
                  <router-view/>
                </div>

                <Field name="next" type="text" id="loginfield_" />      
                <Field name="token" v-model="token" type="text" id="token_field" />                
              </Form>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<style scoped>
    #loginfield_ , #token_field{
      display: none;     
    }
    a {
        color:inherit;
    }
    .email {
        cursor: not-allowed;
    }
    </style>
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
                email: yup.string().required("must be a valid email").email(),
                password: yup.string().required().min(6),
                password_confirmation: yup.string().oneOf([yup.ref('password'), null], 'Passwords must match')
            });
            return {
                schema ,
                email : this.$route.params.email ,
                token : this.$route.params.token,
                showError : '' ,
                showResetLink : false
            }
         }, 
        methods : {
            reset (values , actions) {
                  
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;
               
                axios.post('api/reset-password', values).then(response => {
                 
                }).catch(error => console.log(error)); 
            } ,

        },
        beforeCreate () {
          let data  = {
            email : this.$route.params.email ,
            token : this.$route.params.token
          }
          axios.post('api/checkResetToken', data).then(response => {
              this.showError = ''
              this.showResetLink = false;

              if(response.data.has_error == false){
                location.href = '/';
              }
              if(response.data.has_error){
                if(response.data.error_type == 1){
                  this.showError = response.data.message
                }

                if(response.data.error_type == 2){
                  this.showResetLink = true;
                }
              }
          }).catch(error => console.log(error)); 
        }
      
       
    }
</script>