<template>
    <section id="admin-show-anfitrion" class="container pt-8  ml-2 md:ml-0 md:px-24" >
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    {{ user.profile.firstname }} {{user.id}}
                </h1>
            </div>
        </div>
        <div class="breadcrumb-associate row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de anfitriones / <b>{{user.profile.firstname}}</b></p>
            </div>
        </div>
         <!--END Header-->
         <div class="benefit-associate row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="d-lg-inline mr-lg-4"><b>Facturación total:</b>{{ order.total.toFixed(2) }}€</p>
                <p class="d-lg-inline mr-lg-4"><b>Beneficio total:</b>{{( order.total*0.20).toFixed(2) }}€</p>
                <p class="d-lg-inline"><b>Pedidos totales:</b>{{ order.count }}</p>
            </div>
        </div>
       
    </section>
    <section id="show-associate-body" class="container  ml-2 md:ml-0 md:px-24" >
       <div class="row">
        <div class="card-profile mb-4 mb-md-0 col-12 col-lg-6 pr-8">
            <div class="body-card bg-gray-100 p-4 rounded-md">
                <i class="fas fa-user inline-block mr-2.5 text-lg"></i>
                <h2 class="font-semibold text-lg inline-block text-negro">Datos del perfil</h2>
                <div class="pl-8">
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.profile',{id: user.id})"
                    >
                        Información perfil
                        <i v-if="user.completInformation" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
						<i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.tax',{id: user.id})"
                    >
                        Datos fiscales
                        <i v-if="user.completedNif" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
						<i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.bank',{id: user.id})"
                    >
                        Informacion bancaria
                        <i v-if="user.completedBank" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
						<i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.shipping',{id: user.id})"
                    >
                        Datos de envío
                        <i v-if="user.completedShipping" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
						<i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                </div>
            </div>
        </div>
        <div class="card-resource col-12 col-lg-6 pr-8">
            <div class="body-card bg-gray-100 p-4 rounded-md">
                <img class="inline w-4 mr-2.5" style="margin-top:-4px"
                    src="/vendor_asset/img/admin/icons/adminrecursos.svg"
                >
                <h2 class="font-semibold text-lg inline-block text-negro">Recursos</h2>
                <div class="pl-8">
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.profile',{id:user.id})"
                    >
                        Banner descargado
                        <i v-if="user.completedBanner" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.profile',{id:user.id})"
                    >
                        Url generada
                        <i v-if="user.completedUrl" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.profile',{id:user.id})"
                    >
                        Displays pedidos
                        <i v-if="user.completedRequestDisplay" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                    <Link
                        class="py-2 relative block text-muted"
                        :href="route('admin.collaborator.profile',{id:user.id})"
                    >
                        Displays enviados
                        <i v-if="user.completedReseivedDisplay" class="fas fa-check-circle pl-1 absolute right-6 top-2.5 text-xs text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 absolute right-6 top-2.5 text-xs text-danger"></i>
                    </Link>
                </div>
            </div>
        </div>
       </div>
       <div class="row mt-4">
        <div class="col-12 col-lg-6 pr-8 mb-4 mb-md-0">
            <div class="body-card bg-gray-100 p-4 rounded-md h-36">
                <img class="inline w-5 mr-2.5" style="margin-top:-4px"
                    src="/vendor_asset/img/admin/icons/adminalojamiento.svg"
                >
                <h2 class="font-semibold text-lg inline-block text-negro">Alojamientos</h2>
                <div claSs="my-4 text-left">
                    <span class="text-grey-400">Dados de alta: {{user.hotel.length}}</span>
                </div>
                <div class="text-center text-md-right">
                    <Link
                        :href="`/admin/colaborador/${user.id}/alojamientos`"
                        class="font-semibold text-right mt-14"
                    >
                        Ver alojamientos
                    </Link>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 pr-8">
            <div class="body-card bg-gray-100 p-4 rounded-md">
                <div>
                    <img class="inline w-4 mr-2.5" style="margin-top:-4px"
                        src="/vendor_asset/img/admin/icons/adminventas.svg"
                    >
                    <h2 class="font-semibold text-lg inline-block text-negro">Informe de ventas</h2>
                </div>
                <div clasS="my-4 invisible">
                    #222
                </div>
                <div class="text-center text-md-right">
                    <Link
                        :href="route('admin.collaborator.sales-total', {id: user.id})"
                        class="font-semibold"
                    >
                        Ver desglose de ventas
                    </Link>
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
        user: {
            type: Object,
            default: () => ({}),
        }
    },
    data() {
        return {
        }
	},
	computed: {
        order () {
            var value = {count: 0, total: 0}
            this.user.hotel.forEach(item => {
                value.count += item.orders.length
                value.total += item.orders.length > 0 ? item.orders.reduce((acum, currentItem) => {
                    acum += Number(currentItem.total)
                    return acum
                }, 0) : 0
            })
            return value
        },
	},
	mounted(){
	},
    methods: {
        goBack () {
            window.history.back()
        },
    },
}
</script>

<style lang="scss" scoped>
    .card-profile a:hover, .card-resource a:hover{
        color: #FF9C06 !important;
        font-weight: 600;
    }
</style>