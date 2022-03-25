<template>
<aside id="sidebar" class="d-none d-md-block px-lg-3">
    <div class="logo py-4">
        <img class="m-auto" src="/vendor_asset/img/logo/logo.png" alt="logo" height="130" width="130">
    </div>
    <div class="items">
        <ul>
            <li class="mb-3 pl-2 pb-2">
                <Link :href="route('admin.colaboradores')" class="link" :class="{ 'active': $page.url === '/admin/colaboradores' }">
                    <div class="d-inline-flex">
                        <i class="fas fa-city my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder" :class="{ 'active': $page.url === '/admin/colaboradores' }">Gestor de colaboradores</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 pl-2 pb-2">    
                <Link :href="route('admin.home')" class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-biking my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder">Gestión de actividades</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 pl-2 pb-2">
                <Link :href="route('admin.home')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-gift my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder">Gestión de souvenirs</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 pl-2 pb-2">
                <Link :href="route('admin.home')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-shopping-cart my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder">Mis ventas</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 pl-2 pb-2">
                <Link :href="route('admin.home')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-cog my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder">Ajustes</p>
                    </div>
                </Link>
            </li>
            <li class="mb-3 pl-2 pb-2">
                <Link :href="route('logout')"  class="link">
                    <div class="d-inline-flex">
                        <i class="fas fa-power-off my-auto pr-1"></i>
                        <p class="p-2 font-weight-bolder">Cerrar Sesión</p>
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
</style>