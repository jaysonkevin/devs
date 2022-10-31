<template>
    <!-- Footer -->
	<footer class="text-center footer">
		<!-- Section: Links  -->
		<section class="">
			<div class="container section-footer text-center text-md-start mt-5">
			<!-- Grid row -->
			<div class="row mt-3">
				<!-- Grid column -->
				<div class="col-4 mx-auto mb-4">
				<!-- Links -->
				<h6 class="text-uppercase fw-bold mb-4">
					Useful Links
				</h6>
				<p>	
					<a class="footer-links" href="/aboutus">About Us</a>
				</p>
				<p>
					<a class="footer-links" href="/contactus">Contact Us</a>
				</p>
				<p>
					<a class="footer-links" href="/terms">Terms And Condition</a>
				</p>
			
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-4 mx-auto mb-4">
				<!-- Links -->
				<h6 class="text-uppercase fw-bold mb-4">
					Employer
				</h6>
				<p>
					<a class="footer-links" href="/pricing">Pricing</a>
				</p>
				<p>
					<a class="footer-links" href="/employerfaq">Employer FAQ</a>
				</p>
				<p>
					<a class="footer-links" href="/contactus">Contact Us</a>
				</p>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-4 mx-auto mb-4">
				<!-- Links -->
				<h6 class="text-uppercase fw-bold mb-4">
					Models
				</h6>
				<p>
					<a class="footer-links" href="/modelfaq">Model FAQ</a>
				</p>
				<p>
					<a class="footer-links" href="/contactus">Contact Us</a>
				</p>
		
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row -->
			</div>
			<router-view/>
		</section>
		<!-- Section: Links  -->

		<!-- Copyright -->
		<div class="text-center p-4 copyright" style="background-color: rgba(0, 0, 0, 0.05);">
			© {{currentDate}} Copyright:
		</div>
	<!-- Copyright -->
	</footer>
	<!-- Footer -->
</template>

<script >
  export default {
	data () {
		return {
			currentDate : ''
		}
	},
	mounted () {
		const current = new Date();
		this.currentDate = current.getFullYear()
	}
}
</script>

<style scoped>


    footer {
        position:static;
    }
    .footer-links {
        text-decoration: none;
        color: black;
    
    }

    p{
        margin-bottom: 1rem;
    }

    footer {
		margin-top: -2rem;
		background-color:inherit ;
	}

	.copyright {
		background-color: var(--theme) !important;
	}

	.section-footer {
		margin-top: 3rem;
	}
	.fw-bold{
		margin-top: 17px;
	}
	
</style>