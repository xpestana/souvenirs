<template>
<!-- <form @submit.prevent="submit" class=" mt-10">
    <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="E-mail*" v-model="form.email" required/>
    <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="Confirmar E-mail" v-model="form.email_confirmation" required/>
    <BreezeInput type="password" class="form-control my-2 py-4" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
    <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Regístrate ahora</button>
    <ValidationErrors class="my-3" />
</form>     -->
    <section id="collaborator-register">
         <div class="container-fluid flex min-h-screen bg-collaborator">
            <div class="row m-auto justify-content-center">
                <div class="register-hicitty col-12 col-md-6">
                    <div class="hicitty-logo">
                        <img class="w-72 mx-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="" @click="redirect()">
                    </div>
                    <h1 class="text-white font-weight-bolder text-2xl text-center">We only win if you win</h1>
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
                    <div class="hicitty-info shadow-lg rounded-2xl text-center p-2 rounded-xl bg-white">
                        <h1 class="text-2xl font-weight-bolder text-azulc">?</h1>
                        <p class="text-azulc text-base">Need help?</p>
                        <p class="text-azulc text-sm">
                            You will find specialized attention<br>
                            calling the following phone:
                        </p>
                        <p class="text-azulc text-base"><i class="fas fa-phone-alt text-azulc mr-1"></i> (+34) 722 193 903</p>
                    </div>
                </div>
                <div class="register-form col-12 col-md-6 bg-white">
                    <div class="form-card bg-white p-8 rounded-xl">
                        <h1 class="text-3xl my-2">Sign up and start earning</h1>
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
            }
        }
    }
</script>

<style scoped>
    .bg-collaborator{
        background-color:#a0cae1;
    }
    .up{
        display: flex;
        align-items: center;
        height: 100vh;
        background-color: #fff !important;
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