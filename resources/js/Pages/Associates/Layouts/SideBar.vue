<template>
<aside id="sidebar" class="d-none d-md-block px-lg-3">
    <div class="logo pb-4 pt-16 mb-5">
        <img class="m-auto" src="/vendor_asset/img/logo/hilogo.png" alt="logo">
    </div>
    <div class="items">
        <ul>
            <li class="mb-3 item pl-1 pb-2">
                <Link :href="route('associates.collaborations')" class="link" :class="{'active':this.$page.url.includes('/colaboraciones')}">
                    <div class="d-inline-flex">
                        <i class="fas fa-mobile-alt my-auto pr-2 text-lg"></i>
                        <p class="p-2" :class="{'active':this.$page.url.includes('/colaboraciones')}">Colaboración</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pb-2">
                <Link :href="route('associates.index')" class="link" :class="{'active':this.$page.url.includes('/servicios')}">
                    <div class="d-inline-flex">
                        <i class="fas fa-biking my-auto pr-1 text-lg"></i>
                        <p class="p-2"  :class="{'active':this.$page.url.includes('/servicios')}">Servicios prestados</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-1 pb-2">
                <Link :href="route('associates.settings')"  class="link" :class="{'active':this.$page.url.includes('/ajustes')}">
                    <div class="d-inline-flex">
                        <i class="fas fa-cog my-auto pr-2 text-lg"></i>
                        <p class="p-2" :class="{'active':this.$page.url.includes('/ajustes')}">Ajustes</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 item pl-1 pb-2">
                <Link :href="route('logout')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-power-off my-auto pr-2  text-lg"></i>
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
            // let url = this.$page.url;
            // return url.split("?","1")[0];
        },
        urlsFilter(){
            let url = this.$page.url;
            let url1 = url.includes('/admin/ventas')
            if(url1){
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