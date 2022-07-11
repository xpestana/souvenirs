<template>
	 <section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Recursos</h1>
            </div>
        </div>
        <div
            class="mx-1.5 lg:mx-0 mt-8 mb-9"
        >
        	<span>Descubre todas las formas y posibilidades que te ofrecemos para poder empezar a vender y generar beneficios.</span>
        	<div class="row justify-content-center mt-14">
        		<div class="col-12 col-md-6 col-lg-5">
                    <div class="card-before p-3 rounded-xl hover:shadow-xl">
                        <div class="font-bold text-xl flex align-items-center">
                            <div id="img-banner" class="inline-block mr-2"></div>
                            <div class="inline-block">Banners</div>
                        </div>
                        <div class="mt-2">
                            <span>Generar <strong>banners</strong> que te permitan captar la atención del cliente y empezar a vender</span>
                        </div>
                        <div class="mt-3">
                            <span>Este banner lo podrás cologar en <strong>tus emails o mensajes de contacto</strong> y será una forma de hacer más atractivos tus mensajes y de que el cliente tenga a mano todos los servicios que ofrecemos desde Hicitty.</span>
                        </div>
                        <div class="flex justify-content-center justify-content-md-start mt-4">
                            <Link :href="route('associates.resource.banner')" class="btn py-1 text-center w-50 font-bold">Descargar banner</Link>
                        </div>
                    </div>
        		</div>
        		<div class="col-12 col-md-6 col-lg-5">
                    <div class="card-before p-3 rounded-xl hover:shadow-xl">
            			<div class="font-bold text-xl flex align-items-center">
            				<div id="img-url"  class="inline-block mr-2"></div>
                            <div class="inline-block">Url`s personalizadas</div>
            			</div>
            			<div class="mt-2">
            				<span class="block">Enlazar nuestros servicios para el inmueble  que hayas reservado es algo muy inportante además de sencillo.</span>
            			</div>
            			<div class="mt-3">
            				<span class="block">Solo tienes que <strong>generar un enlace desde el botón</strong> que haya más bajo y <strong>colocar esa Url en los elementos que consideres</strong> (Imagenes, links, botones...)</span>
            			</div>
                        <div class="flex justify-content-center justify-content-md-start mt-4">
                            <Link :href="route('associates.resource.url')" class="btn py-1 text-center w-50 font-bold">Generar Url</Link>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
        <div class="mx-1.5 lg:mx-0 mt-8 mb-9">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card-before p-3 rounded-xl hover:shadow-xl">
                        <div class="font-bold text-xl flex align-items-center">
                            <div id="img-banner" class="inline-block mr-2"></div>
                            <div class="inline-block">Displayer</div>
                        </div>
                        <div class="mt-2">
                            <span>Descubre los <strong>displays</strong> que te ofrecemos para <strong>captar la atención del cliente</strong> y que pueda <strong>acceder facilmente a los servicios</strong> que ofrecemos.</span>
                        </div>
                        <div class="mt-3">
                            <span><strong>Escoge el display</strong> que mejor se adacte a ti, <strong>la cantidad y la ciudad de destino y te los enviaremos</strong> a tu dirección para que puedas empezar a vender.</span>
                        </div>
                        <div class="flex justify-content-center justify-content-md-start mt-4">
                            <Link :href="route('associates.resource.display')" class="btn py-1 w-50 text-center font-bold">Ver displays</Link>
                        </div>
                    </div>
        		</div>
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="row shadow-2xl rounded-xl mx-0 relative">
                        <div class="stay-cards-img col-12 d-block rounded-t-xl bg-center bg-cover px-0 h-36" 
                            style="background-image:url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg')"
                        >
                            <div class="gradient-left w-full h-full rounded-t-xl"></div>
                        </div>
                        <div class="cards-info col-3 pt-3.5 rounded-l-xl pl-4 h-28  absolute top-16 z-30">
                            <h1 class="text-7xl text-orangec font-bold">
                                20%
                            </h1>
                        </div>
                        <div class="cards-info col-12 bg-black pt-3.5 h-28 rounded-b-xl rounded-b-none">
                            <h1 class="text-lg text-white font-bold mb-0">
                                de comisión sobre el precio final de venta de todos los servicios que adquiera el cliente.
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        
    },
    methods: {
        goBack () {
            window.history.back()
        },
    },
}
</script>
<style scoped>
    .card-before {
        transition: all .4s;
    }
    .card-before a {
        color: #fff;
    }

    .gradient-collaborator-before{
        background: linear-gradient(100deg, rgba(134,188,217,0) 30%, rgba(1,1,1,1) 90%);
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
    #img-banner{
        background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerNegro.svg');
        background-size: cover;
        background-repeat: no-repeat;
        width: 1.8rem;
        height: 1.8rem;
        transition: all .4s;
    }

    #img-url{
        background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlNegro.svg');
        background-size: cover;
        background-repeat: no-repeat;
        width: 1.8rem;
        height: 1.8rem;
        transition: all .4s;
    }

    a {
        background-color: #FF9C06;
        color: #fff;
    }

    @media(min-width:767px){
        a {
            background-color: #000;
            color: #fff;
        }

        .card-before:hover {
            background-color: #FF9C06;
            color: #fff;
        }
        .card-before:hover #img-banner{
            background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg');
        }

        .card-before:hover #img-url{
            background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg');
        }

        .card-before a {
            transition: all .4s;
        }



        .card-before:hover a {
            background-color: #fff;
            color: #FF9C06;
        }
    }

    .gradient-left{
        background: linear-gradient(180deg, rgba(134,188,217,0) 55%, rgba(1,1,1,1) 90%);
    }

</style>