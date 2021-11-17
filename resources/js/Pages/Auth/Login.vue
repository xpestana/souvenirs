<template>
    <Head title="Login"/>
    <Layout>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Login</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Login</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Login Page Start Here -->
    <div class="login white-bg ptb-80">
        <div class="container">
          <h3 class="login-header text-info">Ingresa a tu cuenta </h3>
           <div class="row">
               <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Correo</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="email" placeholder="Correo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Contraseña</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña">
                                    <button class="btn show-btn" type="button" v-on:click="showPass('inputPassword')">Ver</button>
                                </div>
                            </div>
                            <div class="login-details text-center mb-25">
                                <Link :href="route('password.request')" style="text-transform: none;">¿Olvidó su contraseña? </Link>
                                <Link class="view-cart bg-info" :href="route('dashboard')">Entrar</Link>
                                <!--<button type="" class="login-btn bg-info"><Link :href="route('dashboard')">Entrar</Link></button>-->
                            </div>
                            <div class="login-footer text-center">
                                <p>¿No tienes cuenta? <a href="register.html">Regístrate</a></p>
                            </div>
                        </form>
                    </div>
               </div>
           </div>
        </div>
    </div>
    <!-- Login Page End Here -->

    </Layout>
    <!---
    <Head title="Log in" />

    <BreezeValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="mt-4">
        <p>Logueo de usuario, ruta a utilizar route('login') method post:</p>
        <p>los names a utilizar son los explicitos en el formulario</p>        
        <p>email, password, remember</p>
    </div>
    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </BreezeButton>
        </div>
    </form>-->
</template>

<script>
//import BreezeButton from '@/Components/Button.vue'
//import BreezeCheckbox from '@/Components/Checkbox.vue'
//import BreezeGuestLayout from '@/Layouts/Guest.vue'
//import BreezeInput from '@/Components/Input.vue'
//import BreezeLabel from '@/Components/Label.vue'
//import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

import Layout from '@/Layouts/Layout.vue'     

export default {
    //layout: BreezeGuestLayout,

    components: {
        //BreezeButton,
        //BreezeCheckbox,
        //BreezeInput,
        //BreezeLabel,
        //BreezeValidationErrors,
        Head,
        Link,
        Layout,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        },
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        }
    }
}
</script>
