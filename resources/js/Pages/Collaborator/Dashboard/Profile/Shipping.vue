<template>
    <div  id="dashboard-perfil-shipping" class="container  py-8 ml-2 md:ml-0 md:px-24" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <div>
                    <h1 class="font-bold text-lg md:text-3xl text-muted"><Link
                        :href="route('collaborator.home')"
                        class="text-muted mr-2"
                    >
                        <i class="fas fa-arrow-left"></i>
                    </Link>Datos de envío</h1>
                </div>
            </div>
        </div>
         <!--END Header-->
        <!--Formulario de envio -->
        <div
            class="perfil-shipping row mx-1.5 lg:mx-0 mt-8 justify-content-start"
            :class="{'position-relative': windowWidth >= 768}"
        >
            <!--Alert validation -->
            <ValidationAlert
                :errors="formatErrors"
            />
            <div class="col-12 col-md-12">
                <form
                    @submit.prevent="submit()"
                    :class="{'position-relative': windowWidth >= 768}"
                    class="row"
                >
                     <!--END Alert validation -->
                    <div class="col-12 col-md-5 my-1.5 px-0">
                        <label class="font-bold">Documento de identificación <span class="required-input">*</span></label>
                        <input
                            v-model="formCollaboratorShipping.document"
                            type="text"
                            class="w-100 rounded col-form-input py-1.5" placeholder="NIF..."
                            :class="{'error-input': errorsKey.includes('document')}"
                        >
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <div class="row px-0">
                            <div class="col-12 col-md-5 pr-md-0">
                                    <label class="font-bold">Razón social <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.businessName"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="Razón social..."
                                        :class="{'error-input': errorsKey.includes('businessName')}"
                                    >
                            </div>
                            <div class="col-12 mt-2.5 mt-md-0 col-md-5">
                                    <label class="font-bold">Persona de contacto <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.contactPerson"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="N id Fiscal..."
                                        :class="{'error-input': errorsKey.includes('contactPerson')}"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <div class="row px-0">
                            <div class="col-12 col-md-5 pr-md-0">
                                    <label class="font-bold">Telefono <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.phone"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="Telefono..."
                                        :class="{'error-input': errorsKey.includes('phone')}"
                                    >
                            </div>
                            <div class="col-12 mt-2.5 mt-md-0 col-md-5">
                                    <label class="font-bold">Correo electrónico <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.email"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="Correo electrónico..."
                                        :class="{'error-input': errorsKey.includes('email')}"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 my-1.5 px-0">
                            <label class="font-bold">Domicilio de entrega 
                            <span class="required-input">*</span>
                            </label>
                            <input
                                v-model="formCollaboratorShipping.deliveryAddress"
                                type="text"
                                class="w-100 rounded col-form-input py-1.5"
                                placeholder="Domicilio de facturarión..."
                                :class="{'error-input': errorsKey.includes('deliveryAddress')}"
                            >
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-12 col-md-5 my-1.5 px-0">
                            <label class="font-bold">Código postal <span class="required-input">*</span></label>
                            <input
                                v-model="formCollaboratorShipping.postalCode"
                                type="text"
                                class="w-100 rounded col-form-input py-1.5"
                                placeholder="Código postal..."
                                :class="{'error-input': errorsKey.includes('postalCode')}"
                            >
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-12 my-1.5 px-0">
                        <div class="row">
                            <div class="col-12 col-md-5 pr-md-0">
                                    <label class="font-bold">Provincia <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.province"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="Provincia..."
                                        :class="{'error-input': errorsKey.includes('province')}"
                                    >
                            </div>
                            <div class="col-12 mt-2.5 mt-md-0 col-md-5">
                                    <label class="font-bold">Ciudad <span class="required-input">*</span></label>
                                    <input
                                        v-model="formCollaboratorShipping.city"
                                        type="text"
                                        class="w-100 rounded col-form-input py-1.5"
                                        placeholder="Ciudad..."
                                        :class="{'error-input': errorsKey.includes('city')}"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">
                             <button
                             type="submit"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                             :class="{ 'opacity-25': formCollaboratorShipping.processing }"
                             :disabled="formCollaboratorShipping.processing">
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
        formatErrors () {
            var map = this.errorsKey.map( item => {
                switch (item) {
                    case 'document':
                        return 'Documento de identificación'
                        break;
                    case 'businessName':
                        return 'Razón social'
                        break;
                    case 'contactPerson':
                        return 'Persona de contacto'
                        break;
                    case 'phone':
                        return 'Telefono'
                        break;
                    case 'email':
                        return 'Correo electrónico'
                        break;
                    case 'deliveryAddress':
                        return 'Domicilio de facturación'
                        break;
                    case 'postalCode':
                        return 'Código postal'
                        break;
                    case 'province':
                        return 'Provincia'
                        break;
                    case 'city':
                        return 'Ciudad'
                        break;
                    default:
                    return item
                }
            })
            return map
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