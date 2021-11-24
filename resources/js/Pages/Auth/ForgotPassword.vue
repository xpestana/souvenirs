<template>
    <Head title="Reestablecer contraseña"/>
    <Layout>
    <Breadcrumb title="Reestablecer contraseña"/>
    <!-- Login Page Start Here -->
        <div class="login white-bg ptb-80">
            <div class="container">
              <h3 class="login-header text-info">Bienvenido, Reestablece tu contraseña</h3>
               <div class="row">
                   <div class="col-lg-6 offset-lg-3">
                    <div class="mb-4 text-sm text-gray-600">
                                ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva..
                            </div>
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
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico"  v-model="form.email" required autofocus autocomplete="username">
                                    </div>
                                </div>
                                <div class="login-details text-center mb-25">
                                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Reestablecer contraseña
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
import Layout from '@/Layouts/Layout.vue'  
import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'  
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    //layout: Layout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Breadcrumb,
        Layout,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
