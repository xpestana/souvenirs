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
                               <Link class="view-cart bg-info" :href="route('cart')">Ver Carrito</Link>
                           </div>
                       </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li><Link class="nav-link" data-toggle="tab" :href="route('dashboard')">Detalles de la Cuenta</Link></li>
                            <li><Link class="nav-link" data-toggle="tab" :href="route('dashboard.hotels')">Hoteles Registrados</Link></li>
                            <li><Link class="nav-link" data-toggle="tab" :href="route('dashboard.shopping')">Compras</Link></li>
                            <li><Link class="nav-link"  @click.prevent="logout">Cerrar Sesión</Link></li>
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
    created(){
        console.log(this.$page.props.auth.user.email);
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
    }
}

</script>