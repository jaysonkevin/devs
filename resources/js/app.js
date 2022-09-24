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

//jayson pogi
const token =  localStorage.getItem('u_t'); 
window.axios.defaults.baseURL = process.env.MIX_PUBLIC_URL
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'Authorization': `Bearer ${token}` 

};



const store = new Vuex.Store(
  {
      state: {
          authenticated: false ,
          _user_ : '',
          modalShowPrivacy : false,
          modalShowTerms : false ,
          
       
      },
      mutations: {
          setModalTerms (state, status) {
            state.modalShowTerms = status;
          },
          setModalPrivacy (state, status) {
            state.modalShowPrivacy = status;
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
.use(VueSweetalert2 )
.use(VueAxios, axios) 
.use(router)
.use(store)
.use(vueCountryRegionSelect)
.use(VueUniversalModal, {
  teleportTarget: '#modals',
})

.mount('#app')



