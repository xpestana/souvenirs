<template>
    <section id="dashboard-means-header" class="container pt-8 pb-1.5 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-4 col-md-4 text-left">
                <h1 class="font-bold text-3xl text-muted">Recursos</h1>
            </div>
        </div>
        <!--END Header section-->
        <div class="ventas-text row my-3.5 mx-1.5 lg:mx-0">
            <div class="col-12">
                <p>
                    En esta sección podrás encontrar todos los recursos que necesitas para empezar a ganar con
                    <b>HiCitty.</b>
                </p>
                <p class="mt-1.5">
                    Pequeños consejos, buenas prácticas y formas de vender  
                    <b>tanto antes como durante la llegada del cliente al inmueble</b>
                </p>
            </div>
        </div>
    </section>
    <section id="dashboard-means-cards" class="container  ml-2 md:ml-0 md:px-24 mb-8">
        <div class="means-cards row shadow-2xl rounded-xl  mx-0">
            <div class="cards-img col-12 col-lg-7 rounded-t-xl lg:rounded-t-xl lg:rounded-l-xl bg-center bg-cover pr-0 pl-0 pr-lg-0 h-36 lg:h-56" 
                style="background-image:url('/vendor_asset/img/collaborator/dashboard/recursos1.jpg')"
            >
                <div class="gradient-right w-full h-full rounded-l-none lg:rounded-l-xl rounded-t-xl lg:rounded-t-none">
                </div>
            </div>
            <div class="cards-info col-12 col-lg-5 bg-black pt-3.5 rounded-b-xl lg:rounded-l-none lg:rounded-r-xl h-60 lg:h-56">
                <h1 class="text-xl text-white font-semibold  leading-6">
                    Empieza a vender antes que llegue el cliente
                </h1>
                <p class="mt-1.5 text-white leading-5">
                    Aqui encontrarás las opciones para ofrecer a tu cliente toda la información
                    y servicios antes de que llegue al inmueble, para así empezar a ganar una
                    comisión por cada compra que realice.
                </p>
                <div class="text-center text-lg-left">
                    <button class="btn bg-collaborator-orange text-white font-semibold py-1 mt-2.5">
                        ¡Empezar a vender!
                    </button>
                </div>
            </div>
        </div>

        <div class="means-cards row shadow-2xl rounded-xl mt-6 mx-0">
            <div class="cards-img col-12 d-block d-lg-none rounded-t-xl bg-center bg-cover px-0 h-36" 
                style="background-image:url('/vendor_asset/img/collaborator/dashboard/recursos2.jpg')"
            >
                <div class="gradient-left w-full h-full rounded-t-xl"></div>
            </div>
            <div class="cards-info col-12 col-lg-5 bg-black pt-3.5 rounded-b-xl lg:rounded-b-none lg:rounded-l-xl pl-lg-4  h-60 lg:h-56">
                <h1 class="text-xl text-white font-semibold  leading-6">
                    Completa su experiencia durante su estancia.
                </h1>
                <p class="mt-1.5 text-white leading-5">
                    Consulta todos los recursos y posibilidades para seguir ofreciendo servicios y
                    experiencias durante la entancia de tu cliente y poder ganar aún más.
                </p>
                <div class="text-center text-lg-left">
                    <button class="btn bg-collaborator-orange text-white font-semibold py-1 mt-2.5">
                        ¡Descubrir recursos!
                    </button>
                </div>
            </div>
            <div class="cards-img col-12 col-lg-7 d-none d-lg-block rounded-r-xl bg-center bg-cover pl-lg-0 h-56" style="background-image:url('/vendor_asset/img/collaborator/dashboard/recursos2.jpg')">
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
        
    }
}
</script>
<style scoped>
.gradient-right{
    background: linear-gradient(90deg, rgba(134,188,217,0) 63%, rgba(1,1,1,1) 90%);
}
.gradient-left{
    background: linear-gradient(270deg, rgba(134,188,217,0) 63%, rgba(1,1,1,1) 90%);
}
@media (max-width:991px){
    .gradient-right,
    .gradient-left{
        background: linear-gradient(180deg, rgba(134,188,217,0) 55%, rgba(1,1,1,1) 90%);
    }
}

</style>