<template>
    <section id="admin-collaborator-show" class="container pt-8 pb-4 ml-2 md:ml-0 md:px-14">
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    Usuario {{ user.id }}
	            </h1>
	        </div>
	    </div>
        <div class="my-4 mx-1.5 lg:mx-0">
             <span class="text-muted font-light">Gestor de anfitrión</span> <span class="text-muted font-bold">/ Usuario {{ user.id }}</span>
        </div>
        <div class="mx-1.5 lg:mx-0 lg:flex mb-8 justify-content-lg-start text-lg-left pt-2 pt-lg-0">
            <p class="block mr-4"><b>Facturación total: </b>{{ order.total.toFixed(2) }}€</p>
            <p class="block mr-4"><b>Beneficio total: </b>{{( order.total*0.20).toFixed(2) }}€</p>
            <p class="block"><b>Pedidos totales: </b>{{ order.count }}</p>
        </div>
        <div class="row mx-1.5 lg:mx-0 justify-center">
            <div class="card-profile col-12 col-md-5 bg-header-collaborator mr-md-5 mr-0 mt-2 mb-4 px-4 py-4 rounded">
                <div class="text-lg md:text-xl font-bold">
                    <i class="mr-2 fas fa-user"></i>
                    Datos del perfil
                </div>
                <div class="mt-4 ml-4 md:text-lg">
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Información de perfil
                        </Link>
                        <i v-if="user.completInformation" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Datos fiscales
                        </Link>
                        <i v-if="user.completedNif" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Información bancaria
                        </Link>
                        <i v-if="user.completedBank" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Datos de envio
                        </Link>
                        <i v-if="user.completedBank" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                </div>
            </div>
            <div class="card-resource col-12 col-md-5 bg-header-collaborator mr-0 mt-2 mb-4 px-4 py-4 rounded">
                <div class="text-lg md:text-xl font-bold">
                    <i class="mr-2 fas fa-file"></i>
                    Recursos
                </div>
                <div class="mt-4 ml-4 md:text-lg">
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Banner descargado
                        </Link>
                        <i v-if="user.completedBanner" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Url generada
                        </Link>
                        <i v-if="user.completedUrl" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between mb-4 px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Displays pedidos
                        </Link>
                        <i v-if="user.completedRequestDisplay" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                    <div class="flex justify-content-between px-4">
                        <Link
                            href="#"
                            class="text-muted font-regular"
                        >
                            Displays enviados
                        </Link>
                        <i v-if="user.completedReseivedDisplay" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
						<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 bg-header-collaborator mr-0 mr-md-5 mt-2 mb-2 px-4 py-4 rounded">
                <div class="text-lg md:text-xl font-bold">
                    <i class="mr-2 fas fa-file"></i>
                    Alojamientos
                </div>
                <div class="mt-2 ml-4 md:text-lg">
                    <div class="flex justify-content-between mb-4 px-4">
                        <span class="text-grey-400">Dados de alta: {{user.hotel.length}}</span>
                    </div>
                </div>
                <div class="md:text-lg mt-4 text-center text-md-right">
                    <Link
                        :href="`/admin/colaborador/${user.id}/alojamientos`"
                        class="font-bold"
                    >
                        Ver alojamientos
                    </Link>
                </div>
            </div>
            <div class="col-12 col-md-5 bg-header-collaborator mr-0 mt-2 mb-2 px-4 py-4 rounded">
                <div class="text-lg md:text-xl md:text-xl font-bold">
                    <i class="mr-2 fas fa-file"></i>
                    Informe de ventas
                </div>
                <div class="mt-2 ml-4 md:text-lg">
                    <div class="flex invisible justify-content-between mb-4 px-4">
                        <span class="text-muted font-semibold">#</span>
                    </div>
                </div>
                <div class="text-lg md:text-xl mt-4 text-center text-md-right">
                    <Link
                        href="#"
                        class="font-bold"
                    >
                        Ver desglose de ventas
                    </Link>
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
                value.total = item.orders.length > 0 ? hotel.item.reduce((acum, currentItem) => {
                    acum += currentValue.total
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