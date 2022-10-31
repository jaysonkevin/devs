<template> 
    <nav v-if="uData" class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
        <div class="container">
            <router-link :to="'/employer/home/'" ><img :src="'/image/logo.png'" class="logo-img"  height="150" style="margin-bottom:-80px;"  /></router-link>
            <div class="nav-data">
               
                <a href="/pricing" class="btn btn-xs">Pricing</a>
                <a href="#">
                    <i v-if="notif >0 "  @click="showNotifs" class="fa-solid px-1 fa-bell  position-relative">
                        <span class="position-absolute top-0 start-50 translate-middle badge notifnumber rounded-pill bg-danger">{{notif}}</span>
                        <ul v-if="showNotif_" class="dropdown-menu show notifList" >
                            
                                <h5 class="notification-header">Notifications <i class="fa fa-arrow"></i></h5>
                                <hr class="hr hr-blurry" />
                                <li class="notif-listing "  v-for="(item , index) in notifList" :key="item" >
                                    <router-link :to="'/employer/home/applicants?notif=true&job=' + item.id"  >
                                        <div class="txt">
                                            <b>{{item.applicants}}</b> <span v-if="item.applicants == 1">applicant</span> <span v-else>applicants</span>
                                            applied to <b>{{item.job_title}}</b>
                                        </div>
                                        <div class="txt sub">{{item.created_at}}</div>
                                    </router-link>        
                                    <hr class="hr hr-blurry" />
                                </li> 
                                <li v-if="pagination.currentPage != pagination.lastPage" class="  text-center">
                                    <a href="javascript:void(0);" @click="viewMoreNotif" class="btn btn-xs btn-theme">view more</a>
                                </li> 
                        
                        </ul>
                        <router-view/>
                    </i>
                    <i v-else class="fa-solid px-1 fa-bell  position-relative">
                        <span class="position-absolute top-0 start-50 translate-middle badge notifnumber rounded-pill bg-danger">0</span>
                    </i>
                </a>
            
                <a class="btn btn-xs" @click="logout"><i class="fa-solid fa-sign-out"  aria-hidden="true"></i> Logout </a>
            </div>
        </div>
    </nav>
    <!-- Navigation LOGGED OUT -->
    <nav v-else class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
        <div class="container">
            <router-link :to="'/employer/'" ><img :src="'/image/logo.png'" class="logo-img"  height="150" style="margin-bottom:-80px;"  /></router-link>
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

</template>

<style>
   
    .notification-header{
        padding-left:10px;
    }
    .notif-listing{
        padding-left: 10px;
        background-color: #F4F4F4;
        transition: 0.5s;
    }

    .profCont{
        padding-left: 15px;
    }

    .txt{
        vertical-align: top;
        font-size: 14px;
        margin-bottom:5px;
    }

    .sub{
       
        font-size: 8px;
        color: var(--bs-body-color);
    }

    a , a:hover{
        text-decoration: none;
        color: var(--bs-body-color);
    }


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

    .notifnumber{
        font-size: 9px;
    }

    .nav-data {
        font-size:15px;
    }

    .fa-sign-out{
        margin-right: -2px;
    }

    .notifList{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-left:-185px;
        width: 250px; 
        height: 250px; 
        overflow: auto;
        transition: cubic-bezier(0.075, 0.82, 0.165, 1);
        
    }

    .notifList::-webkit-scrollbar
    {
        width: 10px;
        background-color: #F5F5F5;
        border-radius: 5px
    }

    .notifList::-webkit-scrollbar-thumb
    {
        background-color: var(--theme);
        border: 2px solid var(--theme);
        border-radius: 5px
    }

   
    a.btn.btn-xs:hover {
        background: #F5F5F5 !important;
        border-color:var(--theme) !important;
    }


</style>

<script>
    export default {
        props : {
            uData : Object
        } ,
		data() {
			return {
				userData : this.uData ,
                notif : 0 ,
                notifList : [], 
                pagination : [] ,
                showNotif_ : false
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
            showNotifs () {
                this.showNotif_ = !this.showNotif_ 
                if(this.notif > 0){
                  
                    axios.get('api/newapplicantsList').then(response => {
                        if(response.data.status == true){
                            this.notifList = response.data.list
                          
                            //pagination
                            this.pagination  = response.data.pagination
                        }
                    });
                }
            } ,
            viewMoreNotif (e) {
               
                axios.get('api/newapplicantsList?page='+(this.pagination.currentPage+1)).then(response => {
                    if(response.data.status == true){
                        this.pagination  = response.data.pagination
                        var me = this.notifList;
                        response.data.list.forEach(function(item) {
                            
                            me.push({
                                "job_title" : item.job_title ,
                                "applicants" : item.applicants ,
                                "created_at" : item.created_at,
                                "id" : item.id
                            })
                        });
                    }
                });

                e.stopPropagation();
            }
        },
        mounted() {
            axios.get('api/newapplicants').then(response => {
                if(response.data.status == true){
                    this.notif = response.data.notif
                }
            });
            
        }
	}
</script>