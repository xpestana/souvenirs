<template>          
 <section>
    <div class="row w-100 p-0 m-0">
        <div class="col-md-7 up py-4">
            <div class="col-md-12 text-center">
                <img style="width: 50%" class="m-auto" src="/vendor_asset/img/logo/hilogo.png">

                <h1 class="title text-xl md:text-3xl font-weight-bolder mt-2">We do it for you</h1>
                <div class="caja-info mt-4">
                    <p>
                        Available hours: <br>
                        8:30-14:30 h. <br>
                        (+34) 722 193 903
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5 up degrad py-4">
            <div class="col-md-12 text-center">
                <h1 class="text-white mb-4 title_white">Welcome to HiCitty!</h1>
                <div class="col-md-10 mx-auto">
                    <form @submit.prevent="submit" class=" mt-10">
                        <div>
                            <BreezeInput type="email" class="form-control my-3 py-4" id="email" name="email" autocomplete="on" placeholder="E-mail" v-model="form.email" required/>
                        </div>
                        <div class="relative">
                            <BreezeInput type="password" class="form-control my-3 py-4" name="password" id="password" autocomplete="off" placeholder="Password" v-model="form.password" required/>
                            <button class="btn absolute top-1 right-5 rounded-circle px-auto" type="button" v-on:click="showPass('password')"><i class="far fa-eye"></i></button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Log in</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 text-center mt-2">
                    <button type="button" class="btn btn-link text-white text-lg" data-toggle="modal" data-target="#forgot-password">
                        ¿Have you forgotten your password?
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
                                                <h1 class="text-lg font-weight-bolder">Reset your password</h1>
                                            </div>
                                            <div class="col-8 px-0 py-3 text-left">
                                                <p class="text-justify">
                                                    Did you forget your password? No problem. Just let us know your email address
                                                        and we will send you a password reset link that will allow you to choose a new one.
                                                </p>
                                                <label for="correo" class="mt-3">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="rounded border w-100 py-2" v-model="forgot.email" placeholder="E-mail"  required autofocus autocomplete="username">                
                                            </div>
                                        </div>
                                        <div class="row px-3 pt-2 pb-5 justify-content-center">
                                            <div class="col-8">
                                                <template v-if="!showValidation">
                                                    <BreezeValidationErrors class="mb-3" />
                                                </template>
                                                <button class="bnt btn-primary-c text-white rounded-pill px-4 py-3 w-100" :class="{ 'opacity-25': forgot.processing }" :disabled="forgot.processing">Send</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Central Modal Small -->
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
                            <h1 class="text-lg font-weight-bolder">Thank you very much</h1>
                        </div>
                        <div class="col-8 px-0 py-3 text-left">
                            <p class="text-justify" v-if="$page.props.flash.status">
                                We have sent an email to {{$page.props.flash.status.email}} with a link where you can reset your password.
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

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean,
    },
    updated(){
        console.log(this.$page.props.flash.status)
        if(this.$page.props.flash.status){
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