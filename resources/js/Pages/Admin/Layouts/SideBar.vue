<template>
<!-- route('admin.colaboradores')
route('admin.associates')
route('admin.activities')
route('admin.souvenirs')
route('admin.sales')
route('admin.administradores')" -->
                
    <nav id="collaborator-sidebar" class="fixed z-40 w-3/4 lg:w-1/5 text-white bg-collaborator h-screen rounded-r-3xl flex flex-column overflow-auto">
        <div class="nav-logo flex flex-row mb-11">
            <i class="fas fa-times sidebarCollapse text-white cursor-pointer h-12 mt-8 w-12 mx-6 text-xl"></i>
            <img class="w-24 md:w-36 mr-auto grow mt-3.5 lg:mx-auto lg:mt-12" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
        </div>
        <ul class="list-unstyled py-4 pl-8 2xl:pl-11 mb-auto">  
            <li class="mb-6">
                <Link :href="route('admin.colaboradores')" class="text-base link sidebar-collapse-menu-mobile" 
                    :class="{'sidebar-active':urlColaboradores}">
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':urlColaboradores}" 
                        src="/vendor_asset/img/collaborator/dashboard/icons/gestionaloj.svg"
                    >
                    Gestión de anfitriones
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('admin.associates')" class="text-base link sidebar-collapse-menu-mobile" 
                    :class="{'sidebar-active':urlAssociates}"
                >
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':urlAssociates}" 
                        src="/vendor_asset/img/admin/icons/partners.svg"
                    >
                    Gestión de partners
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('admin.activities')" class="text-base link sidebar-collapse-menu-mobile" 
                        :class="{'sidebar-active':urlActividades}"
                >
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':urlActividades}" 
                        src="/vendor_asset/img/admin/icons/experiencias.svg"
                    >
                    Gestión de experiencias
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('admin.souvenirs')" class="text-base link sidebar-collapse-menu-mobile" 
                    :class="{'sidebar-active':urlSouvenirs}">
                    <img class="inline w-4" style="margin-top:-4px"
                        :class="{'side-icon-active':urlSouvenirs}" 
                        src="/vendor_asset/img/admin/icons/souvenirs.svg"
                    >
                    Gestión de souvenirs
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('admin.sales')" class="text-base link sidebar-collapse-menu-mobile" 
                    :class="{'sidebar-active':urlVentas}"
                >
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':urlVentas}"
                        src="/vendor_asset/img/collaborator/dashboard/icons/ventas.svg"
                    >
                    Mis ventas
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('admin.administradores')" class="text-base link sidebar-collapse-menu-mobile" 
                    :class="{'sidebar-active':urlLimpiarPagination === '/admin/ajustes/administradores'}"
                >
                    <img class="inline w-5" style="margin-top:-4px"
                        :class="{'side-icon-active':urlLimpiarPagination === '/admin/ajustes/administradores'}"
                        src="/vendor_asset/img/admin/icons/ajustes.svg"
                    >
                    Ajustes
                </Link>
            </li>
            <li class="mb-6">
                <Link :href="route('logout')" class="text-base link  sidebar-collapse-menu-mobile">
                    <img class="inline w-4" style="margin-top:-4px"
                        src="/vendor_asset/img/collaborator/dashboard/icons/cerrar.svg"
                    >
                    Cerrar Sesión
                </Link>
            </li>
        </ul>
    </nav>
 
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Link
    },
    mounted(){
        $('.sidebarCollapse').on('click', function () {
            $('#collaborator-sidebar').toggleClass('active');
            $('#layout-collaborator-dashboard').toggleClass('collaborator-dashboard-overlay');
        });
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
            let url1 = url.includes('/admin/activities/')
            let url2 = url.includes('tablero/actividades/')
            let url3 = url.includes('tablero/activities/')
            if(url1 || url2 || url3){
                return true;
            }
            return false;
        },
        urlVentas(){
            let url = this.$page.url;
            let url1 = url.includes('/admin/ventas')
            if(url1){
                return true;
            }
            return false;
        },
        urlAssociates(){
            let url1 = this.$page.url.includes('/admin/asociados')
            let url2 = this.$page.url.includes('/admin/asociado')
            if(url1 || url2){
                return true;
            }
            return false;
        }
    }
}
</script>
<style scoped>
nav::-webkit-scrollbar {display: none;}
.sidebar-active{
    color:#000 !important;
}
.side-icon-active{ 
  filter: invert(100%) sepia(100%) saturate(100%) hue-rotate(330deg) brightness(100%) contrast(57%);
}
.icon-active{
    filter: invert(0%) sepia(0%) saturate(7465%) hue-rotate(248deg) brightness(95%) contrast(109%);
}
.icon-img:hover{
    filter: invert(0%) sepia(0%) saturate(7465%) hue-rotate(248deg) brightness(95%) contrast(109%);
}
.bg-collaborator-orange{
    background-color: #FF9C06;
}
@media (min-width: 1024px){
    .nav-logo i{
        display: none;
    }
}
</style>
                
