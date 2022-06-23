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
                        <span class="title">Shipping information</span>
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
                <div class="col-11 col-md-5">
                    <label class="py-2">Identification document <span class="required-input">*</span></label>
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
                        <label class="py-2">Business name <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.businessName"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Business name..."
                            :class="{'error-input': errorsKey.includes('businessName')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Contact person <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.contactPerson"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="N id tax..."
                            :class="{'error-input': errorsKey.includes('contactPerson')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Phone <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.phone"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Phone..."
                            :class="{'error-input': errorsKey.includes('phone')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Email <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.email"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Email..."
                            :class="{'error-input': errorsKey.includes('email')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Delivery address <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.deliveryAddress"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Billing address..."
                            :class="{'error-input': errorsKey.includes('deliveryAddress')}"
                        >
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Postal code <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.postalCode"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Postal code..."
                            :class="{'error-input': errorsKey.includes('postalCode')}"
                        >
                </div>
            </div>
            <div class="row mt-4 mb-12 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Province <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.province"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="Province..."
                            :class="{'error-input': errorsKey.includes('province')}"
                        >
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">City <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.city"
                            type="text"
                            class="input-datos form-control-file"
                            placeholder="City..."
                            :class="{'error-input': errorsKey.includes('city')}"
                        >
                </div>
            </div>
            <div class="d-flex justify-content-center justify-content-md-start  mb-12">
                    <button
                        type="submit"
                        class="btn btn-collaborator btn-lg px-8 py-3 rounded-4 text-white d-flex aligin-items-center text-2xl"
                        :class="{ 'opacity-25': formCollaboratorShipping.processing }" :disabled="formCollaboratorShipping.processing"
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
    },
    methods: {
        submit () {
            this.formCollaboratorShipping.post(route('collaborator.shipping.store'), {
                preserveScroll: true,
                errorBag: 'submitShipping',
                onSuccess:()=>{
                    $('#datosModal').modal('hide')
                }
            })
        },
        closeAlertValidation () {
            this.close = false
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