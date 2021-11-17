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
                               <p class="user-name">Hola <span>mail@info.com</span></p>
                               <p>(¿No eres tú? <Link class="log-out" :href="route('login')">Logout</Link>)</p>
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
                               <Link class="view-cart bg-info" :href="route('carrito')">Ver Carrito</Link>
                           </div>
                       </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#account-details">Detalles de la Cuenta</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#orders">Compras</a></li>
                            <li><Link class="nav-link" :href="route('login')">Logout</Link></li>
                        </ul>
                    </div>
                    <div class="col-lg-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content mt-all-40">
                            <div id="account-details" class="tab-pane fade show active">
                                <h3>Detalles de la Cuenta</h3>
                                <div class="register-form login-form clearfix">
                                    <form action="#">
                                        <div class="form-group row align-items-center">
                                            <label class="col-lg-3 col-md-4 col-form-label">Género</label>
                                            <div class="col-lg-6 col-md-8">
                                                <span class="custom-radio"><input name="id_gender" value="1" type="radio"> H</span>
                                                <span class="custom-radio pl-1"><input name="id_gender" value="1" type="radio"> M</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="f-name" class="col-lg-3 col-md-4 col-form-label">Nombre</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="f-name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="l-name" class="col-lg-3 col-md-4 col-form-label">Apellido</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="l-name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">E-Mail</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newpassword" class="col-lg-3 col-md-4 col-form-label">Nueva Contraseña</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="password" class="form-control" id="newpassword">
                                                <button class="btn show-btn" type="button" v-on:click="showPass('newpassword')">Ver</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="c-password" class="col-lg-3 col-md-4 col-form-label">Confirmar Contraseña</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="password" class="form-control" id="c-password">
                                                <button class="btn show-btn" type="button" v-on:click="showPass('c-password')">Ver</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="birth" class="col-lg-3 col-md-4 col-form-label">Fecha Nacimiento</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="birth" placeholder="MM/DD/YYYY">
                                            </div>
                                        </div>
                                        <div class="form-check row p-0 mt-20">
                                            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-4">
                                                <input class="form-check-input" value="#" id="offer" type="checkbox">
                                                <label class="form-check-label" for="offer">¿Desea recibir ofertas por correo?</label>
                                            </div>
                                        </div>
                                        <div class="form-check row p-0 mt-20">
                                            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-4">
                                                <input class="form-check-input" value="#" id="subscribe" type="checkbox">
                                                <label class="form-check-label" for="subscribe">Suscribirse a nuestro boletín<br>Suscríbite y manténte al tanto de nuestras novedades</label>
                                            </div>
                                        </div>
                                        <div class="register-box mt-40">
                                            <button type="submit" class="return-customer-btn float-right bg-info">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="orders" class="tab-pane fade">
                                <h3>Compras</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                            <tr>
                                                <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;">1</td>
                                                <td style="font-size: 15px;">165 €</td>
                                                <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('carrito')">Ver</Link></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    methods: {
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        }
    }
}

</script>