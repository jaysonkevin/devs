<template>
    <div id="ratings-tab"  class="tab-pane fade">
        <div class="card mb-2"  v-for="(item , index) in ratings.data" :key="item" :value="item.id">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <div class="col-sm-3 ">
                                <img 
                                :src="item.profile_image" 
                                alt="avatar" class="rounded-circle profImg img-fluid" style="width: 100px;height: 100px;"/>
                                <p>{{item.company_name.company_display}} <p><strong>{{item.created_at_notif}}</strong></p></p>
                            </div>
                            <div class="col-sm-3 ">
                                <StarRating 
                                        v-bind:show-rating= false
                                        active-color="#42b883"
                                        v-bind:star-size="18"
                                        :rating="item.rating"
                                        :round-start-rating="false"
                                        :read-only=true
                                ></StarRating>
                            </div>
                        </div>
                        
                        <div class="emp_rating_desc">
                            <p class="p_textarea">
                              {{item.rating_description}}
                            </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <div class="card-footer">
            <Pagination class="pull-right" :data="ratings" @pagination-change-page="getResults"></Pagination>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import Pagination from '../../../../../../../node_modules/laravel-vue-pagination';
    import StarRating from 'vue-star-rating'
    export default {
        props : ['userId','getRatingsData'],
        data(){
            return {
                userId : this.$props.userId ,
                ratings : []
            }
        },
        components: {
            Pagination,
            StarRating
        },
        methods : {
            getResults(page = 1) {
              
                axios.post('api/getRatingsData?page='+page).then(response => {
                    console.log(response.data)
                    this.ratings = response.data.ratings;
                }).catch((error) => { });
            } ,
        },
        watch: {
            getRatingsData() {
                if(this.getRatingsData){
                    this.getResults()
                }
            }
        },
    }
</script>