<template>
    <nav id="collaborator-sidebar" class="fixed z-30 w-3/4 md:w-1/5 text-white bg-collaborator h-screen rounded-r-3xl flex flex-column">
        <div class="nav-logo flex flex-row">
            <i class="fas fa-times sidebarCollapse text-white cursor-pointer h-12 mt-8 w-12 mx-6 text-xl"></i>
            <img class="w-24 md:w-36 mr-auto grow mt-3.5 lg:mx-auto lg:mt-12" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
        </div>
        <ul class="list-unstyled p-4 my-auto">  
            <li class="mb-3.5">
                <a href="#" class="text-base">
                    <i class="fas fa-home mr-1 text-white"></i>
                    Inicio
                </a>
            </li>
            <li class="mb-3.5">
                <a href="#" class="text-base">
                    <i class="fas fa-building mr-1 text-white"></i>
                    Gestión de alojamientos
                </a>
            </li>
            <li class="mb-3.5">
                <a href="#sub-recursos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <i class="fas fa-file text-white mr-2"></i> Recursos</a>
                <ul class="collapse list-unstyled pl-4" id="sub-recursos">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a href="#sub-ventas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <i class="fas fa-chart-bar text-white mr-2"></i> Ventas</a>
                <ul class="collapse list-unstyled pl-4" id="sub-ventas">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a href="#sub-perfil" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-base">
                <i class="fas fa-user text-white mr-2"></i> Ajustes de perfil</a>
                <ul class="collapse list-unstyled pl-4" id="sub-perfil">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                </ul>
            </li>
            <li class="mb-3.5">
                <a :href="route('logout')" class="text-base">
                    <i class="fas fa-power-off mr-1 text-white"></i>
                    Cerrar Sesión
                </a>
            </li>
        </ul>
        <div class="nav-info text-center my-auto">
            <h1 class="text-2xl font-weight-bolder text-white">?</h1>
            <p class="text-base text-white">¿Necesitas ayuda?</p>
            <p class="text-sm text-white">
                Encontraras atención especializada<br>
                llamando al siguiente teléfono:
            </p>
            <p class="text-sm text-white"><i class="fas fa-phone-alt mr-1 text-white"></i> (+34) 722 193 903</p>
            <div class="mt-2 mx-10" style="border:1px solid #fff">
                <i class="fas fa-comment-dots text-white mr-1"></i>
                <p class="inline text-white font-bold">¡Danos feedback!</p>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
	
}
</script>
<style scoped>
@media (min-width: 1024px){
    .nav-logo i{
        display: none;
    }
}
</style>