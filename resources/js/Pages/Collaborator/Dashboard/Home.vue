<template> 
<ModalCookies/>
    <section id="dashboard-home" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row justify-content-between shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-4 col-md-4 text-left">
                <h1 class="font-bold text-3xl text-muted">Inicio</h1>
            </div>
            <div class="col-8 col-md-4 text-right">
                <p class="leading-4">
                    ¡Bienvenido/a a HiCitty<br>
                    <span class="text-orangec">{{$page.props.auth.profile.firstname}}</span>!
                </p>
            </div>
        </div>
        <!--END Header section-->
        <!-- Content section-->
        <div class="home-perfil row mt-3.5 lg:mt-0">
            <div class="col-12 mt-2 mb-1 px-lg-0">
                <h2 class="font-semibold text-3xl">Primeros pasos</h2>
            </div>
            <div class="col-12 col-lg-6 pl-lg-0 pr-lg-3 lg:h-3/4">
                <div class="perfil-card w-full h-48 lg:h-full rounded-xl shadow bg-center bg-cover bg-no-repeat relative" 
                    id="perfil-lodging" style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome1.jpg');">
                    <div class="absolute w-full h-full flex flex-column justify-between rounded-xl" style="background-color:#00000069">
                        <h2 class="font-bold text-2xl text-white p-3.5"> Da de alta tu primer alojamiento</h2>
                        <p class="text-right text-2xl text-white  p-3.5">No realizado</p>
                    </div>
                    <div class="bg-collaborator-orange w-full bottom-0 absolute rounded-xl flex" id="perfil-lodging-target">
                        <div class="text-white m-auto">
                            <button class="btn rounded-lg text-white border-solid border border-white">
                                <h3 class="mr-1 inline text-white">+</h3> 
                                Añadir alojamiento
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 pr-lg-0 pl-lg-3 lg:h-3/4 mt-3.5 lg:mt-0">
                <div class="perfil-card w-full h-48 lg:h-full rounded-xl shadow bg-center bg-cover bg-no-repeat relative" 
                    id="perfil-perfil"  style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome2.jpg');">
                    <div class="absolute w-full h-full flex flex-column justify-between rounded-xl" style="background-color:#00000069">
                        <h2 class="font-bold text-2xl text-white p-3.5">Rellena los datos de tu perfil</h2>
                        <p class="text-right text-2xl text-white  p-3.5">{{ cont }} de 4</p>
                    </div>
                    <div class="bg-collaborator-orange w-full bottom-0 absolute rounded-xl" id="perfil-perfil-target">
                        <div class="text-white py-3.5 px-6">
                            <Link :href="route('dashboard.profile.info')">
                                <p class="text-white mb-2"><i class="fas fa-id-card text-white mr-2"></i>Información de perfil</p>
                            </Link>
                            <Link :href="route('collaborator.profile.tax')">
                            <p class="text-white hover:font-bold mb-2"><i class="fas fa-file-alt text-white ml-1 mr-2"></i>Datos fiscales</p>
                            </Link>
                            <Link :href="route('collaborator.bank.index')">
                            <p class="text-white hover:font-bold mb-2"><i class="fas fa-credit-card text-white mr-2"></i>Información bancaria</p>
                            </Link>
                            <Link :href="route('collaborator.shipping.index')">
                            <p class="text-white hover:font-bold mb-2"><i class="fas fa-truck text-white mr-1"></i> Datos de envío</p>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-benefit row">
            <div class="col-12 mb-3.5 px-lg-0 mt-3.5 lg:mt-0">
                <h2 class="font-semibold text-3xl mt-2">Información general</h2>
            </div>
            <div class="col-12 col-lg-4 h-full">
                <div class="row h-40 lg:h-full">
                    <div class="col-6 col-lg-12  pl-lg-0 pr-lg-3 benefit-target">
                        <div class="benefit-card w-full h-full rounded-xl shadow flex flex-column justify-between bg-collaborator-orange">
                            <img src="/vendor_asset/img/collaborator/dashboard/icons/dinero.svg" class="absolute bottom-0 right-0 w-3/4 lg:w-1/2">
                            <h2 class="font-bold text-2xl text-white p-2">Beneficios totales</h2>
                            <p class="text-right text-xl text-white  p-2">{{(total*0.20).toFixed(2)}}€</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-12  pl-lg-0 pr-lg-3 mt-lg-auto benefit-target">
                        <div class="benefit-card w-full h-full rounded-xl shadow flex flex-column justify-between bg-collaborator">
                            <img src="/vendor_asset/img/collaborator/dashboard/icons/kayak.svg" class="absolute top-8 lg:top-0  right-0 w-3/4 lg:w-1/2">
                            <h2 class="font-bold text-2xl text-white p-2">Pedidos totales</h2>
                            <p class="text-right text-xl text-white  p-2">{{orders.data.length}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 pr-lg-0 mt-6 lg:mt-0 h-full">
                <div class="benefit-card-benefit w-full h-56 lg:h-full rounded-xl shadow bg-center bg-cover bg-no-repeat relative p-6" 
                    id="perfil-perfil"  style="background-image: url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg');">
                    <div class="absolute w-full h-full top-0 left-0 rounded-xl flex flex-column justify-between p-6" style="background-color:#00000069">
                        <h2 class="font-bold text-7xl text-orangec">20%</h2>
                        <p class="text-sm lg:text-xl text-white font-bold mb-auto">
                            de comisión sobre el precio final
                            de venta de todos los servicios
                            que adquiera el cliente.
                        </p>
                        <button class="btn mt-2 lg:mt-0 rounded-lg text-white border-solid border border-white ml-auto py-1">
                            ¡Empieza a vender!
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Content section-->
    </section>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'  
import { Head, Link } from '@inertiajs/inertia-vue3'
import QRCodeVue3 from "qrcode-vue3"

export default {
    layout:TemplateApp,
    components:{
        Head,
        Link,
        QRCodeVue3,
        ModalCookies
    },
    props: {
    cont: Number,
    orders:Object
    },
    data(){
        return{
            total:0
        }
    },
    created(){
        this.orders.data.forEach(order =>{
            this.total += Number(order.total);
        });
    }
}
</script>
<style scoped>
#perfil-perfil #perfil-perfil-target p:hover{
    font-weight: bolder;
}
@media(min-width:1024px){
    /*TRANSTION ALTA ALOJAMIENTO*/ 
    #perfil-lodging:hover >
    #perfil-lodging-target{
        height: 100%;
    }
    #perfil-lodging:hover >
    #perfil-lodging-target div{
        display: block;
    }
    #perfil-lodging-target{
        height: 0;
        transition: all 0.6s;
    }
    #perfil-lodging-target div{
        display:none;
        transition: all 0.9s;
    }
    /*TRANSICION DATOS DE PERFIL*/
    #perfil-perfil:hover >
    #perfil-perfil-target{
        height: 100%;
    }
    #perfil-perfil:hover >
    #perfil-perfil-target div{
        display: block;
    }
    #perfil-perfil-target{
        height: 0;
        transition: all 0.6s;
    }
    #perfil-perfil-target div{
        display:none;
        transition: all 1s;
    }
    /** */
    .benefit-target{
        height: 46%;
    }
    .home-benefit,
    .home-perfil{
        height: 35vh;
    }
}
@media(max-width:1023px){
    #perfil-lodging-target div{
        display:none;
    }
    #perfil-perfil-target div{
        display:none;
    }
    .benefit-target{
        height: 100%;
    }
}
</style>