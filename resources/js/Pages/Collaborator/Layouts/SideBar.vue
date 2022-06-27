<template>
    <nav id="collaborator-sidebar" class="fixed z-30 w-3/4 md:w-1/5 text-white bg-collaborator h-screen rounded-r-3xl flex flex-column overflow-auto">
        <div class="nav-logo flex flex-row">
            <i class="fas fa-times sidebarCollapse text-white cursor-pointer h-12 mt-8 w-12 mx-6 text-xl"></i>
            <img class="w-24 md:w-36 mr-auto grow mt-3.5 lg:mx-auto lg:mt-12" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
        </div>
        <ul class="list-unstyled p-4 my-auto">  
            <li class="mb-3.5">
                <Link :href="route('collaborator.dashboard.home')" class="text-base" :class="{'sidebar-active':this.$page.url=='/tablero'}">
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':this.$page.url=='/tablero'}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/inicio.svg"
                    >
                    Inicio
                </Link>
            </li>
            <li class="mb-3.5">
                <a href="#" class="text-base">
                    <img class="inline w-5" style="margin-top:-4px"
                        src="/vendor_asset/img/collaborator/dashboard/icons/gestionaloj.svg"
                    >
                    Gestión de alojamientos
                </a>
            </li>
            <li class="mb-3.5">
                <a href="#sub-recursos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <img class="inline w-4" style="margin-top:-4px"
                    src="/vendor_asset/img/collaborator/dashboard/icons/recurso.svg"
                >
                Recursos</a>
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
                <img class="inline w-5" style="margin-top:-4px"
                    src="/vendor_asset/img/collaborator/dashboard/icons/ventas.svg"
                >
                Ventas</a>
                <ul class="collapse list-unstyled pl-4" id="sub-ventas">
                    <li>
                        <Link :href="route('collaborator.sales.publicity')" class="text-sm my-2 side-link pl-0.5"
                           :class="{'side-icon-active':this.$page.url=='/tablero/ventas-publicidad'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/ventas-durante.svg"
                            >
                            Ventas por publicidad
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('collaborator.sales.property')" class="text-sm my-2 side-link pl-0.5" :class="{'sidebar-active':this.$page.url=='/tablero/ventas-inmueble'}">
                            Ventas por inmueble
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('dashboard.sales.total')" class="text-sm my-2 side-link pl-0.5" :class="{'sidebar-active':this.$page.url=='/tablero/ventas-totales'}">
                            <img class="inline w-3.5" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/ventas-totales'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/ventas-totales.svg"
                            >
                            Ventas totales
                        </Link>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <Link :href="route('collaborator.dashboard.profile')" data-toggle="collapse" 
                    aria-expanded="false" class="dropdown-toggle text-base"  
                    :class="{'side-icon-active':routesProfile}"
                >
                <img class="inline w-4" style="margin-top:-4px"
                        :class="{'sidebar-active':routesProfile}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/perfil.svg"
                    >
                    
                    Ajustes de perfil
                </Link>
                <ul class="collapse list-unstyled pl-8" :class="{'show':routesProfile}" id="sub-perfil">
                    <li>
                        <Link :href="route('dashboard.profile.info')" class="text-sm my-2 side-link" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-informacion'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/perfil-informacion'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                            >
                            Info. Perfil
                        </Link>        
                    </li>
                    <li>
                        <Link :href="route('collaborator.profile.tax')" class="text-sm my-2 side-link" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-datos-fiscales'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/perfil-datos-fiscales'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                            >
                            Datos fiscales
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('collaborator.bank.index')" class="text-sm my-2 side-link" :class="{'sidebar-active':this.$page.url=='/tablero/banco'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/banco'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                            >
                            Información bancaria
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('collaborator.shipping.index')" class="text-sm my-2 side-link" :class="{'sidebar-active':this.$page.url=='/tablero/envio'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/envio'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                            >
                            Datos de envío
                        </Link>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a :href="route('logout')" class="text-base">
                    <img class="inline w-4" style="margin-top:-4px"
                        src="/vendor_asset/img/collaborator/dashboard/icons/cerrar.svg"
                    >
                    Cerrar Sesión
                </a>
            </li>
        </ul>
        <div class="nav-info text-center my-auto">
            <h1 class="text-2xl font-weight-bolder text-white">?</h1>
            <p class="text-base text-white">¿Necesitas ayuda?</p>
            <p class="text-sm text-white">
                Encontraras atención especializada<br>
                llamando al siguiente teléfono:
            </p>
            <p class="text-sm text-white"><i class="fas fa-phone-alt mr-1 text-white"></i> (+34) 722 193 903</p>    
            <button class="btn rounded-lg text-white border-solid border border-white mx-auto py-1 my-2"  data-toggle="modal" data-target="#feedback">
                <i class="fas fa-comment-dots text-white mr-1"></i>¡Danos feedback!
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
                        <p class="text-white text-2xl font-bold"><i class="fas fa-comment-dots text-white mr-1"></i>¡Danos feedback!</p>
                    </div>
                    <p class="px-4 my-2 text-sm">
                        ¿Has encontrado un bug? ¿Hay alguna funcioón que echas en falta o necesitas?
                        ¿Tienes alguna sugerencia? Sea lo que sea lo que tengas que decirnos seguro
                        que nos ayuda a mejorar tu experiencia, así que no te cortes.
                    </p>
                    <div class="mt-1 px-4">
                        <textarea class="border w-100 rounded h-36 col-form-input" placeholder="Escribe aquí tu feedback..."></textarea>
                    </div>
                    <div class="mb-3.5 mt-1 flex">
                        <button class="btn rounded bg-collaborator-orange text-white ml-auto mr-4 px-4 py-1">Enviar</button>
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
            let route3 = url.includes('tablero/banco')
            let route4 = url.includes('tablero/envio')
            let route5 = url.includes('tablero/perfil-datos-fiscales')
            console.log(url)
            console.log(route3)
            if(route1 || route2 || route3 || route4 || route5){
                return true;
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
.side-icon-active{ 
  filter: invert(100%) sepia(100%) saturate(100%) hue-rotate(330deg) brightness(100%) contrast(57%);
}
.icon-active{
    filter: invert(0%) sepia(0%) saturate(7465%) hue-rotate(248deg) brightness(95%) contrast(109%);
}
.icon-img:hover{
    filter: invert(0%) sepia(0%) saturate(7465%) hue-rotate(248deg) brightness(95%) contrast(109%);
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