<template>
    <section id="dashboard-resources-header" class="container pt-8 pb-1.5 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Durante la estancia</h1>
            </div>
        </div>
        <!--END Header section-->
        <div class="stay-text row my-3.5 mx-1.5 lg:mx-0">
            <div class="col-12 px-0">
                <p>
                    En esta sección encontrarás <b>elementos de impacto</b> que ponemos a tu disposición
                    para que el cliente tenga <b>fácil acceso a los servicios de HiCitty desde tu inmueble.</b>
                </p>
                <p class="mt-1.5">
                    <b>
                        Una vez tengas claro cuales son los que necesitas para tu inmueble, solo téndras que
                        contactar con nosotros y nos encargaremos de ponerlo todo en marcha
                    </b>
                </p>
            </div>
        </div>
    </section>
    <section id="resources-stay" class="container ml-3.5 md:ml-2 md:ml-0 md:px-24 mb-8">
        <div class="stay-title row mx-0">
            <div class="col-12 text-left pl-0">
                <h2 class="text-xl font-semibold">Displays físicos</h2>
            </div>
        </div>
        <div class="stay-displays row mt-3.5 mb-2.5 justify-content-center flex-nowrap overflow-x-auto pl-16 pl-lg-0 mx-0">
            <div class="col-5 col-md-3 bg-collaborator-orange rounded-xl shadow h-24 lg:h-44 mx-3.5 relative">
                <div class="absolute bottom-0 left-0 w-full h-full gradient-coll-down z-30 rounded-b-xl">
                    <h4 class="text-xs lg:text-lg text-white font-semibold mt-16 lg:mt-36 ml-2.5">MarcoQR</h4>
                </div>
            </div>
            <div class="col-5 col-md-3 bg-collaborator-orange rounded-xl shadow h-24 lg:h-44 mx-3.5 relative">
                <div class="absolute bottom-0 left-0 w-full h-full gradient-coll-down z-30 rounded-b-xl">
                    <h4 class="text-xs lg:text-lg text-white font-semibold mt-16 lg:mt-36 ml-2.5">Póster</h4>
                </div>
            </div>
            <div class="col-5 col-md-3 bg-collaborator-orange rounded-xl shadow h-24 lg:h-44 mx-3.5 flex px-0">
                <h4 class="text-xs lg:text-lg text-white font-semibold m-auto" id="rotatetext">Proximamente</h4>
            </div>
        </div>
        <div class="stay-request-displays row my-6">
            <div class="col-12 text-center">
                <button class="btn bg-collaborator-orange font-semibold py-1 xl:px-4 text-white" data-toggle="modal" data-target="#request-display">Pedir displays</button>
            </div>
        </div>
        <div class="stay-benefit row shadow-2xl rounded-xl mt-6 mx-0 relative">
            <div class="stay-cards-img col-12 d-block d-lg-none rounded-t-xl bg-center bg-cover px-0 h-36" 
                style="background-image:url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg')"
            >
                <div class="gradient-left w-full h-full rounded-t-xl"></div>
            </div>
            <div class="cards-info col-12 col-lg-4 md:bg-black pt-1.5 lg:rounded-l-xl pl-lg-4 h-auto lg:h-28  absolute md:static top-16 z-30">
                <h1 class="text-8xl text-orangec font-bold lg:text-center mb-2.5 lg:mb-0">
                    20%
                </h1>
            </div>
            <div class="cards-info col-12 col-lg-4 bg-black pt-2.5 h-auto lg:h-28 px-lg-0 rounded-b-xl lg:rounded-b-none">
                <h1 class="text-lg text-white font-bold mb-6 lg:mb-0 leading-6 pl-6">
                    de comisión sobre el precio final de venta de todos los servicios que adquiera el cliente.
                </h1>
            </div>
            <div class="cards-img col-lg-4 d-none d-lg-block rounded-r-xl bg-center bg-cover pl-lg-0 h-28" style="background-image:url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg')">
                <div class="gradient-left w-full h-full rounded-r-xl"></div>
            </div>
        </div>
    </section>
    <NotiModal :id="'request-display'">
        <template v-slot:header>
            <i class="fas fa-truck text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
            ¿Ya te has decidido?
        </template>
        <template v-slot:text>
            Si la respuesta es "Si",envíanos una notificación
            y nosotros nos pondremos en contacto contigo lo antes
            posible.
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                @click="sendRequest"
            >Enviar notificación
            </button>
        </template>
    </NotiModal>
    <NotiModal :id="'notidisplay'">
        <template v-slot:header>
            <i class="far fa-check-circle text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
            ¡Notificación recibida!
        </template>
        <template v-slot:text>
            En breve nos pondremos en contacto contigo para hablar de 
            lo que necesitas.
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                 data-dismiss="modal" aria-label="Close"
            >Cerrar mensaje
            </button>
        </template>
    </NotiModal>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import { Link } from '@inertiajs/inertia-vue3';
import NotiModal from '@/Pages/Collaborator/components/NotiModal'
export default {
    layout:TemplateApp,
    components:{
        Link,
        NotiModal
    },
    methods:{
        goBack () {
            window.history.back()
        },
        sendRequest(){
            let id = $('#notidisplay');
            let send = $('#request-display');
            this.$inertia.get(route('coll.request.display'),{id:this.idNoti}, {
                preserveScroll: true,
                onSuccess: (result) => {
                    send.modal('hide')
                    id.modal('show')
                }
            })
        },
    }
}
</script>
<style scoped>
#rotatetext{
    -webkit-transform: rotate(-50deg); 
    -moz-transform: rotate(-50deg);
    -o-transform: rotate(-50deg);
    transform: rotate(-50deg);
}
.gradient-left{
    background: linear-gradient(270deg, rgba(134,188,217,0) 30%, rgba(1,1,1,1) 90%);
}
@media (max-width:991px){
    .gradient-left{
        background: linear-gradient(180deg, rgba(134,188,217,0) 55%, rgba(1,1,1,1) 90%);
    }
}

</style>