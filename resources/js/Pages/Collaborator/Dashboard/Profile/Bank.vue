<template>
    <div class="container pt-8 pb-8" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <!-- HEADER -->
        <div class="row justify-content-center">
            <div class="col-10 col-md-12 shadow rounded-xl bg-header-colaborator py-4">
                    <div>
                        <Link
                            :href="route('collaborator.home')"
                            class="text-2xl w-10 mr-3 font-weight-bold mt-3"
                        >
                            <i class="fas fa-arrow-left"></i>
                        </Link>
                        <span class="title">Bank information</span>
                    </div>
            </div>
        </div>
        <!--Formulario de envio -->
        <form @submit.prevent="submit()" :class="{'position-relative': windowWidth >= 768}">
            <!--Alert validation -->
            <ValidationAlert
                :errors="errorsKey"
            />

            <div class="row mt-5 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-8">
                    <label class="py-2">Account holder <span class="required-input">*</span></label>
                    <input
                        v-model="formCollaboratorBank.holder"
                        type="text"
                        class="input-datos form-control-file" placeholder="Account holder..."
                        :class="{'error-input': errorsKey.includes('holder')}"
                    >
                </div>
            </div>
            <div class="row mt-4 mb-12 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-8">
                        <label class="py-2">IBAN number <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorBank.iban"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Ej: ES121231231234567890"
                            @keyup="changeValidIban"
                            @blur="changeValidIban"
                            :class="{'error-input': errorsKey.includes('iban')}"
                        >
                        <!--<span
                            class="text-danger mt-3 text-md"
                        >
                            El iban no es válido
                        </span>-->
                </div>
            </div>
            <div class="d-flex justify-content-center justify-content-md-start  mb-12">
                    <button
                        type="submit"
                        class="btn btn-collaborator btn-lg px-8 py-3 rounded-4 text-white d-flex aligin-items-center text-2xl"
                        :class="{ 'opacity-25': formCollaboratorBank.processing }" :disabled="formCollaboratorBank.processing"
                    >
                            <i class="fa fa-save mr-2 mt-1"></i><p class="inline-block p-0 m-0 text-2xl">Save changes</p>
                    </button>
            </div>
        </form>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:TemplateApp,
    components:{
        Head,
        Link,
        ModalCookies,
        ValidationAlert,
    },
    data() {
        return {
            windowWidth: window.innerWidth,
            validForm: false,
            formCollaboratorBank: this.$inertia.form({
            	_method: "POST",
                holder: this.$page.props.collaboratorBank.holder,
                iban: this.$page.props.collaboratorBank.iban,
            }),
        }
    },
    computed: {
        errorsKey () {
            var err = this.$page.props.errors.submitBank ? Object.keys(this.$page.props.errors.submitBank) : []
            return err
        },
    },
    created(){
        console.log(this.$page.props.collaboratorBank)
    },
    methods: {
        submit () {
            this.formCollaboratorBank.post(route('collaborator.bank.store'), {
                preserveScroll: true,
                errorBag: 'submitBank',
                onSuccess:()=>{
                    $('#datosModal').modal('hide')
                }
            })
        },
        changeValidIban (input) {
            var value = input.target.value
            var regexIban = /^ES\d{22}$/
            this.validForm = regexIban.test(value)
        },
    },
}
</script>

<style lang="scss">
    .bg-header-colaborator{
        background-color: #f6f6f6;
    }    
    .required-input{
        color: #ff9c06;
    }
    .title{
        font-size: 2rem;
        font-weight: bolder;
        color: #545454;
        diplay: inline-block;
    }
    form label{
        font-weight: bolder;
        font-size: 1.5rem;
        display: block;
        widows: 10rem;
    }
    .input-datos{
        border: 0;
        background-color: #e7f6ff;
        padding: 11.6px 12.4px;
        outline: none;
        font-size: 1.3rem;
        border: solid 2.5px #bfbfbf;
        border-radius: 5px;
    }
    .error-input{
        border: solid 2.5px red;
    }
</style>