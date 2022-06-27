<template>
    <section id="dashboard-ventas-header" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-4 col-md-4 text-left">
                <h1 class="font-bold text-3xl text-muted">Ventas</h1>
            </div>
        </div>
        <!--END Header section-->
        <div class="ventas-text row my-3.5 mx-1.5 lg:mx-0">
            <div class="col-12">
                <p>Aquí podrás encontrar toda la información de las ventas que se han realizado desde tu
                    colaboración con HiCitty. Podrás ver los desgloses y agrupaciones de las siguientes formas:
                </p>
            </div>
        </div>
         <!-- Content section-->
        <div class="ventas-card row mx-1.5 lg:mx-0">
            <div class="ventas-card-body my-2.5 lg:my-0 col-12 w-full h-56 lg:h-1/4 rounded-xl shadow relative">
                <div class="row h-full rounded-xl realtive bg-cover bg-top" id="body-ventas-antes">
                    <div class="d-none d-lg-block col-lg-3 lg:h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/vh-1.jpg');">
                        <div class="rounded-l-xl gradient-collaborator absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Ventas por publicidad</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Desglosa y agrupa toda la información respecto a las ventas que han realizado
                            los clientes antes de llegar a su lugar de alojamiento.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <button class="btn btn-outline-orange m-auto py-0.5 px-6">Ver</button>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
            <div class="ventas-card-body my-2.5 lg:my-0 col-12 w-full h-56 lg:h-1/4 rounded-xl shadow relative">
                <div class="row h-full rounded-xl bg-cover bg-top" id="body-ventas-durante">
                    <div class="d-none d-lg-block col-lg-3 h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/vh-2.jpg');">
                        <div class="rounded-l-xl gradient-collaborator absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Ventas por inmuebles</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Desglosa y agrupa toda la información respecto a las ventas que se han realizado
                            durante la estancia de tus clientes.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <Link :href="route('dashboard.sales.total')" class="btn btn-outline-orange m-auto py-0.5 px-6">Ver</Link>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
            </div>
            <div class="ventas-card-body my-2.5 lg:my-0 col-12 w-full h-56 lg:h-1/4 rounded-xl shadow relative">
                <div class="row h-full rounded-xl bg-cover bg-top" id="body-ventas-totales">
                    <div class="d-none d-lg-block col-lg-3 lg:h-full rounded-l-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/vh-3.jpg');">
                        <div class="rounded-l-xl gradient-collaborator absolute left-0 top-0 w-full h-full"></div>
                    </div>
                    <div class="col-12 col-lg-7 lg:h-full lg:bg-black flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="text-2xl text-white mt-auto leading-6">Ventas totales</h2>
                        <p class="text-white mb-auto text-sm lg:text-xs leading-5 lg:leading-4 mt-1.5 lg:mt-0">
                            Desglosa y agrupa toda la Información de todas las ventas que se han realizado.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 lg:bg-black flex rounded-r-xl absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <Link :href="route('dashboard.sales.total')" class="btn btn-outline-orange m-auto py-0.5 px-6">Ver</Link>
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
@media(min-width:1024px){
    .ventas-card{
        height:65vh;
    }
}
@media(max-width:1023px){
    #body-ventas-antes{
        background-image: url('/vendor_asset/img/collaborator/dashboard/vh-1.jpg');
    }
    #body-ventas-durante{
        background-image: url('/vendor_asset/img/collaborator/dashboard/vh-2.jpg');
    }
    #body-ventas-totales{
        background-image: url('/vendor_asset/img/collaborator/dashboard/vh-3.jpg');
    }
}
</style>