<template>
    <section>

        <HeaderEmployer :uData="userData"></HeaderEmployer>
        <div class="container">
            <div class="text-center mt-2" v-if="job_details.is_purchased == 'N'">
                <div id="dropin-container"></div>
                <button @click="buy" id="submit-button" class="btn btn-md btn-warning"><i class="fa " :class="buyIcon"></i> {{buyText}}</button>
                
            </div>
           
            <div v-else class="text-center mt-2">
                <button class="btn btn-md btn-theme"><i class="fa fa-check"></i> Paid Advertisement</button>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-briefcase"></i> Job Type <b>{{job_details.job_type}}</b> </p>
                            
                        </div>
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-sack-dollar"></i> Salary <b> ${{job_details.salary}}</b>
                            </p>
                            
                        </div>
                        <div class="col col-md-4">
                            <p><i class="fa-solid fa-calendar"></i> Date Posted <b>{{job_details.accepted_date}}</b> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-if="applicant_lists.length > 0" class="col-sm-4 mt-2"  v-for="(item , index) in applicant_lists" :key="item">
                    <div class="card" >
                        <div class="card-header text-center">
                            
                            <div class="row">

                                <StarRating v-if="item.is_hired == 'N' "  
                                        v-bind:show-rating= false
                                        active-color="#42b883"
                                        v-bind:star-size="30"
                                        v-bind:rating="item.rating"
                                        :read-only=true
                                ></StarRating>

                                <StarRating 
                                        v-else
                                        v-bind:rating="item.rating"
                                        v-bind:increment="1"
                                        inactive-color="#cdcdcd"
                                        active-color="#42b883"
                                        v-bind:star-size="30"
                                        v-bind:show-rating= false
                                        @update:rating ="setRating"
                                        @click="rateApplicant(item.id)"
                                      
                                >
                                </StarRating>
                               
                            </div>
                            
                        </div>
                        <div class="card-body text-center"  >
                            <img 
                                :src="item.profile_image"
                                alt="avatar" 
                                class="rounded-circle img-fluid"
                                style="width: 200px;height: 200px;"/>

                            <p class="mt-3 mb-1"><strong> {{item.firstname}}  {{item.lastname}} </strong></p>
                            <small v-if="job_details.is_purchased == 'Y'" >
                                <router-link style="font-size:10px"  class="btn btn-theme" :to="'/employer/home/model?applicant='+item.id+'&job=' +this.$route.query.job"  >
                                    Full Info <i class="fa fa-arrow-right"></i>
                                </router-link>
                            </small>
                            <p class="mb-2">
                               
                                <small v-if="item.is_hired == 'N'">
                                    <button @click="hire(item.id ,this.$route.query.job )" class="btn btn-sm btn-warning"> <i class="fa fa-star"></i>Mark as hired</button>
                                </small>
                                <small v-else>
                                    <i class="fa-solid fa-check"></i> Hired
                                </small>
                            </p>
                            <p class="purchase-enabled-false" >
                                <small>
                                    <button type="submit" class="btn btn-theme  purchase-enabled-false"  disabled>Full Info <i class="fa fa-arrow-right"></i>
                                    </button>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-2 container text-center" v-else>
                    <h3>No Applicants Yet..</h3>
                </div>
            </div>
        </div>

    </section>
</template>
<script>
    import Global from './../../../../../global';
    import HeaderEmployer from './../../../HeaderEmployer';
    import StarRating from 'vue-star-rating'
    export default {
       
        mixins: [Global],
      
        components : {
            HeaderEmployer,
            StarRating
        },
        data() {
            return {
                userData : [] ,
                applicant_lists : [] ,
                job_details : [],
                rating: '' ,
                rate_description : '',
                brain : '',
                buyIcon : 'fa-cart-shopping' ,
                buyText : ' Upgrade this job ad to see full info of applicants'

            }
        },
        beforeMount (){ 
            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                        this.userData = response.data.u
                        this.brain = response.data.c.brain
                    });
                } 
            }).catch((error) => {
                location.href = '/';
            });

            
            axios.post('api/applicants' , this.$route.query).then(response => {
               this.job_details = response.data.job_details
               this.applicant_lists = response.data.applicant_lists
            }).catch((error) => {
                location.href = '/';
            });
        },
        methods : {
            buy (){
                var me = this;
                let b = this.brain
                var button = document.querySelector('#submit-button');


                
                braintree.dropin.create({
                    authorization: b,
                    container: '#dropin-container'
                }, function (createErr, instancedrop) {
                    if(createErr == null){
                        me.buyText = "Pay Now"
                    }
                    button.addEventListener('click', function () {
                        instancedrop.requestPaymentMethod(function (err, payload) {
                            let array = {
                                nonce : payload.nonce ,
                                job_id :  me.$route.query.job
                            }
                            axios.post('/api/upgradeJob', array).then(response => {
                                console.log(response)
                               if(response.data.status == false){
                                    me.$toast.error('Something went wrong',{
                                        position:'top'
                                    }) 

                                    return false;
                               }

                              if(response.data.status == true ){
                                me.$toast.success('Success !',{
                                    position:'top'
                                }) 

                                location.reload();
                              }
                            
                            }).catch(error => console.log(error)); 
                         });
                });

                    
                });
            },
           
            hire (id , job_id) {
                let parent = this;
                this.$swal({
                    title: "Confirmation!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonColor: 'grey',
                    confirmButtonColor: "green",
                    confirmButtonText: "Mark as Hired"
                }).then(function(result){
                   if(result.isConfirmed){      
                        Global.methods.hire(id , job_id);   
                        let uData = parent.applicant_lists.find(x=>x.id == id)
                        uData.is_hired = 'Y'
                   }
                }, function(result) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (result.dismiss === 'cancel') { 
                       
                    } else {
                    throw dismiss;
                    }
                })   
            },

            setRating: function(rating){
               //Global.methods.rateApplicant(rating , job_id);  
               this.rating = rating 
            },
            rateApplicant (id) {
                let swal = this.$swal;
                let toast = this.$toast;
                let thisClass= this;
                let route = this.$route;
                Global.methods.rateApplicant(this.rating , id , this.$route.query.job);  
                this.$toast.success('Ratings Saved.')   

                swal({
                    title: "Add Model Review!",
                    type: "warning",
                    text : "",
                    html : `Maximum of 150 characters<textarea id="rate_description"  maxlength="150"  class="form-control">`,
                    showCancelButton: true,
                    cancelButtonText: "No Thanks",
                    cancelButtonColor: 'grey',
                    confirmButtonColor: "green",
                    confirmButtonText: "Submit",
                    preConfirm: () => {
                        let rate_description =  document.getElementById("rate_description").value
                        var withoutSpace = rate_description.replace(/ /g,"");
                        
                        if(withoutSpace.length > 150){
                            toast.error('150 characters only!.',{
                                position: "top",
                            })  
                            return false;
                        }
                    },
                }).then(function(result){
                   if(result.isConfirmed){      
                    let rate_description =  document.getElementById("rate_description").value
                    let res = Global.methods.rate_description(rate_description, id , route.query.job)
                    
                    res.then(function(data){
                        if(data.status == false){
                            toast.error('Something went wrong.',{
                                position: "top",
                            })  
                            
                        } else{

                            toast.success('Saved!',{
                                position: "top",
                            })   
                        }
                    })

                   }
                }, function(result) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (result.dismiss === 'cancel') { 
                       
                    } else {
                    throw dismiss;
                    }
                })   

            } ,    
            
            mounted(){
                document.getElementById('rate_description').onkeyup = function () {
                document.getElementById('rating_desc_count').innerHTML = "Characters left: " + (150 - this.value.length);
                };
            }
           
        }
    }
</script>
<style>
  svg { 
    position: inherit !important;
  }
 .vue-star-rating {
    display: inline !important;
 }

.purchase-enabled-false {
    font-size: 10px;
    border-color: none;
    cursor: not-allowed !important;
 }
 .optional_P {
    font-size: 15px;
    margin-bottom: 2rem !important;
    color: black !important;
 }
 .rate-header {
    font-size: 25px;
    font-weight: bold;
    color : black !important;
    font-family: var(--bs-body-font-family);
 }

.rating-bar {
    align-items: center;
}
.rating-bar > span:before {
    color: #c7c5c5;
    cursor:pointer;
    font-size:1.5em;
}
.rating-bar:hover > span:before {
    color: var(--theme);
}

.rating-bar > span:hover ~ span:before {
    color: #c7c5c5;
}


</style>