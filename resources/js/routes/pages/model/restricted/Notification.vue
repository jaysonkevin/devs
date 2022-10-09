<template>
   <section>
         <HeaderModel :uData="userData"></HeaderModel>
        
         <div class="container  py-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="col">
                                <div class="col-sm-3 ">
                                    <img 
                                    :src="image" 
                                    alt="avatar" class="rounded-circle profImg img-fluid" style="width: 100px;height: 100px;"/>
                                    <p>JAyson Kevin Montemayor Company <p><strong>2022-09-03</strong></p></p>
                                </div>
                                <div class="col-sm-3 ">
                                    <StarRating 
                                            v-bind:show-rating= false
                                            active-color="#ffc107"
                                            v-bind:star-size="20"
                                            :rating="2"
                                            :round-start-rating="false"
                                            :read-only=true
                                    ></StarRating>
                                </div>
                            </div>
                          
                            <div class="emp_rating_desc">
                                <p class="p_textarea">
                                    5.5 sale with cashback worth 700+ pesos! My Fika neoflam Finally arrived.. 
                                    thank you so much SM store,safe and maayos silang dumating,.speed lang din talaga nadeliver😊 order pa ako para makumpleto ko wag puro fangirl
                                  
                                </p>
                            </div>
                        </div>
                       
                       
                    </div>
                </div>
            </div>

            <div class="card mt-2 ">
                <div class="card-body">
                    <h3 class="mb-5 ">Rate Employer</h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <StarRating 
                                    v-bind:show-rating= false
                                    active-color="#ffc107"
                                    v-bind:star-size="30"
                                    :rating="rating"
                                    :round-start-rating="false"
                                    @update:rating ="setRating"
                            ></StarRating>
                            <div class="mt-4">
                                <textarea class="form-control" v-model="rating_description" placeholder="Write a review (optional)"></textarea>
                            </div>
                            <div class="mt-4">
                                <a href="javascript:void(0);" class="btn btn-theme">Submit</a>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
         </div>
   </section>
</template>
<style>
    .vue-star-rating {
        display: inline-flex !important;
        position: absolute !important;
        margin-top: -0.2rem !important;
        z-index: 999999999;
    }
    .emp_rating_desc{
        display: inline-flex;
        margin-top: 1rem !important;
        margin-left: 2px !important;
    }
</style>
<script>
    import HeaderModel from '../../HeaderModel.vue';
    import StarRating from 'vue-star-rating'
    export default {
        components: {
            HeaderModel,
            StarRating
        },
        data (){
            return {
                userData : [],
                image : 'http://192.168.1.5/storage/photo/11662742460-ivnu/1664380807.jpg',
                rating:0 ,
                rating_description : ''
            }
        } ,
        methods : {
            setRating (rating){
                this.rating = rating
            }
        },
        beforeCreate () {
            axios.get('api/cUL').then(response => {               
               this.userData = response.data.u

           }).catch((error) => {
                location.href = '/';
              
           });
        }
    }
</script>