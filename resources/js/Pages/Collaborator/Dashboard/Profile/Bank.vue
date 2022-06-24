<template>
    <div id="dashboard-perfil-bank" class="container  py-8 ml-2 md:ml-0 md:px-24" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <Link
                        :href="route('collaborator.home')"
                        class="text-muted mr-2"
                    >
                        <i class="fas fa-arrow-left"></i>
                    </Link>Información bancaria
                </h1>
            </div>
        </div>
         <!--END Header-->
        <!--Formulario de banck -->
        <div
            class="perfil-shipping row mx-1.5 lg:mx-0 mt-8 justify-content-start"
            :class="{'position-relative': windowWidth >= 768}"
        >
            <!--Alert validation -->
            <ValidationAlert
                :errors="formatErrors"
            />
            <div class="col-12 col-md-8">
                <form
                    @submit.prevent="submit()"
                    class="row"
                >
                    <!--END Alert validation -->
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold">Titular de la cuenta <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorBank.holder"
                            type="text"
                            class="col-form-input w-100 rounded py-1.5"
                            placeholder="Titular de la cuenta..."
                            :class="{'error-input': errorsKey.includes('holder')}"
                        >
                    </div>
                    <div class="col-12 my-1.5 px-0">
                            <label class="font-bold">Número de IBAN <span class="required-input">*</span></label>
                            <input
                                v-model="formCollaboratorBank.iban"
                                type="text"
                                class="col-form-input w-100 rounded py-1.5"
                                placeholder="Ej: ES121231231234567890"
                                @keyup="changeValidIban"
                                @blur="changeValidIban"
                                :class="{'error-input': errorsKey.includes('iban')}"
                            >
                            <div
                                v-if="!validForm"
                                class="text-danger mt-2 text-md"
                            >
                                El iban no es válido
                            </div>
                    </div>
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">                            
                        <button
                             type="submit"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                             :class="{ 'opacity-25': formCollaboratorBank.processing || !validForm }"
                             :disabled="formCollaboratorBank.processing || !validForm">
                            <i class="fas fa-save mr-2 text-white">
                            </i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
            validForm: true,
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
        formatErrors () {
            var map = this.errorsKey.map( item => {
                switch (item) {
                    case 'holder':
                        return 'Titulo de la cuenta'
                        break;
                    case 'iban':
                        return 'iban'
                        break;
                    default:
                    return item
                }
            })
            return map
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
            var valid = regexIban.test(value)
            if (valid) { this.validForm = true }
            else { this.validForm = false }
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