<template>
   <section>
        <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <router-link :to="'/'"  > FREELANCE  </router-link>
            </div>
        </nav>
        <div class="formbold-main-wrapper">
           <div class="card-body">
                <div class="formbold-form-wrapper">
                    <div class="mt-5 mb-5">
                        <h4>Contact Us</h4>
                    </div>
                    <Form @submit="contactus" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                        <div class="formbold-mb-5">
                            <label for="name" class="formbold-form-label"> Full Name </label>
                            <Field class="flat-input" type="text" placeholder="Your Fullname " name="fullname"></Field>
                            <ErrorMessage class="text-danger errormessage " name="fullname" />
                        </div>

                        <div class="formbold-mb-5">
                            <label for="email" class="formbold-form-label"> Email Address </label>
                            <Field class="flat-input" type="text" placeholder="Your Email " name="email"></Field>
                            <ErrorMessage class="text-danger errormessage " name="email" />
                        </div>

                        <div class="formbold-mb-5">
                            <label for="subject" class="formbold-form-label"> Subject </label>
                            <Field class="flat-input" type="text" placeholder="Subject " name="subject"></Field>
                            <ErrorMessage class="text-danger errormessage " name="subject" />
                            <Field name="next" type="text" id="loginfield_" />
                        </div>

                        <div class="formbold-mb-5">
                            <label for="message" class="formbold-form-label"> Message </label>
                            <Field class="flat-input" placeholder="Type Your Message " rows="5" cols="20" name="message" as="textarea"></Field>
                            <ErrorMessage class="text-danger errormessage " name="message" />
                        </div>

                        <div>
                            <button class="btn  mt-3 btn-theme"  :disabled="isSubmitting">Submit  <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
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
            ErrorMessage
        },
        data () {

            const schema = yup.object({
                fullname: yup.string().required("Please input your name").max(200 , "Name is too long"),
                email: yup.string().required("must be a valid email").email(),
                subject: yup.string().required("Please input your subject").max(256 , "Subject is too long"),
                message: yup.string().required("Please input your message").max(1000 , "1000 characters are allowed"),
            });
            return {
                 schema
            }
        },
        methods : {
            contactus (values , actions) {

                if(values.next == '_next_valid_login_' || values.next != "" ) values.is_valid_ =true;
                if(values.next == undefined) values.next="_next_valid_login_"; values.is_valid_ = false;

              
                axios.post('api/contactus' , values).then(response => {
                    this.$toast.success('Email Sent!') 
                    this.$refs.form.resetForm();
                }).catch((error) => {
                    
                });
            }
        }

    }
</script>
<style>
  #loginfield_{
    display: none;     
    }
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: "Inter", sans-serif;
  }
  .formbold-mb-5 {
    margin-bottom: 20px;
  }
  .formbold-pt-3 {
    padding-top: 12px;
  }
  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 550px;
    width: 100%;
    background: white;
  }
  .formbold-form-label {
    display: block;
    font-weight: 500;
    font-size: 16px;
    color: #07074d;
    margin-bottom: 12px;
  }
  .formbold-form-label-2 {
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 20px;
  }

  .formbold-form-input {
    width: 100%;
    padding: 12px 24px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    background: white;
    font-weight: 500;
    font-size: 16px;
    color: #6b7280;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-btn {
    text-align: center;
    font-size: 16px;
    border-radius: 6px;
    padding: 14px 32px;
    border: none;
    font-weight: 600;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold--mx-3 {
    margin-left: -12px;
    margin-right: -12px;
  }
  .formbold-px-3 {
    padding-left: 12px;
    padding-right: 12px;
  }
  .flex {
    display: flex;
  }
  .flex-wrap {
    flex-wrap: wrap;
  }
  .w-full {
    width: 100%;
  }
  @media (min-width: 540px) {
    .sm\:w-half {
      width: 50%;
    }
  }
</style>