<template>
    <div id="currenct_subscription" class="tab-pane fade ">
        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr class="thead">
                    <th  scope="col ">Subcription Name </th>
                    <th  scope="col">Price</th>
                    <th  scope="col">Date Created</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="subscriptionData.data" v-for="(item , index) in subscriptionData.data" :key="item" :value="item.id"  scope="row">
                    <td>{{item.name}}</td>
                    <td>{{item.price}}</td>
                    <td>{{item.created_at}}</td>
                </tr>   

                <tr v-else  scope="row">
                    <td col="3">No Subcription</td>
                </tr>   
            </tbody>
        </table>
        </div>
        <Pagination class="pull-right" :data="subscriptionData" @pagination-change-page="getSubscriptionHistory"> </Pagination>
    </div>
</template>
<script>
import Pagination from 'laravel-vue-pagination';
export default {
    props: ['getSubscription'],
    components : {
        Pagination
    },  
    data(){
        return {
            subscriptionData : []
        }
    },
    methods : {
        async getSubscriptionHistory (page = 1){
            if(this.getSubscription){
                await axios.post('api/subscriptions?page='+page).then(response => {
                    this.subscriptionData = response.data;
                }).catch((error) => {
                    
                });
            }
        } ,
    },
    watch: {
        //PROP NAME
        getSubscription() {
            this.getSubscriptionHistory()
        }
    },
}
</script>