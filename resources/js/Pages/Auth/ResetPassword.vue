<template>
    <Head title="Restaurar contraseña"/>

    <section>
        <div class="row w-100 p-0 m-0">
            <div class="col-md-7 up py-4">
                <div class="col-md-12 text-center">
                    <img style="width: 50%" class="m-auto" src="/vendor_asset/img/logo/hilogo.png">

                    <h1 class="title">Lo hacemos por ti</h1>
                    <div class="caja-info mt-4">
                        <p>
                            Horario disponible: <br>
                            8:30-14:30 h. <br>
                            (+34) 722 193 903
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 up degrad py-4">
                <div class="col-md-12 text-center">
                    <h1 class="text-white mb-4 title_white">¡Restaurar contraseña!</h1>
                    <div class="col-md-10 mx-auto">
                        <form @submit.prevent="submit">
                            <div class="text-left">
                                <!-- <label for="" class="text-white">Email</label> -->
                                <BreezeInput id="email" type="email" class="mt-1 block w-full py-3.5" v-model="form.email" required autofocus autocomplete="username" placeholder="Email"/>
                            </div>

                            <div class="mt-4 text-left relative">
                                <!-- <label for="" class="text-white">Password</label> -->
                                <BreezeInput id="password" type="password" class="mt-1 block w-full py-3.5" v-model="form.password" required autocomplete="new-password" placeholder="Nueva contraseña"/>
                                <button class="btn absolute top-1 right-5 rounded-circle px-auto" type="button" v-on:click="showPass('password')"><i class="far fa-eye"></i></button>
                            </div>

                            <div class="mt-4 text-left relative">
                                <!-- <label for="" class="text-white">Confirm Password</label> -->
                                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full py-3.5" v-model="form.password_confirmation" required autocomplete="new-password" placeholder="Confirma tu contraseña"/>
                                <button class="btn absolute top-1 right-5 rounded-circle px-auto" type="button" v-on:click="showPass('password_confirmation')"><i class="far fa-eye"></i></button>
                            </div>

                            <div class="flex items-center justify-center mt-4">
                                <button type="submit" class="bnt btn-primary-c text-white rounded-pill px-4 py-3 w-100 text-base" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Restaurar contraseña</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </section>  

</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Layout.vue' 
import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue' 

export default {

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Layout,
        Breadcrumb,
    },

    props: {
        email: String,
        token: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        },
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
    }
}
</script>
<style scoped>
    .up{
        display: flex;
        align-items: center;
        height: 100vh;
    }
    .caja-info p {
        border-radius: 30px;
        border: 1px solid #70b3c6;
        display: inline-block;
        padding: 15px;
        color:#70b3c6;
        line-height: 1.5;
        font-size: 16px;
    }
    .title{
        font-size: 33px;
        font-weight: 600;
    }
    .degrad{
    background-image: linear-gradient(175deg, #baeefa 0, #87c7d7 25%, #9dd2e1 50%, #82c1d4 75%, #69b2c9 100%);
    }
    .title_white{
        font-size: 30px;
        font-weight: 600;
    }
    .register_btn{
        font-size: 20px;
    }
    @media (max-width:992px){
        .up{
            height: 100%;
        }
        .title_white{
            font-size: 20px;
        }
    }
</style>