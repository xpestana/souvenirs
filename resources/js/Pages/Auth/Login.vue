<template>          
<!--    
<form @submit.prevent="submit" class=" mt-10">
<BreezeInput type="email" class="form-control my-3 py-4" id="email" name="email" autocomplete="on" placeholder="E-mail" v-model="form.email" required/>
<BreezeInput type="password" class="form-control my-3 py-4" name="password" id="password" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
<button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Iniciar sesión</button>
</form> -->

<section id="collaborator-login">
    <ModalCookies/> 
    <notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
    <div class="container-fluid flex min-h-screen bg-collaborator">
        <div class="row m-auto justify-content-between">
            <div class="login-hicitty col-12 col-lg-5 lg:flex flex-column pt-8 lg:pt-0">
                <div class="hicitty-logo mt-auto">
                    <img class="w-86 mx-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="" @click="redirect()">
                </div>
                <h1 class="text-white font-weight-bolder text-3xl text-center mb-6 lg:mb-0">Solo ganamos si tú ganas</h1>
                <div class="hicitty-social hidden lg:block my-8 flex justify-center mx-auto">
                    <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                    <img class="d-inline mr-3 icon" src="/vendor_asset/img/collaborator/itgicon.svg" alt="">
                    </a>
                    <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="">
                    <img class="d-inline mx-3 h-8 icon" src="/vendor_asset/img/collaborator/linkedin.svg" alt="">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                    <img class="d-inline mx-3 h-8 icon" src="/vendor_asset/img/collaborator/wticon.svg" alt="">
                    </a>
                </div>
                <div class="hicitty-info hidden lg:block shadow-lg rounded-2xl text-center p-2 rounded-xl bg-white mb-auto w-3/4 mx-auto">
                    <h1 class="text-2xl font-weight-bolder text-azulc">?</h1>
                    <p class="text-azulc text-base font-bold">¿Necesitas ayuda?</p>
                    <p class="text-azulc text-sm">
                        Encontraras atención especializada<br>
                        llamando al siguiente teléfono:
                    </p>
                    <p class="text-azulc text-base font-bold"><i class="fas fa-phone-alt text-azulc mr-1"></i> (+34) 722 193 903</p>
                </div>
            </div>
            <div class="login-form-collaborator col-12 col-lg-6 bg-white shadow-lg rounded-xl">
                <div class="form-card bg-white p-4 lg:p-8 rounded-xl">
                    <form @submit.prevent="submit" class="mt-1.5">
                        <h1 class="text-3xl lg:text-5xl mb-4 font-weight-bolder">¡Bienvenido/a a HiCitty!</h1>
                        <div class="my-2">
                            <label class="font-weight-bolder">Correo electrónico</label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-envelope absolute inset-y-1/3 px-2"></i>
                                <input type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Email...." autocomplete="on" v-model="form.email" required>
                            </div>
                        </div>
                        <div class="mt-2.5 mb-2">
                            <label class="font-weight-bolder">Contraseña</label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-key absolute inset-y-1/3 px-2"></i>
                                <i class="far fa-eye cursor-pointer absolute right-0 inset-y-1/3 px-3" v-on:click="showPass('password')"></i>
                                <input type="password" class="collaborator-input bg-light w-100 rounded py-1 pl-8" id="password" placeholder="********" v-model="form.password" required>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3.5 justify-content-center justify-content-lg-between">
                            <div class="form-remember col-10 col-lg-4 text-center text-lg-left">
                                <input type="checkbox" class="border mr-1 rounded-lg">
                                <p class="inline">Recuérdame</p>
                            </div>
                            <div class="forgot-password text-center text-lg-right  col-10 col-lg-6 pt-1">
                                <a href="javascript:void(0)" class="text-azulc"  data-toggle="modal" data-target="#forgot-password" >He olvidado mi contraseña</a>
                            </div>
                        </div>
                        <template v-if="showValidation">
                            <BreezeValidationErrors class="my-3" />
                        </template>
                        <div class="my-3">
                            <button type="submit" class="btn btn-collaborator text-xl w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <p class="text-xl mb-0">Iniciar sesión</p>
                            </button>
                        </div>
                        <div class="my-2 text-center">
                            <p class="inline-block text-muted form-collaborator-text relative">¿No tienes una cuenta todavía?</p>
                        </div>
                        <div class="my-3">
                            <Link :href="route('collaborator.register')" class="btn btn-outline-collaborator text-xl w-100">Crear una cuenta</Link>
                        </div>
                    </form>
                </div>
            </div>
            <div class="login-mobile-info lg:hidden my-6 mx-auto">
                <div class="hicitty-social my-8 flex justify-center">
                    <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                    <img class="d-inline mr-3 icon" src="/vendor_asset/img/collaborator/itgicon.svg" alt="">
                    </a>
                    <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="">
                    <img class="d-inline mx-3 h-8 icon" src="/vendor_asset/img/collaborator/linkedin.svg" alt="">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                    <img class="d-inline mx-3 h-8 icon" src="/vendor_asset/img/collaborator/wticon.svg" alt="">
                    </a>
                </div>
                <div class="hicitty-info shadow-lg rounded-2xl text-center p-2 rounded-xl bg-white mb-auto mx-auto">
                    <h1 class="text-2xl font-weight-bolder text-azulc">?</h1>
                    <p class="text-azulc text-base font-bold">¿Necesitas ayuda?</p>
                    <p class="text-azulc text-sm">
                        Encontraras atención especializada<br>
                        llamando al siguiente teléfono:
                    </p>
                    <p class="text-azulc text-base font-bold"><i class="fas fa-phone-alt text-azulc mr-1"></i> (+34) 722 193 903</p>
                </div>
            </div>
        </div>
    </div>   
</section>
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
                                <h1 class="text-lg font-weight-bolder text-center">Reestablece tu contraseña</h1>
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
    <!-- Central Modal notify -->
        <div class="modal fade" id="notify" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content mx-auto">
                    <div class="modal-body p-0">
                        <div class="row">
                            <div class="col-12 p-3 text-right">
                                <!-- <a class="p-3" href="#" data-dismiss="modal" ><i class="fas fa-times text-muted"></i></a> -->
                            </div>
                        </div>
                        <div class="row mb-2 justify-content-center">
                            <div class="col-12 text-center">
                                <h1 class="text-lg font-weight-bolder">Muchas gracias</h1>
                            </div>
                            <div class="col-8 px-0 py-3 text-left">
                                <p class="text-justify" v-if="$page.props.flash.mensaje">
                                    Hemos enviado un correo a {{$page.props.flash.mensaje.email}} con un enlace
                                    donde podrás reestrablecer tu contraseña.
                                </p>
                            </div>
                        </div>
                        <div class="row px-3 pt-2 pb-5 justify-content-center">
                            <div class="col-8">
                                <button  type="button" class="bnt btn-primary-c text-white rounded-pill px-4 py-3 w-100" @click="reload()">Ok</button>
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
        status: Boolean,
    },
    created(){
        console.log(this.$page.props.flash)
    },
    updated(){
        if(this.$page.props.flash.mensaje){
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
        reload(){
            window.location.reload();
        },
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
*> :not(i){
    font-family:Montserrat;
}
.login-form-collaborator .form-collaborator-text::after,
.login-form-collaborator .form-collaborator-text::before{
    content: '';
    width: 40%;
    height: 1px;
    position: absolute;
    top: 50%;
    background-color: currentColor;
}

.login-form-collaborator .form-collaborator-text::before{
    left:-50%;
}
.login-form-collaborator .form-collaborator-text::after{
    right:-50%;
}

@media (max-width: 767px){
    .login-form-collaborator .form-collaborator-text::after,
    .login-form-collaborator .form-collaborator-text::before{
        content: '';
        width: 8%;
        height: 1px;
        position: absolute;
        top: 50%;
        background-color: currentColor;
    }

    .login-form-collaborator .form-collaborator-text::before{
        left:-10%;
    }
    .login-form-collaborator .form-collaborator-text::after{
        right:-10%;
    }
}
</style>