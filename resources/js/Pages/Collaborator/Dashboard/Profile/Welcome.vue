<template>
    <section id="dashboard-perfil-header" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-4 col-md-4 text-left">
                <h1 class="font-bold text-3xl text-muted">Profile</h1>
            </div>
        </div>
        <!--END Header section-->
        <div class="perfil-text row my-3.5 mx-1.5 lg:mx-0">
            <div class="col-12">
                <p>Here you can find and edit all the relevant information about yourself at any time
                    and your business.
                </p>
                <p class="mt-2">
                    Fill in everything as soon as possible so that we can collaborate in the best possible way.
                </p>
            </div>
        </div>
         <!-- Content section-->
        <div class="perfil-card row mx-1.5 lg:mx-0">
            <div class="perfil-card-body my-2.5 lg:my-0 col-12 w-full h-52 lg:h-1/5 rounded-xl shadow relative">
                <div class="row h-full rounded-xl realtive" id="body-perfil-info">
                    <div class="d-none d-lg-block col-lg-3 lg:h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');">
                        <div class="rounded-l-xl gradient absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Profile information</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Here you will find all the information related to your platform user
                            by HiCitty
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <Link :href="route('dashboard.profile.info')" class="btn btn-outline-orange m-auto py-0.5 px-6">Edit</Link>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
            <div class="perfil-card-body my-2.5 lg:my-0 col-12 w-full h-52 lg:h-1/5 rounded-xl shadow relative">
                <div class="row h-full rounded-xl" id="body-perfil-envio">
                    <div class="d-none d-lg-block col-lg-3 h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');">
                        <div class="rounded-l-xl gradient absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Shipping information</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Information necessary so that we can send the resources
                            what we offer you
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <button class="btn btn-outline-orange m-auto py-0.5 px-6">Edit</button>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
            <div class="perfil-card-body my-2.5 lg:my-0 col-12 w-full h-52 lg:h-1/5 rounded-xl shadow relative">
                <div class="row h-full rounded-xl" id="body-perfil-fiscal">
                    <div class="d-none d-lg-block col-lg-3 lg:h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');">
                        <div class="rounded-l-xl gradient absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Tax data</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Information necessary to accredit your business and be able to invoice as a professional
                            or company.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <button class="btn btn-outline-orange m-auto py-0.5 px-6">Edit</button>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
            <div class="perfil-card-body my-2.5 lg:my-0 col-12 w-full h-52 lg:h-1/5 rounded-xl shadow relative">
                <div class="row h-full rounded-xl" id="body-perfil-bancaria">
                    <div class="d-none d-lg-block col-lg-3 h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');">
                        <div class="rounded-l-xl gradient absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6  absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Bank information</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Information of the owner and IBAN of the account to be able to make the deposits
                            of your benefits.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <button class="btn btn-outline-orange m-auto py-0.5 px-6">Edit</button>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
        </div>
        <!-- END Content section-->
    </section>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import { Link } from '@inertiajs/inertia-vue3';
export default {
    layout:TemplateApp,
    components:{
        Link
    },
    created(){
        
    }
}
</script>
<style scoped>
.btn-outline-orange{
    border:2px solid #FF9C06;
    color:#FF9C06;
}
.btn-outline-orange:hover{
    border:2px solid #fac371;
    color:#a26b19;
}
.gradient{
    background: linear-gradient(100deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);
}
@media(min-width:1024px){
    .perfil-card{
        height:65vh;
    }
}
@media(max-width:1023px){
    #body-perfil-info{
        background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');
    }
    #body-perfil-envio{
        background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');
    }
    #body-perfil-fiscal{
        background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');
    }
    #body-perfil-bancaria{
        background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');
    }   
}
</style>