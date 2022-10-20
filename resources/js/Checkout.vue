<template>
   <section >
    <div class="container">
        <div class="container text-center" >
            <div class="py-5 text-center">
                <h2>Checkout form</h2>
            </div>
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"> <strong>{{cartname}}</strong> </h6>
                    </div>
                    <span class="text-muted">$ {{price}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$ {{price}}</strong>
                </li>
            </ul>
            <div id="dropin-container"></div>
            <div class="d-grid gap-2">
                <a  @click="buy" id="submit-button" class="btn btn-md btn-theme" >Pay Now</a>
            </div>
        </div>
       
    </div>
   </section>
</template>
<script>
    export default {
        methods :{
            buy (){
                
                let id = this.$route.params.id;
                if(['1','2'].includes(id) == false){
                    this.$toast.error('Something went wrong',{
                        position:'top'
                    });
                    return false
                }
                
                var me = this;
                let b = this.brain
                var button = document.querySelector('#submit-button');
                
                braintree.dropin.create({
                    authorization: b,
                    container: '#dropin-container'
                }, function (createErr, instancedrop) {
                    button.addEventListener('click', function () {
                        instancedrop.requestPaymentMethod(function (err, payload) {
                            let array = {
                                id : id , 
                                nonce : payload.nonce
                            }
                            axios.post('/api/checkout', array).then(response => {
                                console.log(response)
                               if(response.data.status == false){
                                    me.$toast.error('Something went wrong',{
                                        position:'top'
                                    }) 

                                    return false;
                               }

                              if(response.data.status == true ){
                                me.$toast.success('Job Post Balance Added !',{
                                    position:'top'
                                }) 

                                location.href = '/employer/home';
                              }
                            
                            }).catch(error => console.log(error)); 
                         });
                });

                    
                });
            }
        },
        data(){
        
            return {
                userData : '' ,
                isLogged : false,
                brain : '' ,
                price  : '',
                showpayment : false ,
                cartname  : ''
               
            }
        } ,
        beforeCreate (){ 
            axios.get('api/_c_').then(response => {
                if(response.data.has_error == false){
                    axios.get('api/cUL').then(response => {
                        this.userData = response.data.u
                        this.brain = response.data.c.brain
                        this.isLogged = true;
                    });
                } 
            }).catch((error) => {
                this.isLogged = false;
            });
           
        },
        mounted(){
            var $this = this; 
            let id = this.$route.params.id;
            if(id == 1){
                $this.price = 29;
                $this.cartname = "1 Job Ad";
            } else if(id == 2){
                $this.price = 100;
                $this.cartname = "5 Job Ads";
            }else{
                $this.price = 99999999;
                $this.cartname = "Something went wrong!";
                this.$toast.error('Something went wrong',{
                    position:'top'
                }) 
            }
        }
    }
</script>
<style>
.panel-title {display: inline;font-weight: bold;}
.checkbox.pull-right { margin: 0; }
.pl-ziro { padding-left: 0px; }

  /* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {
  }
  
  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {
   
  }

  /* Medium devices (landscape tablets, 768px and up) */
  @media only screen and (min-width: 768px) {
    .container{
        width:60%;
    }
  }

  /* Large devices (laptops/desktops, 992px and up) */
  @media only screen and (min-width: 992px) {
    .container{
        width:60%;
    }

  }

  /* Extra large devices (large laptops and desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {
    .container{
        width:60%;
    }

  }



</style>