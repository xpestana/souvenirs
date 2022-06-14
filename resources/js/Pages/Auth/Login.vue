<template>          
 <section>
     <ModalCookies/>
    <div class="row w-100 p-0 m-0">
        <div class="col-md-7 up py-4">
            <notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
            <div class="col-md-12 text-center">
                <img style="width: 50%" class="m-auto cursor-pointer" src="/vendor_asset/img/logo/hilogo.png" @click="redirect()">

                <h1 class="title text-xl md:text-3xl font-weight-bolder mt-2">Lo hacemos por ti</h1>
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
                        <div>
                            <BreezeInput type="email" class="form-control my-3 py-4" id="email" name="email" autocomplete="on" placeholder="E-mail" v-model="form.email" required/>
                        </div>
                        <div class="relative">
                            <BreezeInput type="password" class="form-control my-3 py-4" name="password" id="password" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
                            <button class="btn absolute top-1 right-5 rounded-circle px-auto" type="button" v-on:click="showPass('password')"><i class="far fa-eye"></i></button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 text-center mt-2">
                    <button type="button" class="btn btn-link text-white text-lg" data-toggle="modal" data-target="#forgot-password">
                        ¿Has olvidado tu contraseña?
                    </button>
                    <template v-if="showValidation">
                        <BreezeValidationErrors class="my-3" />
                    </template>
                    <!-- Central Modal Small -->
                        <div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <!-- Change class .modal-sm to change the size of the modal -->
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content mx-auto">
                                    <div class="modal-body p-0">
                                        <div class="row">
                                            <div class="col-12 p-3 text-right">
                                                <a class="p-3" href="#" data-dismiss="modal" ><i class="fas fa-times text-muted"></i></a>
                                            </div>
                                        </div>
                                        <form @submit.prevent="forgotPass">
                                        <div class="row mb-2 justify-content-center">
                                            <div class="col-12">
                                                <h1 class="text-lg font-weight-bolder">Reestablece tu contraseña</h1>
                                            </div>
                                            <div class="col-8 px-0 py-3 text-left">
                                                <p class="text-justify">
                                                    ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico
                                                        y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
                                                </p>
                                                <label for="correo" class="mt-3">Correo electrónico<span class="text-danger">*</span></label>
                                                <input type="text" class="rounded border w-100 py-2" v-model="forgot.email" placeholder="Correo Electrónico"  required autofocus autocomplete="username">                
                                            </div>
                                        </div>
                                        <div class="row px-3 pt-2 pb-5 justify-content-center">
                                            <div class="col-8">
                                                <template v-if="!showValidation">
                                                    <BreezeValidationErrors class="mb-3" />
                                                </template>
                                                <button class="bnt btn-primary-c text-white rounded-pill px-4 py-3 w-100" :class="{ 'opacity-25': forgot.processing }" :disabled="forgot.processing">Enviar</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Central Modal Small -->
                </div>
                <div class="col-12 text-center mt-2">
                    <p class="text-white">
                        ¿Aún no tienes cuenta?  
                        <Link :href="route('collaborator.register')"> <b>Registrate aquí</b></Link>
                    </p>
                </div>        
            </div>
        </div>
    </div>
</section>  
<!-- Central Modal notify -->
    <div class="modal fade" id="notify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mx-auto">
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-12 p-3 text-right">
                            <a class="p-3" href="#" data-dismiss="modal" ><i class="fas fa-times text-muted"></i></a>
                        </div>
                    </div>
                    <div class="row mb-2 justify-content-center">
                        <div class="col-12 text-center">
                            <h1 class="text-lg font-weight-bolder">Muchas gracias</h1>
                        </div>
                        <div class="col-8 px-0 py-3 text-left">
                            <p class="text-justify" v-if="$page.props.flash.status">
                                Hemos enviado un correo a {{$page.props.flash.status.email}} con un enlace
                                donde podrás reestrablecer tu contraseña.
                            </p>
                        </div>
                    </div>
                    <div class="row px-3 pt-2 pb-5 justify-content-center">
                        <div class="col-8">
                            <button data-dismiss="modal" type="button" class="bnt btn-primary-c text-white rounded-pill px-4 py-3 w-100" >Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Central Modal notify -->
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Link } from '@inertiajs/inertia-vue3';
import Notify from '@/Layouts/Components/Toast.vue'
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'  

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeValidationErrors,
        Link,
        Notify,
        ModalCookies
    },

    props: {
        canResetPassword: Boolean,
    },
    updated(){
        console.log(this.$page.props.flash.response)
        if(this.$page.props.flash.response){
            $('#notify').modal('show')
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            }),
            showValidation:true,
            forgot: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.showValidation = true;
            this.form.post(this.route('login'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset('password'),
            })
        },
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
        forgotPass() {
            const modal = $('#forgot-password');
            this.showValidation = false;
            this.forgot.post(this.route('password.email'), {
                preserveScroll: true,
                onSuccess: () => {
                    modal.modal('hide')
                    this.forgot.reset();
                },
            })
        },
        redirect(){
            this.$inertia.get(route('collaborator.home'))
        }
    }
}
</script>
<style scoped>
    .up{
        display: flex;
        align-items: center;
        height: 100vh;
        background-color: white !important;
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