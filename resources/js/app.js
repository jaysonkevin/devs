import { createApp } from 'vue'
import './bootstrap';
import '../sass/app.scss'
import Vuex from "vuex"
import {createRouter ,createWebHistory} from 'vue-router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import vueCountryRegionSelect from 'vue3-country-region-select'
import 'vue-select/dist/vue-select.css';
import VueUniversalModal from 'vue-universal-modal'
import 'vue-universal-modal/dist/index.css'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toaster from '@meforma/vue-toaster';
import '../js/global'


//jayson pogi
const token =  localStorage.getItem('u_t'); 
window.axios.defaults.baseURL = process.env.MIX_PUBLIC_URL
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'Authorization': `Bearer ${token}` ,
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')

};



const store = new Vuex.Store(
  {
      state: {
          authenticated: false ,
          _user_ : '',
          modalShowPrivacy : false,
          modalShowTerms : false ,
          responseStatus : false
          
       
      },
      mutations: {
          setModalTerms (state, status) {
            state.modalShowTerms = status;
          },
          setModalPrivacy (state, status) {
            state.modalShowPrivacy = status;
          },
          responseStatus (state , status){
            state.responseStatus = status
          }


      }
  }
);


const routes = [
    { path: '/', component: () => import('./Home.vue') },
    { path: '/employer/login', component: () =>import('./routes/pages/employer/Login.vue') },
    { path: '/employer/register', component: () =>import('./routes/pages/employer/Register.vue') },
    { path: '/model/login', component: () =>import('./routes/pages/model/Login.vue') },
    { path: '/model/register', component: () =>import('./routes/pages/model/Register.vue') },
    { path: '/login', component: () =>import('./Home.vue') },
    { path: '/register', component: () =>import('./Home.vue') },
    { path: '/aboutus', component: () =>import('./routes/About.vue') },
    { path: '/contactus', component: () =>import('./Contact.vue') },
    { path: '/employerfaq', component: () =>import('./EmployerFAQ.vue') },
    { path: '/modelfaq', component: () =>import('./ModelFAQ.vue') },

    // restricted pages
    {
      path : "/employer",
      name :"employer",
      component: () => import("./routes/pages/employer/EmployerLanding.vue")
    },
    {
        path : "/employer/home",
        name :"employer/home",
        component: () => import("./routes/pages/employer/restricted/Employer.vue")
      },
    {
      path : "/model",
      name :"model",
      component: () => import("./routes/pages/model/restricted/Model.vue"),
    } ,
    {
      path : "/joblists",
      name :"joblists",
      component: () => import("./JobLists.vue"),
    } ,
    {
      path : "/job/:id",
      name :"job",
      component: () => import("./Job.vue"),
    },

    {
      path : "/employer/home/applicants",
      name :"employer/applicants",
      component: () => import("./routes/pages/employer/restricted/frontend/Applicant.vue")
    },
    {
      path : "/employer/home/model",
      name :"employer/home/model",
      component: () => import("./routes/pages/employer/restricted/frontend/ModelApplicant.vue")
    },

    {
      path : "/model/notification/:id",
      name :"model/notification",
      component: () => import("./routes/pages/model/restricted/Notification.vue")
    },
    {
      path : "/forgotpassword",
      name :"forgotpassword",
      component: () => import("./components/ForgotPassword.vue")
    }
    ,
    {
      path : "/reset/:token/:email",
      name :"reset",
      component: () => import("./components/ResetPasswordForm.vue")
    },
    {
      path : "/pricing",
      name :"pricing",
      component: () => import("./Pricing.vue")
    },
    {
      path : "/checkout/:id/:price",
      name :"checkout",
      component: () => import("./Checkout.vue")
    }


  ]


  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
  })
    

  // Make sure to _use_ the router instance to make the
  // whole app router-aware.

let featured = createApp({

})
.use(Toaster,{
  position: 'top-right'
})
.use(VueSweetalert2 )
.use(VueAxios, axios) 
.use(router)
.use(store)
.use(vueCountryRegionSelect)
.use(VueUniversalModal, {
  teleportTarget: '#modals',
})

.mount('#app')



