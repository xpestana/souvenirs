<template>
    <div id="dashboard-perfil-bank" class="container  py-8 ml-2 md:ml-0 md:px-24">
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    Enlazar servicios
                </h1>
            </div>
        </div>
         <!--END Header-->
        <!-- Information section -->
        <div
            class="content-information row mx-1.5 lg:mx-0 justify-content-center align-items-center"
        >
            <div class="col-12 col-md-8 text-center">
                <h1 class="font-bold text-lg md:text-3xl">
                    Ponte en contacto con nosotros para habilitar estas funciones 
                </h1>
                <span class="mt-2 block">Enlazar los servicios que ofreces como prestador de servicios es otra forma de ganar beneficios con <strong>HiCitty</strong></span>
                <span class="block text-orangec mt-8 text-base md:text-lg font-bold">!Contáctanos¡</span>
                <span class="block mt-1 text-base md:text-lg font-bold"><i class="fas fa-phone-alt mr-1"></i> (+34) 722 193 903</span>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
export default {
    layout:TemplateApp,
    components:{
        Head,
        Link,
    },
    data() {
        return {
        }
    },
    methods: {
    },
}
</script>

<style lang="scss" scoped>

    .container{
        height: 100vh;
    }

    .content-information{
        height:90%;
    }

    @media(min-width: 768px){
        .container{
            height: 100vh;
        }
        .content-information{
            height: 90%;
        }
    }

</style>