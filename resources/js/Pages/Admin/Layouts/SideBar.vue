<template>
<aside id="sidebar" class="d-none d-md-block px-lg-3">
    <div class="logo py-4">
        <img class="m-auto" src="/vendor_asset/img/logo/logo.png" alt="logo" height="130" width="130">
    </div>
    <div class="items">
        <ul>
            <li class="mb-3 item pl-2 pb-2">
                <Link :href="route('admin.colaboradores')" class="link" :class="{ 'active': urlColaboradores}">
                    <div class="d-inline-flex">
                        <i class="fas fa-city my-auto pr-1"></i>
                        <p class="p-2" :class="{ 'active': urlColaboradores}">Gestor de <br> colaboradores</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-2 pb-2">    
                <Link :href="route('admin.activities')" class="link" :class="{ 'active': urlActividades}">
                    <div class="d-inline-flex">
                        <i class="fas fa-biking my-auto pr-1"></i>
                        <p class="p-2" :class="{ 'active': urlActividades}">Gestión de <br> actividades</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-2 pb-2">
                <Link :href="route('admin.souvenirs')"  class="link" :class="{ 'active': urlSouvenirs}">
                    <div class="d-inline-flex">
                        <i class="fas fa-gift my-auto pr-1"></i>
                        <p class="p-2" :class="{ 'active': urlSouvenirs}">Gestión de <br>souvenirs</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-2 pb-2">
                <Link :href="route('admin.home')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-shopping-cart my-auto pr-1"></i>
                        <p class="p-2">Mis ventas</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-2 pb-2">
                <Link :href="route('admin.administradores')"  class="link" :class="{ 'active': urlLimpiarPagination === '/admin/ajustes/administradores'}">
                    <div class="d-inline-flex">
                        <i class="fas fa-cog my-auto pr-1"></i>
                        <p class="p-2" :class="{ 'active': urlLimpiarPagination === '/admin/ajustes/administradores'}">Ajustes</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-2 pb-2">
                <Link :href="route('logout')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-power-off my-auto pr-1"></i>
                        <p class="p-2">Cerrar Sesión</p>
                    </div>
                </Link>
            </li>
        </ul>
    </div>
</aside>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Link
    },
    computed:{
        urlLimpiarPagination(){
            let url = this.$page.url;
            return url.split("?","1")[0];
        },
        urlColaboradores(){
            let url = this.$page.url;
            let url1 = url.includes('/admin/colaboradores')
            let url2 = url.includes('/admin/colaborador/')
            let url3 = url.includes('/admin/crear/colaborador')
            let url4 = url.includes('/admin/editar/colaborador/')
            let url5 = url.includes('/alojamiento')
            let url6 = url.includes('/admin/ventas/totales')
            if(url1 || url2 || url3 || url4 || url5 || url6){
                return true;
            }
            return false;
        },
        urlSouvenirs(){
            let url = this.$page.url;
            let url1 = url.includes('/admin/souvenirs')
            if(url1){
                return true;
            }
            return false;
        },
        urlActividades(){
            let url = this.$page.url;
            let url1 = url.includes('/admin/activities')
            let url2 = url.includes('tablero/actividades/')
            if(url1 || url2){
                return true;
            }
            return false;
        }
    }
}
</script>

<style scoped>
.active{
    color:#70baf7;
}
#sidebar{
    height: 100vh;
    position: sticky;
    top: 0;
    left: 0;
    background-color: #fafafa;
}
#sidebar .items li p{
    line-height: 20px;
}
#sidebar .items .link:hover,
#sidebar .items p:hover{
    color: #70baf7;
}
@media (min-width:1300px){
    #sidebar .items li i{
        font-size: 20px;
    }
    #sidebar .items li p{
        font-size: 16px;
    }
    #sidebar .items .item{
        margin: 16px 0;
    }
}
</style>