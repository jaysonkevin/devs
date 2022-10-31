<template>
    <section>
        <!-- Navigation -->
        <nav v-if="uData.id != null" class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <router-link :to="'/model'" ><img :src="'/image/logo.png'" class="logo-img" height="150" style="margin-bottom:-80px;"  /></router-link>
                <div class="nav-data">
                    <a href="#">
                        <i v-if="notif > 0 "  @click="showNotifs" class="fa-solid px-1 fa-bell  position-relative">
                            <span class="position-absolute top-0 start-50 translate-middle badge notifnumber rounded-pill bg-danger">{{notif}}</span>
                            <ul v-if="showNotif_" class="dropdown-menu show notifList" >
                                    <h5 class="notification-header">Notifications <i class="fa fa-arrow"></i></h5>
                                    <hr class="hr hr-blurry" />
                                    <li class="notif-listing "  v-for="(item , index) in notifList.data" :key="item" >
                                        <router-link :to="'/model/notification/' + item.id" >
                                            <div class="txt">
                                                <b>{{item.company_name.company_display}}</b>  rated you {{item.rating}} star 
                                            </div>
                                            <div class="txt sub">{{item.created_at_notif}}</div>
                                        </router-link>        
                                        <hr class="hr hr-blurry" />
                                    </li> 
                                    <li v-if="currentPage != lastPage" class="text-center">
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
        <nav v-else class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
            <div class="container">
                <router-link :to="'/'" ><img :src="'/image/logo.png'" height="150" style="margin-bottom:-80px;"  /></router-link>
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


<style>
   
    .notification-header{
        padding-left:10px;
    }
    .notif-listing{
        padding-left: 10px;
        background-color: #F4F4F4;
        transition: 0.5s;
        margin-top: -15px;
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
                showNotif_ : false,
                notifList : [],
                notif : 0 ,
                currentPage : '' ,
                lastPage : ''
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
                  
                    axios.get('api/getNotifListM').then(response => {
                       
                        if(response.data.status == true){
                            this.notifList = response.data.notif
                          
                            //pagination
                            this.currentPage =  response.data.notif.current_page
                            this.lastPage =  response.data.notif.last_page      
                            
                        }
                    });
                }
            } ,

            viewMoreNotif (e) {
               
                axios.get('api/getNotifListM?page='+(this.currentPage+1)).then(response => {
                    if(response.data.status == true){

                        this.currentPage =  response.data.notif.current_page
                        this.lastPage =  response.data.notif.last_page      
                        var me = this.notifList.data;
                        
                        response.data.notif.data.forEach(function(item) {
                           
                            me.push({
                              "company_name" : item.company_name ,
                              "created_at_notif" : item.created_at_notif,
                              "is_seen" : item.is_seen,
                              "rated_by" : item.rated_by,
                              "rating" : item.rating,
                              "rating_description" : item.rating_description,
                              "user_id" : item.user_id,
                              "id" : item.id
                            })
                        });
                    }
                });

                e.stopPropagation();
            }
        },
        beforeCreate() {
            axios.get('api/mNotification').then(response => {
                if(response.data.status == true){
                    this.notif = response.data.notif
                }
            });
        }
            
    }
</script>