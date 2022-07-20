<template>
    <section id="admin-show-associate" class="container pt-8  ml-2 md:ml-0 md:px-24" >
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    {{user.profile.firstname}}
                </h1>
            </div>
        </div>
        <div class="breadcrumb-associate row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de partners / <b>{{user.profile.firstname}}</b></p>
            </div>
        </div>
         <!--END Header-->
        <div class="benefit-associate row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="d-lg-inline mr-lg-4"><b>Facturación total: </b>{{ total.toFixed(2) }}€</p>
                <p class="d-lg-inline mr-lg-4"><b>Beneficio total: </b>{{ (total*0.20).toFixed(2) }}€</p>
                <p class="d-lg-inline"><b>Pedidos totales: </b>{{ orders.length}}</p>
            </div>
        </div>
       
    </section>

    <section id="show-associate-body" class="container  ml-2 md:ml-0 md:px-24" >
       <div class="row">
        <div class="col-12 col-lg-6 lg:pr-8">
            <div class="body-card bg-gray-100 p-4 rounded-md">
                <i class="fas fa-user inline-block mr-2.5 text-lg"></i>
                <h2 class="font-semibold text-lg inline-block text-negro">Datos del perfil</h2>
                <div class="pl-8">
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.profile',{user:user.id})">
                        Información del perfil
                        <template v-if="associate.completInformation">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.tax',{user:user.id})">
                        Datos fiscales
                        <template v-if="associate.completedNif">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.bank',{user:user.id})">
                        Información bancaria
                        <template v-if="associate.completedBank">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.shipping',{user:user.id})">
                        Datos de envío
                        <template v-if="associate.completedShipping">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 lg:pr-8 mt-4 mt-lg-0">
            <div class="body-card bg-gray-100 p-4 rounded-md">
                <img class="inline w-4 mr-2.5" style="margin-top:-4px"
                    src="/vendor_asset/img/admin/icons/adminrecursos.svg"
                >
                <h2 class="font-semibold text-lg inline-block text-negro">Recursos</h2>
                <div class="pl-8">
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.resources',{user:user.id})">
                        Banner descargado
                        <template v-if="associate.completedBanner">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.resources',{user:user.id})">
                        URL Generada
                        <template v-if="associate.completedUrl">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.resources',{user:user.id})">
                        Displays pedidos
                        <template v-if="associate.completedRequestDisplay">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                    <Link class="py-2 relative block text-muted associate-link" :href="route('admin.associate.resources',{user:user.id})">
                        Displays enviados
                        <template v-if="associate.completedReseivedDisplay">
                            <i class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        </template>
                        <template v-else>
                            <i class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                        </template>
                    </Link>
                </div>
            </div>
        </div>
       </div>
       <div class="row mt-4">
        <div class="col-12 col-lg-6 lg:pr-8">
            <div class="body-card bg-gray-100 p-4 rounded-md h-36">
                <img class="inline w-5 mr-2.5" style="margin-top:-4px"
                    src="/vendor_asset/img/admin/icons/adminalojamiento.svg"
                >
                <h2 class="font-semibold text-lg inline-block text-negro">SERVICIOS ENLAZADOS</h2>
                <div class="">
                    <p class="font-semibold text-right text-lg-center mt-6">Próximamente</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 lg:pr-8 my-4 my-lg-0">
            <div class="body-card bg-gray-100 p-4 rounded-md h-36">
                <img class="inline w-4 mr-2.5" style="margin-top:-4px"
                    src="/vendor_asset/img/admin/icons/adminventas.svg"
                >
                <h2 class="font-semibold text-lg inline-block text-negro">Informe de ventas</h2>
                <div class="">
                    <Link :href="route('admin.associate.sales',{user:user.id})" class="block font-semibold text-right mt-14 associate-link">Ver desglose de ventas</Link>
                </div>
            </div>
        </div>
       </div>
    </section>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import Layout from '@/Pages/Admin/Layouts/Layout'
export default {
    layout:Layout,
    components:{
        Link,
    },
    props: {
        orders:Object,
        user:Object,
        associate:Object
    },
    data() {
        return {
            total:0
        }
    },
    created(){
        this.orders.forEach(order =>{
            this.total += Number(order.total); 
        });
        console.log(this.associate)
    },
    methods:{
        goBack () {
            window.history.back()
        },
    }
   
}
</script>

<style scoped>
.text-negro{
    color:#000;
}
.associate-link:hover,
.associate-link:active{
    color:#FF9C06 !important;
}
</style>