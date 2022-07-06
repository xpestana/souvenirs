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
                        <div class="font-bold text-xl">
                            <!-- <div id="img-banner" class="w-8"></div> -->
                            <img src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerNegro.svg" class="w-8 inline-block" style="margin-top: 4px;">
                            Banner
                        </div>
                        <div class="mt-2">
                            <span>Te gustaria generar un banner <strong>para el inmueble que haya reservado.</strong></span>
                        </div>
                        <div class="mt-3">
                            <span>Este banner lo podrás cologar en <strong>tus emails o mensajes de contacto</strong> y será una forma de hacer más atractivos tus mensajes y de que el cliente tenga a mano todos los servicios que ofrecemos desde Hicitty.</span>
                        </div>
                        <div class="flex justify-content-start mt-4">
                            <Link :href="route('collaborator.recursos.antes.banner')" class="btn bg-collaborator-black py-1 px-3 font-bold">Descargar banner</Link>
                        </div>
                    </div>
        		</div>
        		<div class="col-12 col-md-6 col-lg-5">
                    <div class="card-before p-3 rounded-xl hover:shadow-xl">
            			<div class="font-bold text-xl">
            				<!-- <div id="img-url" class="w-8"></div> -->
                             <img src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlNegro.svg" class="w-8 inline-block" style="margin-top: 4px;">
                            Url`s personalizadas
            			</div>
            			<div class="mt-2">
            				<span class="block">Enlaza nuestros servicios para el inmueble  que hayas reservado es algo muy inportante además de sencillo.</span>
            			</div>
            			<div class="mt-3">
            				<span class="block">Solo tienes que <strong>generar un enlace desde el botón</strong> que haya más bajo y <strong>colocar esa Url en los elementos que consideres</strong> (Imagenes, links, botones...)</span>
            			</div>
                        <div class="flex justify-content-start mt-4">
                            <Link :href="route('collaborator.recursos.antes.url')" class="btn bg-collaborator-black py-1 px-8 font-bold">Generar Url</Link>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
        <div class="row mx-1.5 mt-9 lg:mx-0">
            <div class="ventas-card-body my-2.5 lg:my-0 col-12 w-full h-56 lg:h-1/4 rounded-xl shadow relative">
                <div class="row h-full rounded-xl realtive bg-cover bg-top" id="body-ventas-antes">
                    <div class="col-12 col-lg-4 lg:h-full lg:bg-black rounded-l-xl flex flex-column px-6 absolute lg:relative z-20 top-6 lg:top-0">
                        <h2 class="font-bold text-7xl text-orangec">20%</h2>
                    </div>
                    <div class="col-12 col-lg-4 lg:bg-black flex absolute lg:relative z-20 bottom-6 lg:bottom-0">
                        <p class="text-2md text-white font-bold">
                            de comisión sobre el precio final
                            de venta de todos los servicios
                            que adquiera el cliente.
                        </p>
                    </div>
                    <div class="d-none d-lg-block col-lg-4 lg:h-full rounded-r-xl bg-cover bg-center bg-no-repeat relative" style="background-image: url('/vendor_asset/img/collaborator/dashboard/vh-1.jpg');">
                        <div class="rounded-l-xl gradient-collaborator-before absolute left-0 top-0 w-full h-full"></div>
                    </div>
                </div>
                <div class="absolute left-0 top-0 rounded-xl lg:hidden w-full h-full z-10" style="background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);"></div>
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
    .card-before #img-banner{
        background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerNegro.svg');
        margin-top: 4px;
        width: 2rem;
    }

    .card-before #img-url{
        background-image: url('/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlNegro.svg');
        margin-top: 4px;
    }

    @media(min-width:767px){
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

</style>