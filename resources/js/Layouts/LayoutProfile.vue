<template>
    <Head title="Perfil"/>
	<Layout>

    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Perfil</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
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
                            <li><a class="nav-link active" data-toggle="tab" href="#hotels">Hoteles Registrados</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#account-details">Detalles de la Cuenta</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#orders">Compras</a></li>
                            <li><Link class="nav-link"  @click.prevent="logout">Logout</Link></li>
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
export default {
    components: {
        Head,
        Link,
        Layout,
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