<template>
    <nav id="collaborator-sidebar" class="fixed z-30 w-3/4 md:w-1/5 text-white bg-collaborator h-screen rounded-r-3xl flex flex-column overflow-auto">
        <div class="nav-logo flex flex-row">
            <i class="fas fa-times sidebarCollapse text-white cursor-pointer h-12 mt-8 w-12 mx-6 text-xl"></i>
            <img class="w-24 md:w-36 mr-auto grow mt-3.5 lg:mx-auto lg:mt-12" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
        </div>
        <ul class="list-unstyled p-4 my-auto">  
            <li class="mb-3.5">
                <Link :href="route('collaborator.dashboard.home')" class="text-base" :class="{'sidebar-active':this.$page.url=='/tablero'}">
                    <i class="fas fa-home mr-1 text-white"  :class="{'sidebar-active':this.$page.url=='/tablero'}"></i>
                    Start
                </Link>
            </li>
            <li class="mb-3.5">
                <a href="#" class="text-base">
                    <i class="fas fa-building mr-1 text-white"></i>
                    Accommodation management
                </a>
            </li>
            <li class="mb-3.5">
                <a href="#sub-recursos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <i class="fas fa-file text-white mr-2"></i> Means</a>
                <ul class="collapse list-unstyled pl-4" id="sub-recursos">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a href="#sub-ventas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <i class="fas fa-chart-bar text-white mr-2"></i> Sales</a>
                <ul class="collapse list-unstyled pl-4" id="sub-ventas">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <Link :href="route('collaborator.dashboard.profile')" data-toggle="collapse" 
                    aria-expanded="false" class="dropdown-toggle text-base"  
                    :class="{'sidebar-active':routesProfile}"
                >
                    <i class="fas fa-user text-white mr-2" :class="{'sidebar-active':routesProfile}"></i> 
                    Profile settings
                </Link>
                <ul class="collapse list-unstyled pl-8" :class="{'show':routesProfile}" id="sub-perfil">
                    <li>
                        <a :href="route('dashboard.profile.info')" class="text-sm my-2" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-informacion'}">
                            <i class="fas fa-id-card text-white mr-2" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-informacion'}"></i>Profile Info.
                        </a>       
                    </li>
                    <li>
                        <a href="#" class="text-sm my-2">
                            <i class="fas fa-file-alt text-white ml-1 mr-2"></i>Tax data
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm my-2">
                            <i class="fas fa-credit-card text-white mr-2"></i>Bank information
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm my-2">
                            <i class="fas fa-truck text-white mr-0.5"></i> Shipping information
                        </a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a :href="route('logout')" class="text-base">
                    <i class="fas fa-power-off mr-1 text-white"></i>
                    Sign off
                </a>
            </li>
        </ul>
        <div class="nav-info text-center my-auto">
            <h1 class="text-2xl font-weight-bolder text-white">?</h1>
            <p class="text-base text-white">Need help?</p>
            <p class="text-sm text-white">
                You will find specialized attention<br>
                calling the following phone:
            </p>
            <p class="text-sm text-white"><i class="fas fa-phone-alt mr-1 text-white"></i> (+34) 722 193 903</p>    
            <button class="btn rounded-lg text-white border-solid border border-white mx-auto py-1 my-2" data-toggle="modal" data-target="#feedback">
                <i class="fas fa-comment-dots text-white mr-1"></i>Give us feedback!
            </button>
        </div>
    </nav>
    <!-- Central Modal Small -->
    <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mx-auto">
                <div class="modal-body p-0">
                    <div class="bg-collaborator-orange h-14 pt-3 px-4 rounded-t-xl">
                        <p class="text-white text-2xl font-bold"><i class="fas fa-comment-dots text-white mr-1"></i>¡Give us feedback!</p>
                    </div>
                    <p class="px-4 my-2 text-sm">
                        Have you found a bug? Is there a function that you miss or need?
                        Do you have any suggestion? Whatever you have to tell us for sure
                        that helps us improve your experience, so don't hold back.
                    </p>
                    <div class="mt-1 px-4">
                        <textarea class="border w-100 rounded h-36 col-form-input" placeholder="Write your feedback here..."></textarea>
                    </div>
                    <div class="mb-3.5 mt-1 flex">
                        <button class="btn rounded bg-collaborator-orange text-white ml-auto mr-4 px-4 py-1">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Central Modal Small -->
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
	components:{
        Link
    },
    computed:{
        routesProfile(){
            let url = this.$page.url;
            let route1 = url.includes('tablero/perfil')
            let route2 = url.includes('tablero/perfil-informacion')
            console.log(url)
            console.log(route1)
            console.log(route2)
            if(route1 || route2){
                return true
            }
            
        }
    }
}
</script>
<style scoped>
nav::-webkit-scrollbar {display: none;}
.sidebar-active{
    color:#000 !important;
}
.bg-collaborator-orange{
    background-color: #FF9C06;
}
@media (min-width: 1024px){
    .nav-logo i{
        display: none;
    }
}

</style>