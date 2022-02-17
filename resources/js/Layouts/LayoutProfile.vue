<template>
    <Head title="Perfil"/>
	<Layout>
    <Breadcrumb title="Perfil"/>
    <!-- My Account Page Start Here -->
    <div class="my-account white-bg ptb-80">
        <div class="container">
            <div class="account-dashboard">
               <div class="dashboard-upper-info">
                   <div class="row align-items-center no-gutters">
                       <div class="col-xl-3 col-lg-3 col-md-6">
                           <div class="d-single-info">
                               <p class="user-name">Hola <span>{{ $page.props.auth.user.email }}</span></p>
                               <p>(¿No eres tú? <a class="log-out" href="javascript:void(0);" @click.prevent="logout">Logout</a>)</p>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-4 col-md-6">
                           <div class="d-single-info">
                               <p>¿Necesitas ayuda? Atención especializada: </p>
                               <p>admin@example.com</p>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-6">
                           <div class="d-single-info">
                               <p>Dudas a través de: </p>
                               <p>support@example.com</p>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-2 col-md-6">
                           <div class="d-single-info text-lg-center">
                               <Link class="view-cart bg-info" :href="route('cart.index')">Ver Carrito</Link>
                           </div>
                       </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li>
                                <a :class="(route().current('profile.index') === true || route().current('qr.download') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="dashboard">
                                    Detalles de la Cuenta
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('hotels.index') === true || route().current('hotels.create') === true || route().current('hotels.show') === true || route().current('hotels.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="hotels">
                                    Administrador de Hoteles Registrados
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('admin.index') === true || route().current('admin.create') === true || route().current('admin.show') === true || route().current('admin.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="admin">
                                    Gestión de administradores
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('admin.index') === true || route().current('admin.create') === true || route().current('admin.show') === true || route().current('admin.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="ryders">
                                    Gestión de Ryders
                                </a>
                            </li>
                           <!-- <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('categories.index') === true || route().current('categories.create') === true || route().current('categories.show') === true || route().current('categories.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="categories">
                                    Gestión de categorías
                                </a>
                            </li>-->
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('souvenirs.index') === true || route().current('souvenirs.create') === true || route().current('souvenirs.show') === true || route().current('souvenirs.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="souvenirs">
                                    Gestión de Souvenirs
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('activities.index') === true || route().current('activities.create') === true || route().current('activities.show') === true || route().current('activities.edit') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="activity">
                                    Gestión de Actividades
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Hotel'">
                                <a :class="(route().current('dashboard.shopping') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="sales_hotel">
                                    Mis Ventas
                                </a>
                            </li>
                            <li v-if="$page.props.auth.role == 'Admin'">
                                <a :class="(route().current('dashboard.shopping') === true)? 'active nav-link' : 'nav-link text-info'" data-toggle="tab" href="javascript:void(0)" @click.prevent="sales_admin">
                                    Mis Ventas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link text-info" href="javascript:void(0)" @click.prevent="logout">
                                    Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10">
                        <!-- Tab panes -->
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account Page End Here -->

    </Layout>
</template>

<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Layout.vue'
import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'      
export default {
    components: {
        Head,
        Link,
        Layout,
        Breadcrumb,
    },
    methods: {
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
        logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
        },
        dashboard(){
                this.$inertia.get(route('profile.index'),{}, {
                    preserveScroll: true
                })
        },
        hotels(){
                this.$inertia.get(route('hotels.index'),{}, {
                    preserveScroll: true
                })
        },
        admin(){
                this.$inertia.get(route('admin.index'),{}, {
                    preserveScroll: true
                })
        },
        activity(){
                this.$inertia.get(route('activities.index'),{}, {
                    preserveScroll: true
                })
        },
        souvenirs(){
                this.$inertia.get(route('souvenirs.index'),{}, {
                    preserveScroll: true
                })
        },
        sales_hotel(){
                this.$inertia.get(route('purchases.hotel'),{}, {
                    preserveScroll: true
                })
        },
        sales_admin(){
                this.$inertia.get(route('purchases.admin'),{}, {
                    preserveScroll: true
                })
        },
        ryders(){
                this.$inertia.get(route('ryders.index'),{}, {
                    preserveScroll: true
                })
        },
    }
}

</script>