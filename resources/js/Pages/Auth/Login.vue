<template>
    <Head title="Inicio de Sesión"/>
    <Layout>
    <Breadcrumb title="Sesión"/>
    <!-- Login Page Start Here -->
        <div class="login white-bg ptb-80">
            <div class="container">
              <h3 class="login-header text-info">Bienvenido, Ingresa a tu cuenta</h3>
               <div class="row">
                   <div class="col-lg-6 offset-lg-3">
                        <BreezeValidationErrors class="mb-3" />
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
                                        <button class="btn show-btn" type="button" v-on:click="showPass('password')"><i class="far fa-eye"></i></button>
                                    </div>
                                    <div class="col-sm-7 mt-3 ml-2">
                                        <label class="flex items-center">
                                            <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                                                <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="login-details text-center mb-25">
                                    <Link :href="route('password.request')">¿Ólvido su contraseña? </Link>
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
 
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue' 
import Layout from '@/Layouts/Layout.vue'     

export default {
    //layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        Breadcrumb,
        BreezeValidationErrors,
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
