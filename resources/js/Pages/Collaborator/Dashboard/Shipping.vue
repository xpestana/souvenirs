<template>
    <div class="container" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <div class="row mt-4 mt-md-6 mb-6 justify-content-center">
            <div class="col-10 col-md-12 card py-4 px-4 px-md-5 py-md-5 rounded-5">
                    <div>
                        <Link
                            :href="route('collaborator.home')"
                            class="text-2xl w-10 mr-3 font-weight-bold mt-3"
                        >
                            <i class="fas fa-arrow-left"></i>
                        </Link>
                        <span class="title">Datos de envio {{close}}</span>
                    </div>
            </div>
        </div>
        <!--Formulario INFORMACION PERSONAL -->
        <form @submit.prevent="submit()" :class="{'position-relative': windowWidth >= 768}">
            <!--Alert validation -->
            <div
                v-if="close"
                class="validator-alert pt-4 pb-4 px-4 w-210"
            >
                <div class="row">
                    <div class="col-10">
                        <p class="text-xl orange font-bold">Los siguientes campos son obligatorios</p>                </div>
                    <div class="col-2">
                        <button
                            class="btn text-xl"
                            type="button"
                            @click.prevent="closeAlertValidation()"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                 <ul class="mt-4 ml-2 list-disc list-inside text-xl">
                    <li
                        v-for="(error, key) in errorsKey"
                        :key="key"
                        class="mb-1"
                    >
                        {{ error }}
                    </li>
                </ul>
            </div>
            <div class="row mt-5 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                    <label class="py-2">Documento de identificación <span class="required-input">*</span></label>
                    <input
                        v-model="formCollaboratorShipping.document"
                        type="text"
                        class="input-datos form-control-file" placeholder="NIF..."
                        :class="{'error-input': errorsKey.includes('document')}"
                    >
                </div>
            </div>
            <div class="row mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Razón social <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.businessName"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Razón social..."
                            :class="{'error-input': errorsKey.includes('businessName')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Persona de contacto <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.contactPerson"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="N id Fiscal..."
                            :class="{'error-input': errorsKey.includes('contactPerson')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Telefono <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.phone"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Telefono..."
                            :class="{'error-input': errorsKey.includes('phone')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Correo electrónico <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.email"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Correo electrónico..."
                            :class="{'error-input': errorsKey.includes('email')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Domicio de entrega <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.deliveryAddress"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Domicilio de facturarión..."
                            :class="{'error-input': errorsKey.includes('deliveryAddress')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Código postal <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.postalCode"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Código postal..."
                            :class="{'error-input': errorsKey.includes('postalCode')}"
                        >
                </div>
            </div>
            <div class="row mt-4 mb-12 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Provincia <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.province"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Provincia..."
                            :class="{'error-input': errorsKey.includes('province')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Ciudad <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.city"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Ciudad..."
                            :class="{'error-input': errorsKey.includes('city')}"
                        >
                </div>
            </div>
            <div class="d-flex justify-content-center justify-content-md-start  mb-12">
                    <button
                        type="submit"
                        class="btn btn-collaborator btn-lg px-4 py-3 rounded-4 text-white d-flex aligin-items-center text-2xl"
                        :class="{ 'opacity-25': formCollaboratorShipping.processing }" :disabled="formCollaboratorShipping.processing"
                    >
                            <i class="fa fa-save mr-2 mt-1"></i><p class="inline-block p-0 m-0 text-2xl">Guardar cambios</p>
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
        ModalCookies
    },
    data() {
        return {
            close: false,
            windowWidth: window.innerWidth,
            formCollaboratorShipping: this.$inertia.form({
            	_method: "POST",
                document: this.$page.props.collaboratorShipping.document,
                businessName: this.$page.props.collaboratorShipping.businessName,
                contactPerson: this.$page.props.collaboratorShipping.contactPerson,
                phone: this.$page.props.collaboratorShipping.phone,
                email: this.$page.props.collaboratorShipping.email,
                deliveryAddress: this.$page.props.collaboratorShipping.deliveryAddress,
                postalCode: this.$page.props.collaboratorShipping.postalCode,
                province: this.$page.props.collaboratorShipping.province,
                city: this.$page.props.collaboratorShipping.city,
            }),
        }
    },
    created(){
        console.log(this.$page.props.collaboratorShipping)
    },
    computed: {
        errorsKey () {
            var err = this.$page.props.errors.submitShipping ? Object.keys(this.$page.props.errors.submitShipping) : []
            return err
        },
        hasErrors() {
            return this.errorsKey.length > 0
        },
    },
    watch: {
        hasErrors (val) {
            this.close = val ? true : false
        },
    },
    methods: {
        submit () {
            this.formCollaboratorShipping.post(route('collaborator.shipping.store'), {
                preserveScroll: true,
                errorBag: 'submitShipping',
            })
        },
        closeAlertValidation () {
            this.close = false
        },
    },
}
</script>

<style lang="scss" scoped>

    .validator-alert{
        border-radius: 6px;
        box-shadow: 7px 7px 15px 0 rgba(0, 0, 0, 0.25);
        background-color: #fff;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 999;
    }

    .orange {
        color: #ff9c06;
    }

    .card {
        background-color: #f6f6f6;
        border: none;
        box-shadow: 4.1px 4.1px 8.1px 0 rgba(0, 0, 0, 0.25);
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
    .btn-submit{
        font-size: 1.3rem;
        //padding: 11.3px 38.3px;
        border-radius: 5px;
        background-color: #ff9c06;
        color: #fff;
        padding: 4rem 8rem;
    }

</style>