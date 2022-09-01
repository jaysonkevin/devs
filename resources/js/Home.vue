<template>
  	<!-- Navigation -->
	<nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
		<div class="container">
			<a class="navbar-brand" href="#">Freelance Model</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item active">
						<router-link class="btn navigations  " to="/employer">Employer</router-link>
					</li>
					<li class="nav-item">
						<router-link class="btn navigations " to="/model/login">Login</router-link>
					</li>
					<li class="nav-item">
						<router-link class=" btn signup " to="/model/register">Sign Up</router-link>
					</li>
					
					<router-view/>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container-fluid home-view">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>The Job Board for Aspiring Models in the World.</h1>
		</div>
	</div>

	<div class="container home home-view2">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<img :src="'/image/landing-image.jpg'" class="rounded homepage-image" style="height:350px" />
				</div>
				<div class="col-lg-8 col-md-8 col-xs-12 ">
					<h4 class="home-desc">We help you find your dream job in fashioning.</h4>
					<p class="home-desc">Make your resume visible to thousands of companies in our job board</p>

					<ul class="list-group" >
						<li class="list-group-item"><i class='fas fa-check-circle'></i> Free Registration</li>
						<li class="list-group-item"> <i class='fas fa-check-circle'></i>Complete your profile information</li>
						<li class="list-group-item"> <i class='fas fa-check-circle'></i> New Job Offers Everyday</li>
						<li class="list-group-item"> <router-link class=" btn signup " to="/model/register"><i class="fa-solid fa-star"></i> Sign Up Now, and become a model !</router-link></li>
					</ul>
					
					<router-view/>
				</div>
			</div>
		</div>
	</div>

	
	  
	<div class="container home home-view2">
		<h3 class="home-header">Post Job Offers Easily</h3>
		<div class="container-fluid employer-text">
			<div class="row align-items-start">
				<div class="col-4 align-items-start  col-xs-12">
					<div class="col">
						<h5> Post Your Vacancy</h5>
						<p class="p">Create a job post easily. </p>
					</div>
					
				</div>
				<div class="col-4 col-xs-12 align-items-start">
					<div class="col">
						<h5>Check Models Application</h5>
						<p class="p">Select the best candidates based on your requirements.</p>
					</div>
					
				</div>
				<div class="col-4 col-xs-12 align-items-start">
					<div class="col">
						<h5>Hire Now</h5>  
						<p class="p">Hire your best candidates to join your company</p>
					</div>
				</div>
				<div class="col-sm-12 mt-3 col-xs-12">
					<router-link class=" btn signup " to="/employer/register"><i class="fa-solid fa-magnifying-glass"></i> Find A Model Now</router-link>
				</div>

				<router-view/>
			</div>
		</div>
	</div>

	<Footer></Footer>


</template>
<script >
  import Footer from './Footer.vue'
  export default {
	data () {
		return {
			currentDate : ''
		}
	},
	components : {
		Footer
	},
	mounted () {
		const current = new Date();
		this.currentDate = current.getFullYear()
	},
	created(){
		
	}
}
</script>

<style scoped>
	.navigations {
		text-align: center;
		cursor: pointer;
		outline: none;
		color:var(--bs-black);
		border: none;
		text-decoration: none;	
		margin-right: 1px;	
	}
	.navigations:hover {color:var(--theme)}
	.signup {
		color: var(--bs-white) !important;
    	border-color: var(--theme) !important;
		background-color: var(--theme) !important ;
	}

	.btn {
		font-size: 18px;
		font-family: var(--bs-font-sans-serif);
		font-weight: bolder;
	}

	.home-view{
		height: 150px;
		margin-top: 7%;
		align-items: center;
		padding: 2;
		text-align: center;
		
	}

	.home-view2{
		align-items: center;
		padding: 0;
		text-align: center;
		
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