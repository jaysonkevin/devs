<template>
    <HeaderEmployer :uData="userData"></HeaderEmployer>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center  parent ">
        <div class="col-12 col-md-12 col-lg-12">
            <p class="text-center header-pricing">Pay Only if You Need </p>
            <div class="row">
                <div class="col-md-4 pricing-div">
                    <div class="card">
                        <div class="card-body">
                            <p class="label-header text-center">Free Plan</p>
                            <p class="label-header-sub text-center"> Free 2 job posts per day </p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Access to 9 profiles per ad job
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-times'></i>Model Contact Details
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-times'></i>Model Gallery
                                </li>
                            </ul>
                        </div>
                        <router-link v-if="isLogged" class=" btn btn-warning " to="#">Active</router-link>
                        <router-link v-else class=" btn btn-theme " to="employer/login">Try Now</router-link>
                        <router-view />
                    </div>
                </div>
                <div class="col-md-4 pricing-div">
                    <div class="card">
                        <div class="card-body">
                            <p class="label-header text-center">1 Job Ad</p>
                            <p class="label-header-sub text-center">$29 per job post</p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Access to all applications received per job
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Model Contact Details
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Model Gallery
                                </li>
                            </ul>
                        </div>
                       
                        <router-link v-if="isLogged" class=" btn btn-theme " to="/checkout/1/29">Buy</router-link>
                        <router-link v-else class=" btn btn-theme " to="/employer/login">Buy</router-link>
                        <router-view />
                    </div>
                </div>
                <div class="col-md-4 pricing-div">
                    <div class="card">
                        <div class="card-body">
                            <p class="label-header text-center">5 Job Posts</p>
                            <p class="label-header-sub text-center">$20 per job post</p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Access to all applications received per job
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Model Contact Details
                                </li>
                                <li class="list-group-item pricing-li">
                                    <i class='fas fa-check'></i>Model Gallery
                                </li>
                            </ul>
                        </div>
                        <router-link v-if="isLogged" class=" btn btn-theme " to="/checkout/2/100">Buy</router-link>
                        <router-link v-else class=" btn btn-theme " to="/employer/login">Buy</router-link>
                        <router-view />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12" v-if="showpayment">
           <div class="row">
                <div class="col-lg-6">
                    <p>{{userData.firstname}} {{userData.lastname}}</p>
                    <p>{{userData.email}}</p>
                    <p>{{price}}</p>
                </div>
                <div id="dropin-container" class="col-lg-6">

                   
                </div>
               <div class="col-offset-6 col-lg-6 pull-right">
                    <a class="btn btn-md btn-theme"  >Pay</a>
               </div>
                
           </div>
        </div>
    </div>
   
</div>
</template>
<script defer>
    import HeaderEmployer from './routes/pages/HeaderEmployer.vue';
    //var button = document.getElementById('submit-button');
    export default {
        components : {
			HeaderEmployer
		},
       
        data(){
            return {
                userData : '' ,
                isLogged : false,
                brain : '' ,
                price  : '',
                showpayment : false 
            }
        },
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
    }
</script>

<style>
	.parent{
        margin-top: 10%;
    }
    .header-pricing{
        font-size: larger;
        font-weight: bolder;
    }

    
    .label-header-sub {
        border: 0;
        font-size: 100%;
        font-style: inherit;
        font-weight: inherit;
        outline: 0;
        vertical-align: baseline;
    }


    .pricing {
        align-items: center;
		padding: 0;
		text-align: center;
    }

    .pricing-li {
        font-weight: lighter;
    }

    .label-header{
        font-weight: bolder;
    }
    
	.list-group-item{
		display: flex;
	}
	.list-group {
		--bs-list-group-border-color: none;
		font-weight: bold;
	}

    .fa-times {
        color: red !important;
		margin-right: 1rem;
    }
    .fas{
		color: var(--theme);
		margin-right: 1rem;
	}

    .pricing-div {
        margin-bottom: 2rem;
    }

</style>