<template>
<!-- <form @submit.prevent="submit" class=" mt-10">
    <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" v-model="form.email" required/>
    <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="Confirmar E-mail" v-model="form.email_confirmation" required/>
    <BreezeInput type="password" class="form-control my-2 py-4" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
    <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Regístrate ahora</button>
    <ValidationErrors class="my-3" />
</form>     -->
    <section id="collaborator-register">
         <div class="container-fluid flex min-h-screen bg-collaborator">
            <div class="row m-auto justify-content-around">
                <div class="register-hicitty col-12 col-lg-5 lg:flex flex-column pt-8 lg:pt-0">
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
                        <p class="text-azulc text-base">¿Necesitas ayuda?</p>
                        <p class="text-azulc text-sm">
                            Encontraras atención especializada<br>
                            llamando al siguiente teléfono:
                        </p>
                        <p class="text-azulc text-base"><i class="fas fa-phone-alt text-azulc mr-1"></i> (+34) 722 193 903</p>
                    </div>
                </div>
                <div class="register-form-collaborator col-12 col-lg-6 bg-white shadow-lg rounded-xl">
                    <div class="form-card bg-white p-4 lg:p-8 rounded-xl">
                        <form @submit.prevent="submit" class=" mt-10">
                            <h1 class="text-3xl lg:text-5xl mb-2 font-weight-bolder">Regístrate y empieza a ganar</h1>
                            <div class="my-1">
                                <label class="font-weight-bolder">Correo electrónico</label>
                                <div class="relative w-100 collaborator-box">
                                    <i class="fas fa-envelope absolute inset-y-1/3 px-2"></i>
                                    <input type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Email...." autocomplete="on" v-model="form.email" required>
                                </div>
                            </div>
                            <div class="my-1">
                                <label class="font-weight-bolder">Confirmar correo electrónico</label>
                                <div class="relative w-100 collaborator-box">
                                    <i class="fas fa-envelope absolute inset-y-1/3 px-2"></i>
                                    <input type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Confirmar correo...." v-model="form.email_confirmation" required>
                                </div>
                            </div>
                            <div class="my-1">
                                <label class="font-weight-bolder">Contraseña</label>
                                <div class="relative w-100 collaborator-box">
                                    <i class="fas fa-key absolute inset-y-1/3 px-2"></i>
                                    <i class="far fa-eye cursor-pointer absolute right-0 inset-y-1/3 px-3" v-on:click="showPass('password')"></i>
                                    <input type="password" class="collaborator-input bg-light w-100 rounded py-1 pl-8" id="password" placeholder="********" v-model="form.password" required>
                                </div>
                            </div>
                            <div class="my-2">
                                <input type="checkbox" class="border mr-1 rounded-lg">
                                <p class="inline text-sm">
                                    Estoy deacuerdo con los
                                    <a class="d-inline text-xs text-orangec font-weight-bolder" target="_blank" href="/politicas/terminosycondiciones">
                                    términos de servicio
                                    </a> y
                                    <a class="d-inline text-xs text-orangec font-weight-bolder" target="_blank" href="/politicas/terminosycondiciones">
                                    politicas de privacidad
                                    </a> y
                                </p>
                            </div>
                            <ValidationErrors class="my-3" />
                            <div class="my-3">
                                <button type="submit" :href="route('collaborator.register')" class="btn btn-collaborator text-xl w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    <p class="text-xl mb-0">Regístrarme</p>
                                </button>
                            </div>
                            <div class="my-2 text-center">
                                <p class="inline-block text-muted form-collaborator-text relative">o si ya tienes una cuenta</p>
                            </div>
                            <div class="my-3">
                                <Link :href="route('login')" class="btn btn-outline-collaborator text-xl w-100">Iniciar Sesión</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="register-mobile-info lg:hidden my-6">
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
                        <p class="text-azulc text-base">¿Necesitas ayuda?</p>
                        <p class="text-azulc text-sm">
                            Encontraras atención especializada<br>
                            llamando al siguiente teléfono:
                        </p>
                        <p class="text-azulc text-base"><i class="fas fa-phone-alt text-azulc mr-1"></i> (+34) 722 193 903</p>
                    </div>
                </div>
            </div>
        </div>   
    </section>
</template> 

<script>
    import BreezeInput from '@/Components/Input.vue'
    import BreezeButton from '@/Components/Button.vue'
    import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components:{
            BreezeInput,
            BreezeButton,
            ValidationErrors,
            Link
        },
        data(){
            return {
                form: this.$inertia.form({
                    email: null,
                    email_confirmation: null,
                    password: '',
                })
            }
        },
        methods: {
            submit() {
                this.form.post(route('register.collaborator'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                })
            },
            redirect(){
                this.$inertia.get(route('collaborator.home'))
            },
            showPass: function (id){
                let x = document.getElementById(id);
                x.type = x.type == 'password' ? 'text' : 'password';            
            },
        }
    }
</script>

<style scoped>
.register-form-collaborator .form-collaborator-text::after,
.register-form-collaborator .form-collaborator-text::before{
    content: '';
    width: 70%;
    height: 1px;
    position: absolute;
    top: 50%;
    background-color: currentColor;
}

.register-form-collaborator .form-collaborator-text::before{
    left:-80%;
}
.register-form-collaborator .form-collaborator-text::after{
    right:-80%;
}

@media (max-width: 767px){
    .register-form-collaborator .form-collaborator-text::after,
    .register-form-collaborator .form-collaborator-text::before{
        content: '';
        width: 20%;
        height: 1px;
        position: absolute;
        top: 50%;
        background-color: currentColor;
    }

    .register-form-collaborator .form-collaborator-text::before{
        left:-25%;
    }
    .register-form-collaborator .form-collaborator-text::after{
        right:-25%;
    }
}
</style>