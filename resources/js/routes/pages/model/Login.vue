<template>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <Form class="form" @submit="login" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                        <span class="badge bg-danger" v-if="errorMessage">Invalid Email or Password</span>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="login-email">Email address</label>
                            <Field name="email" type="email" class="flat-input form-control" placeholder="Email" />
                            <ErrorMessage class="text-danger errormessage " name="email" />
                            
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <Field name="password" autocomplete type="password" class="flat-input form-control" placeholder="Password" />
                            <ErrorMessage class="text-danger errormessage " name="password" />
                        
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
    </section>
</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';

    export default {
         components: {
            Form,
            Field,
            ErrorMessage,
         },
        data(){
            const schema = yup.object({
                email: yup.string().required("must be a valid email").email(),
                password: yup.string().required(),
                
             
            });

            return {
                authenticated : false,
                schema,
                errorMessage : false
                
            }
        },
        methods : {
            login (values , actions) {
                
                if(values.next == '_next_valid_login_') values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;
                
            
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', values).then(response => {

                        if(response.data.error !== undefined){
                            this.errorMessage = !this.errorMessage
                            return false
                        } else{
                            this.errorMessage = false;
                            //this.$store.commit("setAuthentication", true);
                            localStorage.setItem('u_t',response.data); 
                            this.$router.replace({ name: "model" });
                            
                        }

                      
                    }).catch(error => console.log(error)); // credentials didn't match
                });
               
            } ,
           
        },
        mounted () {
 
            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                        if(response.data) {
                            this.$router.replace({ name: "model" });
                        }
                    });
                }
            }).catch((error) => {
            
            });
          
           
        }
    }
</script>

<style scoped>
#loginfield_{
  display: none;     
}

</style>