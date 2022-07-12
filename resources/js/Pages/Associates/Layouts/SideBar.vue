<template>
<!-- route('associates.collaborations')
route('associates.index')
route('associates.settings')-->
    <nav id="collaborator-sidebar" class="fixed z-40 w-3/4 lg:w-1/5 text-white bg-collaborator h-screen rounded-r-3xl flex flex-column overflow-auto">
        <div class="nav-logo flex flex-row">
            <i class="fas fa-times sidebarCollapse text-white cursor-pointer h-12 mt-8 w-12 mx-6 text-xl"></i>
            <img class="w-24 md:w-36 mr-auto grow mt-3.5 lg:mx-auto lg:mt-12" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
        </div>
        <ul class="list-unstyled py-4 pl-8 2xl:pl-11 my-auto">  
            <li class="mb-3.5">
                <Link :href="route('associates.home')" class="text-base link sidebar-collapse-menu-mobile" 
                      :class="{'sidebar-active':this.$page.url=='/tablero/asociado'}">
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':this.$page.url=='/tablero/asociado'}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/inicioo.svg"
                    >
                    Inicio
                </Link>
            </li>
            <li class="mb-3.5">
                <Link href="#" class="text-base link  sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url.includes('/tablero/alojamientos')}">
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':this.$page.url.includes('/tablero/alojamientos')}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/enlazarservicios.svg"
                    >
                    Enlazar servicios
                </Link>
            </li>
            <li class="mb-3.5 relative pl-0.5">
                <i class="fas fa-caret-down absolute right-6 top-1 cursor-pointer" :class="{'d-none':routesColaboracion}"  id="downcol" @click="toggleColaboracion('sub-colaboracion')"></i>
                <i class="fas fa-caret-up absolute right-6 top-1 text-black cursor-pointer" :class="{'d-none':!routesColaboracion}" id="upcol" @click="toggleColaboracion('sub-colaboracion')"></i>
                <Link :href="route('associates.collaboration')" data-toggle="collapse" 
                    aria-expanded="false" class="dropdown-toggle text-base link  sidebar-collapse-menu-mobile"  
                    :class="{'sidebar-active':this.$page.url.includes('colaboracion')}"
                >
                <img class="inline w-3.5" style="margin-top:-4px"
                    :class="{'side-icon-active':this.$page.url.includes('colaboracion')}" 
                    src="/vendor_asset/img/collaborator/dashboard/icons/recurso.svg"
                >
                    Colaboración
                </Link>
                <ul class="collapse list-unstyled list-sidebar pl-4"  :class="{'show':this.$page.url.includes('colaboracion')}" id="sub-colaboracion">
                    <li>
                        <Link href="#" class="text-sm my-2 side-link sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url=='/tablero/asociado/colaboracion/recursos'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/asociado/colaboracion/recursos'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/recurso.svg"
                            >
                            Recursos
                        </Link>        
                    </li>
                    <li>
                        <Link :href="route('associates.sales')" class="text-sm my-2 side-link sidebar-collapse-menu-mobile"
                             :class="{'sidebar-active':this.$page.url.includes('/tablero/asociado/colaboracion/ventas')}">
                            <img class="inline w-5" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url.includes('/tablero/asociado/colaboracion/ventas')}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/ventas.svg"
                            >
                            Ventas
                        </Link>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5 relative pl-0.5">
                <i class="fas fa-caret-up absolute right-6 top-1 text-black cursor-pointer" :class="{'d-none':!routesProfile}" id="upprofile" @click="toggleMenuProfile('sub-perfil')"></i>
                <i class="fas fa-caret-down absolute right-6 top-1 cursor-pointer" :class="{'d-none':routesProfile}" id="downprofile" @click="toggleMenuProfile('sub-perfil')"></i>
                <Link :href="route('collaborator.dashboard.profile')" data-toggle="collapse" 
                    aria-expanded="false" class="dropdown-toggle text-base link  sidebar-collapse-menu-mobile"  
                    :class="{'sidebar-active':routesProfile}"
                >
                <img class="inline w-3.5" style="margin-top:-4px"
                        :class="{'side-icon-active':routesProfile}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/perfil.svg"
                    >
                    
                    Ajustes de perfil
                </Link>
                <ul class="collapse list-unstyled list-sidebar pl-8" :class="{'show':routesProfile}" id="sub-perfil">
                    <li>
                        <Link :href="route('dashboard.profile.info')" class="text-sm my-2 side-link sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-informacion'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/perfil-informacion'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                            >
                            Info. Perfil
                        </Link>        
                    </li>
                    <li>
                        <Link :href="route('collaborator.profile.tax')" class="text-sm my-2 side-link sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url=='/tablero/perfil-datos-fiscales'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/perfil-datos-fiscales'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                            >
                            Datos fiscales
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('collaborator.bank.index')" class="text-sm my-2 side-link sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url=='/tablero/banco'}">
                            <img class="inline w-4" style="margin-top:-4px"
                                :class="{'side-icon-active':this.$page.url=='/tablero/banco'}" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                            >
                            Información bancaria
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('collaborator.shipping.index')" class="text-sm my-2 side-link sidebar-collapse-menu-mobile" :class="{'sidebar-active':this.$page.url=='/tablero/envio'}">
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
                <Link :href="route('logout')" class="text-base link  sidebar-collapse-menu-mobile">
                    <img class="inline w-3.5 mr-0.5" style="margin-top:-4px"
                        src="/vendor_asset/img/collaborator/dashboard/icons/cerrar.svg"
                    >
                    Cerrar Sesión
                </Link>
            </li>
        </ul>
        <div class="nav-info text-center my-auto">
            <div class="flex">
                <img class="w-6 m-auto" src="/vendor_asset/img/collaborator/dashboard/icons/question.svg" alt="">
            </div>
            <p class="text-base text-white font-semibold">¿Necesitas ayuda?</p>
            <p class="text-sm text-white">
                Encontrarás atención especializada<br>
                llamando al siguiente teléfono:
            </p>
            <p class="text-sm text-white  font-semibold"><i class="fas fa-phone-alt mr-1 text-white"></i> (+34) 722 193 903</p>    
            <button class="btn rounded-lg text-white border-solid border border-white mx-auto py-1 mt-8 mb-2"  data-toggle="modal" data-target="#feedback">
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
                <form @submit.prevent="sendFeedback">
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
                        
                        <textarea class="border w-100 rounded h-36 col-form-input" v-model="form.description" placeholder="Escribe aquí tu feedback..."></textarea>

                    </div>
                    <div class="mb-3.5 mt-1 flex">
                        <button class="btn rounded bg-collaborator-orange text-white ml-auto mr-4 px-4 py-1">Enviar</button>
                    </div>
                </div>
            </form>
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
    data(){
        return {
            routesProfile:false,
            routesColaboracion:false,
            form: this.$inertia.form({
                description: null,
            }),
        }
    },
    created(){
        this.profile()
        this.colaboracion()
    },
    updated(){
        this.routesProfile = false
        this.routesColaboracion = false
        this.profile()
        this.colaboracion()
    },
    methods:{
        profile(){
            let url = this.$page.url;
            let route1 = url.includes('tablero/perfil')
            let route2 = url.includes('tablero/perfil-informacion')
            let route3 = url.includes('tablero/banco')
            let route4 = url.includes('tablero/envio')
            let route5 = url.includes('tablero/perfil-datos-fiscales')
            if(route1 || route2 || route3 || route4 || route5){
                this.routesProfile = true;
            }
        },
        colaboracion(){
            let url = this.$page.url;
            let route1 = url.includes('tablero/asociado/colaboracion')
            if(route1){
                this.routesColaboracion = true;
            }
        },
        toggleMenuProfile(id){
            document.getElementById('downprofile').classList.toggle('d-none')
            document.getElementById('upprofile').classList.toggle('d-none')
            let ul = document.getElementById(id);
            ul.classList.toggle('show');
        },
        toggleColaboracion(id){
            document.getElementById('downcol').classList.toggle('d-none')
            document.getElementById('upcol').classList.toggle('d-none')
            let ul = document.getElementById(id);
            ul.classList.toggle('show');
        },
        sendFeedback(){
            let modal = $('#feedback');
            this.form.post(route('collaborator.feedback'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'sendFeedback',
                    preserveScroll: true,
                    onSuccess:()=>{
                        this.form.reset()
                        modal.modal('hide')
                    }
                })
        }
    },
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