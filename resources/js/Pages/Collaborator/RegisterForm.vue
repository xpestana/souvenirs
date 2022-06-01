<template>
    <section>
        <div class="row w-100 p-0 m-0">
            <div class="col-md-7 up py-4">
                <div class="col-md-12 text-center">
                    <img style="width: 50%" class="m-auto" src="/vendor_asset/img/logo/hilogo.png">

                    <h1 class="title">We do it for you</h1>
                    <div class="caja-info mt-4">
                        <p>
                            We do it for you <br>
                            Available hours: <br>
                            8:30-14:30 h. <br>
                            (+34) 722 193 903
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 up degrad py-4">
                <div class="col-md-12 text-center">
                    <h1 class="text-white mb-4 title_white">Create an account for<br>register your accommodation<br>and manage it</h1>
                    <div class="col-md-10 mx-auto">
                        <form @submit.prevent="submit" class=" mt-10">
                            <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="E-mail*" v-model="form.email" required/>
                            <BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="Confirmar E-mail" v-model="form.email_confirmation" required/>
                            <BreezeInput type="password" class="form-control my-2 py-4" autocomplete="off" placeholder="Password" v-model="form.password" required/>
                            <button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Register now</button>
                            <ValidationErrors class="my-3" />
                        </form>
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

    export default {
        components:{
            BreezeInput,
            BreezeButton,
            ValidationErrors
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