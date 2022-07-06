<template>
    <section id="dashboard-resources-header" class="container pt-8 pb-1.5 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-4 col-md-4 text-left">
                <h1 class="font-bold text-3xl text-muted">Durante la estancia</h1>
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