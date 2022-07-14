<template>
    <section id="admin-associate" class="container py-8 ml-2 md:ml-0 md:px-24">
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
                    Gestión de anfitriones
	            </h1>
	        </div>
	    </div>
        <div class="mx-1.5 lg:mx-0 row mt-8">
            <div class="col-12 col-md-6">
                <div class="search-admin w-100 rounded-xl shadow px-2 py-3 relative collaborator-box">
                    <i class="fas fa-search absolute left-0 inset-y-1/3 px-2"></i>
                    <input
                        class="w-100 pl-6"
                        placeholder="Buscar anfitrión"
                    >
                </div>
            </div>
            <div class="col-12 col-md-6 flex justify-content-center align-items-center mt-8 mt-md-0">
                <button class="bg-collaborator-orange text-white font-semibold block py-1.5 rounded px-4" @click.prevent="openModalRegister">+ Añadir anfitrión</button>
            </div>
        </div>
        <div class="mx-1.5 lg:mx-0 mt-8 table-responsive-md text-xs">
            <div class="w">
                <div class="w-full">
                    <div class="row mx-0 justify-content-start">
                        <div class="col-2 text-left text-muted">
                            Usuario
                        </div>
                        <div class="col-4 text-left text-muted">
                            Estado
                        </div>
                        <div class="col-2 text-center text-muted">
                            Inmuebles
                        </div>
                        <div class="col-2 text-center text-muted">
                            Pedidos
                        </div>
                         <div class="col-2 text-center text-muted">
                            Beneficios
                        </div>
                    </div>
                    <div class="row mx-0 mt-1">
                        <div class="col-12 mx-0 my-2">
                            <div
                                class="row shadow-md rounded-md py-2 px-2 bg-item cursor-pointer"
                            >
                                 <div class="col-2 text-left">
                                    <span class="font-bold block">Usuario</span>
                                    <span class="mt-1 block">usuario@gmail.com</span>
                                </div>
                                <div class="col-4 flex align-items-center px-0">
                                    <div class="dropdown w-60 mr-2">
                                        <div
                                            class="color-complet rounded py-2 px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-profile"
                                        >
                                            <span class="inline-block">Perfil completo</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-profile">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Ajustes del perfil
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                        >
                                                        Información de perfil
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                                                        >
                                                        Datos fiscales
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Información bancaria
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Datos de envío
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown w-60">
                                        <div
                                            class="color-incomplet text-white py-2 rounded px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-resource"
                                        >
                                            <span class="inline-block">Recursos por usar</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-resource">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Recursos
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                        >
                                                        Banner descargado
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                        >
                                                        Url generada    
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Displays pedidos
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Displays enviados
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="font-bold inline-block">3</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">153</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">2000.02 €</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mx-0 my-2">
                            <div
                                class="row shadow-md rounded-md py-2 px-2 bg-item cursor-pointer"
                            >
                                 <div class="col-2 text-left">
                                    <span class="font-bold block">Usuario</span>
                                    <span class="mt-1 block">usuario@gmail.com</span>
                                </div>
                                <div class="col-4 flex align-items-center px-0">
                                    <div class="dropdown w-60 mr-2">
                                        <div
                                            class="color-complet rounded py-2 px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-profile"
                                        >
                                            <span class="inline-block">Perfil completo</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-profile">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Ajustes del perfil
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                        >
                                                        Información de perfil
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                                                        >
                                                        Datos fiscales
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Información bancaria
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Datos de envío
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown w-60">
                                        <div
                                            class="color-incomplet text-white py-2 rounded px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-resource"
                                        >
                                            <span class="inline-block">Recursos por usar</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-resource">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Recursos
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                        >
                                                        Banner descargado
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                        >
                                                        Url generada    
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Displays pedidos
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Displays enviados
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="font-bold inline-block">3</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">153</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">2000.02 €</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mx-0 my-2">
                            <div
                                class="row shadow-md rounded-md py-2 px-2 bg-item cursor-pointer"
                            >
                                 <div class="col-2 text-left">
                                    <span class="font-bold block">Usuario</span>
                                    <span class="mt-1 block">usuario@gmail.com</span>
                                </div>
                                <div class="col-4 flex align-items-center px-0">
                                    <div class="dropdown w-60 mr-2">
                                        <div
                                            class="color-complet rounded py-2 px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-profile"
                                        >
                                            <span class="inline-block">Perfil completo</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-profile">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Ajustes del perfil
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                        >
                                                        Información de perfil
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                                                        >
                                                        Datos fiscales
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Información bancaria
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Datos de envío
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown w-60">
                                        <div
                                            class="color-incomplet text-white py-2 rounded px-2 dropdown-toggle flex justify-content-between" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdown-resource"
                                        >
                                            <span class="inline-block">Recursos por usar</span><i class="fas fa-caret-down inline-block"></i>
                                        </div>
                                        <div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" aria-labelledby="dropdown-resource">
                                            <div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
                                                Recursos
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                        >
                                                        Banner descargado
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                        >
                                                        Url generada    
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                        >
                                                        Displays pedidos
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                                                    >
                                                </li>
                                                <li class="list-group-item flex justify-content-between">
                                                    <span class="text-black">
                                                        <img
                                                            class="inline w-3 icon-filter"
                                                            style="margin-top:-4px" 
                                                            src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                        >
                                                        Displays enviados
                                                    </span>
                                                    <img
                                                        class="inline w-3 icon-filter icon-filter"
                                                        style="margin-top:-4px" 
                                                        src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="font-bold inline-block">3</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">153</span>
                                </div>
                                <div class="col-2 flex justify-content-center align-items-center">
                                    <span class="inline-block">2000.02 €</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div
            v-if="associates.length > 0"
            class="row justify-content-center"
        >
            <div class="col-12 col-lg-6">
                <paginator :paginator="[]" />
            </div>
        </div>
        <div class="modal modal-notification fade" id="register-associate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-register mx-auto">
                    <div class="modal-header rounded-t-xl py-2 px-2 m-0 bg-collaborator-orange">
                        <h1 class="font-bold text-white inline-block text-lg lg:text-xl">
                            <img class="inline w-7 mr-2" style="margin-top:-4px;"
                                src="/vendor_asset/img/collaborator/dashboard/icons/gestionaloj.svg"
                            >
                            Registrar anfitrión
                        </h1>
                    </div>
                    <div class="modal-body px-2 py-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-10 my-1.5 px-0">
                                        <label  class="font-bold">Correo electrónico <span class="required-input">*</span></label>
                                        <div class="collaborator-box relative">
                                            <i class="fas fa-envelope absolute left-0 inset-y-1/3 px-2"></i>
                                            <input type="text" class="w-100 rounded col-form-input py-1.5 pl-8" placeholder="Correo electrónico...">
                                        </div>
                                    </div>
                                    <div class="col-10 my-1.5 px-0">
                                        <label  class="font-bold">Contraseña <span class="required-input">*</span></label>
                                        <div class="collaborator-box relative">
                                            <i
                                                class="cursor-pointer absolute right-0 inset-y-1/3 px-2"
                                                :class="showPass ? 'fas fa-eye-slash' : 'fas fa-eye'"
                                                @click="showPass = !showPass"
                                            ></i>
                                            <i class="fas fa-key absolute left-0 inset-y-1/3 px-2"></i>
                                            <input :type="showPass ? 'text' : 'password'" class="w-100 rounded col-form-input py-1.5 pl-8 pr-8"  placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-10 my-1.5 px-0">
                                        <label  class="font-bold">Nombre <span class="required-input">*</span></label>
                                         <div class="collaborator-box relative">
                                            <i class="fas fa-user absolute left-0 inset-y-1/3 px-2"></i>
                                            <input type="text"  class="w-100 rounded col-form-input py-1.5 pl-8" placeholder="Nombre...">
                                        </div>
                                    </div>
                                    <div class="col-10 my-1.5 px-0">
                                        <label  class="font-bold">Número de contacto <span class="required-input">*</span></label>
                                        <div class="collaborator-box relative">
                                            <i class="fas fa-phone-alt absolute left-0 inset-y-1/3 px-2"></i>
                                            <input type="text" class="w-100 rounded col-form-input py-1.5 pl-8" placeholder="Número de contacto...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1.5 px-2 flex justify-content-between">
                            <button class="btn px-3.5 text-gray-500 py-1 text-xs font-bold inline-block" @click="closeModalRegister">
                                <i class="fas fa-reply"></i>
                                Volver
                            </button>
                            <button
                                type="submit"
                                class="btn inline-block rounded text-white bg-collaborator-orange py-1 px-6"
                                @click.prevent="submit"
                            >
                                <i class="fas fa-save mr-2 text-white">
                                    </i>Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    layout:Layout, 
	components: {
		Paginator,
		Link,
    },
    props: {
        associates: {
            type: Array,
            default: () => ([]),
        }
    },
    data() {
        return {
            showPass: false,
        }
    },
    methods: {
        openModalRegister () {
            $('#register-associate').modal({show: true, backdrop: 'static', keyboard: false})
        },
        closeModalRegister () {
            $('#register-associate').modal('hide')
        },
    },
}
</script>

<style lang="scss" scoped>
    .bg-item{
        background-color: #d9d9d9;
    }
    .w{
        min-width: 900px;
    }
    .color-complet{
        background-color: #b7ffc7;
    }
    .color-incomplet{
        background-color: #ff7878;
    }

    .setting-profile {
        top: 3.2rem;
        left: 0;
        width: 250px;
    }

    .modal-dialog{
        max-width: 90%;
    }

    .icon-filter{
        filter: invert(100%) sepia(100%) saturate(100%) hue-rotate(330deg) brightness(100%) contrast(57%);
    }

    @media(min-width:767px){
        .w{
            min-width: 600px;
        }
        .modal-dialog{
            max-width: 25%;
        } 
    }

</style>