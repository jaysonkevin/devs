<template>
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>Forgot Password?</h5>
                <p class="mb-2">Enter your registered email to reset the password
                </p>
              </div>
              <Form class="form" @submit="reset" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                <div class="mb-3">
                    <Field name="email" type="email" class="flat-input form-control" placeholder="Email" />
                    <ErrorMessage class="text-danger errormessage " name="email" />
                </div>
                <div class="mb-3 d-grid">
                    <button class="btn  mt-3 btn-theme" :disabled="isSubmitting">Reset Password <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
                </div>
                <Field name="next" type="text" id="loginfield_" />
                <span><strong>Don't have an account?</strong></span>
                <div class="pull-left">
                    <a>Signup as Model</a>
                </div>
                <div class="pull-left">
                    <a>Signup as Employer</a>
                </div>
                
              </Form>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<style scoped>
    #loginfield_{
      display: none;     
    }
    a {
        color:inherit;
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
            });
            return {
                schema
            }
         }, 
        methods : {
            reset (values , actions) {
                  
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

                axios.post('api/resetpassword', values).then(response => {
                 
                }).catch(error => console.log(error)); 
            }
        }
    }
</script>