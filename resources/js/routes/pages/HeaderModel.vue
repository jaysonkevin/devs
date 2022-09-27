<template>
    <section>
        <!-- Navigation -->
        <nav v-if="uData.id != null" class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <!-- <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>

                <div class="container search-container mb-3 mt-2">
                    <input type="search"  @keyup.enter="searchJob" v-model="searchInput" placeholder="Search Job e.g Tshirt Model" aria-describedby="button-addon2" class="search-form-input">
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#model-header-nav" aria-controls="model-header-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="model-header-nav">                    
                    <ul class="navbar-nav ms-auto">
                        <a href="javascript:void(0)" @click="logout" class="">Logout</a>
                    </ul>
                </div>
            </div> -->
            <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>
    
                <a class="btn btn-xs" @click="logout"><i class="fa-solid fa-sign-out"  aria-hidden="true"></i> Logout </a>
            </div>
        </nav>
        <nav v-else class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <a class="navbar-brand" href="#">Freelance Model</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <router-link class="btn navigations  " to="/">Model</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="btn navigations " to="/employer/login">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class=" btn signup " to="/employer/register">Sign Up</router-link>
                        </li>
                        <router-view/>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
</template>
<script>
    export default {
        props : {
            uData : Object
        } ,
        data() {
			return {
				userData : this.uData ,
			}
		},
        methods : {
            logout () {
                axios.post('api/logout').then(response => {
                    localStorage.clear();
                    location.href = '/';
                }).catch((error) => {

                });
            } ,
        }
            
    }
</script>