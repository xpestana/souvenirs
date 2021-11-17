<template>
    <Head title="Inicio de Sesión"/>
    <Layout>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Login</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">sesión</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Login Page Start Here -->
        <div class="login white-bg ptb-80">
            <div class="container">
              <h3 class="login-header text-info">Bienvenido, Ingresa a tu cuenta</h3>
               <div class="row">
                   <div class="col-lg-6 offset-lg-3">
                        <BreezeValidationErrors class="mb-4" />
                        <div class="login-footer text-center">
                            <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                {{ status }}
                            </div>
                        </div>
                        <div class="login-form">
                            <form @submit.prevent="submit">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Correo Electrónico</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" v-model="form.email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Contraseña</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" v-model="form.password" required>
                                    </div>
                                    <div class="col-sm-7 mt-3 ml-2">
                                        <label class="flex items-center">
                                            <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                                                <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="login-details text-center mb-25">
                                    <Link href="forgot-password.html">¿Ólvido su contraseña? </Link>
                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Entrar
                                    </BreezeButton>
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

    

    
    <div class="mt-4">
        <p>Logueo de usuario, ruta a utilizar route('login') method post:</p>
        <p>los names a utilizar son los explicitos en el formulario</p>        
        <p>email, password, remember</p>
    </div>
    <form >
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full"  autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full"required autocomplete="current-password" />
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

            
        </div>
    </form>-->
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
//import BreezeGuestLayout from '@/Layouts/Guest.vue'
//import BreezeInput from '@/Components/Input.vue'
//import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

import Layout from '@/Layouts/Layout.vue'     

export default {
    //layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        //BreezeInput,
        //BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
        Layout,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },
    created(){
        console.log(this.status);
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
                preserveScroll: true,
                onSuccess: () => this.form.reset('password'),
            })
        },
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        }
    }
}
</script>
