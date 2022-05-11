<template>          
<!-- <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" v-model="form.email" required>
<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" v-model="form.password" required>
<button class="btn show-btn" type="button" v-on:click="showPass('password')"><i class="far fa-eye"></i></button>
    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
<Link :href="route('password.request')">¿Ólvido su contraseña? </Link>
<BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
    Entrar 
</BreezeButton>-->
                            

 

 <section>
        <div class="row w-100 p-0 m-0">
            <div class="col-md-7 up py-4">
                <div class="col-md-12 text-center">
                    <img style="width: 50%" class="m-auto" src="/vendor_asset/img/logo/logopequeño.png">

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
                    <h1 class="text-white mb-4 title_white">¡Bienvenido a HiCitty!</h1>
                    <div class="col-md-10 mx-auto">
                        <form @submit.prevent="submit" class=" mt-10">
                            <BreezeInput type="email" class="form-control my-3 py-4" id="email" name="email" autocomplete="on" placeholder="E-mail" v-model="form.email" required/>
                            <BreezeInput type="password" class="form-control my-3 py-4" name="password" id="password" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
                            <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Iniciar sesión</button>
                            <BreezeValidationErrors class="my-3" />
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
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean
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
        background-image: linear-gradient(175deg, #cff3fb 0, #b7e3ee 25%, #9dd2e1 50%, #82c1d4 75%, #69b2c9 100%);
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