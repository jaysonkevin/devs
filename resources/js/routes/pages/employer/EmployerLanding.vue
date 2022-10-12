<template>


	<HeaderEmployer></HeaderEmployer>

    <div class="container-fluid home-view">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>Join us and search for your next top model!</h1>
		</div>
	</div>


    <div class="container home home-view2">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<img :src="'/image/landing-image.jpg'" class="rounded homepage-image" style="height:350px" />
				</div>
				<div class="col-lg-8 col-md-8 col-xs-12 ">
					<h4 class="home-desc">We help you find models for your business promotions.</h4>
					<ul class="list-group" >
						<li class="list-group-item"> <i class='fas fa-check-circle'></i>  Free Registration</li>
						<li class="list-group-item"> <i class='fas fa-check-circle'></i> Publish your ad</li>
						<li class="list-group-item"> <i class='fas fa-check-circle'></i> Review Applications </li>
                        <li class="list-group-item"> <i class='fas fa-check-circle'></i> Hire </li>
						<li class="list-group-item"> <router-link class=" btn signup " to="/employer/register"><i class="fa-solid fa-search"></i> Find your candidates now!</router-link></li>
					</ul>
					
					<router-view/>
				</div>
			</div>
		</div>
	</div>

    
    <div class="container pricing ">
		<div class="container">
            <h3>Try Our Free Service and Pay Only if You Need </h3>
			<div class="row">

                <div class="col-sm-4 pricing-div">
                    <div class="card">
                       <div class="card-body">
                            <p class="label-header">Free Plan</p>
                            <p class="label-header-sub"> Free 2 job posts per day </p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Access to 9 profiles per ad job</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-times'></i>Model Contact Details</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-times'></i>Model Gallery</li>
                            </ul>
                       </div>
                        <router-link class=" btn signup " to="/employer/register"> Try now!</router-link>
                        <router-view/>
                    </div>
                </div>
                <div class="col-md-4 pricing-div">
                    <div class="card">
                       <div class="card-body">
                            <p class="label-header">1 Job Ad</p>
                            <p class="label-header-sub">$29 per job post</p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Access to all applications received per job</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Model Contact Details</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Model Gallery</li>
                            </ul>
                       </div>
                        <router-link class=" btn signup " to="/employer/register">Buy</router-link>
                        <router-view/>
                    </div>
                </div>
                <div class="col-md-4 pricing-div">
                    <div class="card">
                       <div class="card-body">
                            <p class="label-header">5 Job Posts</p>
                            <p class="label-header-sub">$20 per job post</p>
                            <ul class="list-group">
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Access to all applications received per job</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Model Contact Details</li>
                                <li class="list-group-item pricing-li"><i class='fas fa-check'></i>Model Gallery</li>
                            </ul>
                          
                       </div>
                        <router-link class=" btn signup " to="/employer/register">Buy</router-link>
                        <router-view/>
                    </div>
                   
                </div>
				
			</div>
		</div>
	</div>
	<Footer></Footer>
</template>

<script>
	import HeaderEmployer from './../HeaderEmployer';
	import Footer from '../../../Footer.vue';
	export default {
		components : {
			HeaderEmployer,
			Footer
		}
	}
</script>

<style scoped>

    .pricing-div {
        margin-bottom: 2rem;
    }
	.btn {
		font-size: 18px;
		font-family: var(--bs-font-sans-serif);
		font-weight: bolder;
	}

    .pricing {
        align-items: center;
		padding: 0;
		text-align: center;
    }

	.home-view{
		height: 150px;
		margin-top: 7%;
		align-items: center;
		padding: 2;
		text-align: center;
	}

    .pricing-li {
        font-weight: lighter;
    }

    .label-header{
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



	h1 {
		font-family: var(--bs-font-sans-serif);
		font-weight: bolder;
		font-size: xxx-large;
	}



	h3 {
		font-family: var(--bs-font-sans-serif);
		margin-bottom: 1rem;
		font-size: 30px;
	}

	h5 {
		display: flex;
	}

	.p {
		display: flex;
	}

	/* Extra small devices (phones, 600px and down) */
	@media only screen and (max-width: 600px) {
		h1 {
			font-size: xx-large;
		}

		.p {
			display: none;
		}
		.employer-text{
			margin-top: -2rem;
		}
	}

	.home-desc {
		display: flex;
	}
	.home-header{
		margin-bottom: 3rem;
	}

	.rounded {		
		max-width: 100%;
		vertical-align: middle;
	}

	.list-group-item{
		display: flex;
	}
	.list-group {
		--bs-list-group-border-color: none;
		font-weight: bold;
	}
	.fas{
		color: var(--theme);
		margin-right: 1rem;
	}

    .fa-times {
        color: red !important;
		margin-right: 1rem;
    }

	.navbar-toggler {
		color : var(--theme) !important;
	}

	.home {
		margin-bottom: 8%;
		background-color: #fff;
	}

	body {
		background-color: #fff;
	}

	.fa-lg {
		font-size: 1.25em;
		line-height: 1.01em;
		vertical-align: -0.075em;
		color: var(--theme);
		margin-right: 1rem;
	}

	.fa-lg-star {
		font-size: 1.25em;
		line-height: 1.01em;
		vertical-align: -0.075em;
		color: var(--bs-yellow);
		margin-right: 1rem;
	}

	.fa-lg-sign{
		font-size: 1.25em;
		line-height: 1.01em;
		vertical-align: -0.075em;
		color: var(--bs-blue);
		margin-right: 1rem;
	}



</style>