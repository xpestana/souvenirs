<template>
	 <section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Antes de la llegada</h1>
            </div>
        </div>
        <div
            class="mx-1.5 lg:mx-0 mt-8 mb-9"
        >
        	<span>En esta sección encontrarás los recursos online con los que <strong>empezar a ganar beneficios antes de que el cliente llegue al inmueble.</strong></span>
        	<div class="row justify-content-center mt-14">
        		<div class="col-12 col-md-6 col-lg-5">
                    <div class="card-before p-3 rounded-xl hover:shadow-xl">
                        <div class="font-bold text-xl flex align-items-center">
                            <div id="img-banner" class="inline-block mr-2"></div>
                            <div class="inline-block">Banners</div>
                        </div>
                        <div class="mt-2">
                            <span>Te gustaria generar un banner <strong>para el inmueble que haya reservado.</strong></span>
                        </div>
                        <div class="mt-3">
                            <span>Este banner lo podrás cologar en <strong>tus emails o mensajes de contacto</strong> y será una forma de hacer más atractivos tus mensajes y de que el cliente tenga a mano todos los servicios que ofrecemos desde Hicitty.</span>
                        </div>
                        <div class="flex justify-content-center justify-content-md-start mt-4">
                            <Link :href="route('collaborator.recursos.antes.banner')" class="btn py-1 px-3 font-bold">Descargar banner</Link>
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
            				<span class="block">Enlaza nuestros servicios para el inmueble  que hayas reservado es algo muy inportante además de sencillo.</span>
            			</div>
            			<div class="mt-3">
            				<span class="block">Solo tienes que <strong>generar un enlace desde el botón</strong> que haya más bajo y <strong>colocar esa Url en los elementos que consideres</strong> (Imagenes, links, botones...)</span>
            			</div>
                        <div class="flex justify-content-center justify-content-md-start mt-4">
                            <Link :href="route('collaborator.recursos.antes.url')" class="btn py-1 px-8 font-bold">Generar Url</Link>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
         <div class="row shadow-2xl rounded-xl mt-6 mx-0 relative">
            <div class="stay-cards-img col-12 d-block d-lg-none rounded-t-xl bg-center bg-cover px-0 h-36" 
                style="background-image:url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg')"
            >
                <div class="gradient-left w-full h-full rounded-t-xl"></div>
            </div>
            <div class="cards-info col-12 col-lg-3 md:bg-black pt-3.5 lg:rounded-l-xl pl-lg-4 h-auto lg:h-28  absolute md:static top-16 z-30">
                <h1 class="text-7xl text-orangec font-bold">
                    20%
                </h1>
            </div>
            <div class="cards-info col-12 col-lg-6 bg-black pt-3.5 h-auto lg:h-28 px-lg-0 rounded-b-xl lg:rounded-b-none">
                <h1 class="text-lg text-white font-bold mb-6 lg:mb-0">
                    de comisión sobre el precio final de venta de todos los servicios que adquiera el cliente.
                </h1>
            </div>
            <div class="cards-img col-lg-3 d-none d-lg-block rounded-r-xl bg-center bg-cover pl-lg-0 h-28" style="background-image:url('/vendor_asset/img/collaborator/dashboard/colhome3.jpg')">
                <div class="gradient-left w-full h-full rounded-r-xl"></div>
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
        background: linear-gradient(270deg, rgba(134,188,217,0) 30%, rgba(1,1,1,1) 90%);
    }
    @media (max-width:991px){
        .gradient-left{
            background: linear-gradient(180deg, rgba(134,188,217,0) 55%, rgba(1,1,1,1) 90%);
        }
    }

</style>