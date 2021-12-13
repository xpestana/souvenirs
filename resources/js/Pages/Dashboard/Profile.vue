<template>
    <Layout>
    <div class="tab-content dashboard-content mt-all-40">
        <div id="account-details" class="tab-pane fade show active">
            <div class="row mb-4" v-if="$page.props.auth.role == 'Hotel'">
                <div class="col-md-12">
                    <h3>Mis codigos QR:  <Link class="view-cart bg-info mt-3 ml-4" :href="route('qr.download')" ><small>Descargar QR</small></Link></h3>
                </div>
            </div>
            <h3>Detalles de la Cuenta</h3>
            <div class="register-form login-form clearfix">
                <form  @submit.prevent="submit">
                    <div class="form-group row align-items-center">
                        <label class="col-lg-3 col-md-4 col-form-label">Género</label>
                        <div class="col-lg-6 col-md-8">
                            <span class="custom-radio">
                                <input name="gender" v-model="form.gender" value="M" type="radio"> H
                            </span> 
                            <span class="custom-radio pl-1">
                                <input name="gender" v-model="form.gender" value="F" type="radio"> M
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="f-name" class="col-lg-3 col-md-4 col-form-label">Nombre</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="text" id="firstname" class="form-control" v-model="form.firstname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l-name" class="col-lg-3 col-md-4 col-form-label">Apellido</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="text" id="lastname" class="form-control" v-model="form.lastname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-lg-3 col-md-4 col-form-label">Correo Electrónico</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="text" class="form-control" id="email" v-model="form.email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newpassword" class="col-lg-3 col-md-4 col-form-label">Nueva Contraseña</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="password" class="form-control" id="newpassword" v-model="form.password">
                            <button class="btn show-btn" type="button" v-on:click="showPass('newpassword')"><i class="far fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="c-password" class="col-lg-3 col-md-4 col-form-label">Confirmar Contraseña</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="password" class="form-control" id="c-password" v-model="form.password_confirmation">
                            <button class="btn show-btn" type="button" v-on:click="showPass('c-password')"><i class="far fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="birth" class="col-lg-3 col-md-4 col-form-label">Fecha Nacimiento</label>
                        <div class="col-lg-6 col-md-8">
                            <input type="text" class="form-control" id="birth" placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                    <div class="form-check row p-0 mt-20" hidden>
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-4">
                            <input class="form-check-input" value="#" id="offer" type="checkbox">
                            <label class="form-check-label" for="offer">¿Desea recibir ofertas por correo?</label>
                        </div>
                    </div>
                    <div class="form-check row p-0 mt-20" hidden>
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-4">
                            <input class="form-check-input" value="#" id="subscribe" type="checkbox">
                            <label class="form-check-label" for="subscribe">Suscribirse a nuestro boletín<br>Suscríbite y manténte al tanto de nuestras novedades</label>
                        </div>
                    </div>
                    <div class="register-box mt-40">
                        <button type="submit" class="return-customer-btn float-right bg-info">Guardar</button>
                    </div>
                </form>
                <BreezeValidationErrors class="mb-3" />
            </div>
        </div>
    </div>
</Layout>
</template>
<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/LayoutProfile.vue'   
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'   
export default {
    components: {
        Head,
        Link,
        Layout,
        BreezeValidationErrors,
    },
    data() {
        return {
            form: this.$inertia.form({
                firstname: this.$page.props.auth.profile.firstname,
                lastname: this.$page.props.auth.profile.lastname,
                gender: this.$page.props.auth.profile.gender,
                email: this.$page.props.auth.user.email,
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
        submit() {
            this.form.put(this.route('profile.update',{'perfil' : this.$page.props.auth.profile.id}), {
                preserveScroll: true,
                onSuccess: () => {
                            this.form.reset('password');
                            this.form.reset('password_confirmation');
                            }
            })
        },
    }
}

</script>