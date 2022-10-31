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
                                    <p>{{rated_by}} <p><strong>{{rated_date}} </strong></p></p>
                                </div>
                                <div class="col-sm-3 ">
                                    <StarRating 
                                            v-bind:show-rating= false
                                            active-color="#ffc107"
                                            v-bind:star-size="25"
                                            :rating="rating"
                                            :round-start-rating="false"
                                            :read-only=true
                                    ></StarRating>
                                </div>
                            </div>
                          
                            <div class="emp_rating_desc">
                                <p class="p_textarea">
                                  {{rating_description}}
                                </p>
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
                rating_description : '',
                rated_by : '',
                rated_date : ''
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

           axios.post("api/notification?id="+this.$route.params.id).then(response => {
                this.rating_description = response.data.data.rating_description
                this.rating = response.data.data.rating
                this.image = response.data.data.profile_image
                this.rated_by = response.data.data.rated_by_name.company_display
                this.rated_date = response.data.data.rated_date
           })
           
        }
    }
</script>