<template>
    <div  id="dashboard-perfil-shipping" class="container  py-8 ml-2 md:ml-0 md:px-24" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <div>
                    <h1 class="font-bold text-lg md:text-3xl text-muted">
                        <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                        Datos de envío
                    </h1>
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
         <!-- Modal Request -->
        <div class="modal modal-notice fade" id="exit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content modal-exits modal mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <h2 class="text-lg text-center mt-3.5 font-bold">Hay cambios sin guardar</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            ¿Estas seguro que quieres salir?
                        </p>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" data-dismiss="modal" aria-label="Close">Seguir editando</button>
                        </div>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" data-dismiss="modal"  @click.prevent="forceExit()">Salir sin guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Request  -->
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
    props: ['collaboratorShipping'],
    data() {
        return {
            close: false,
            windowWidth: window.innerWidth,
            formCollaboratorShipping: this.$inertia.form({
            	_method: "POST",
                document: '',
                businessName: '',
                contactPerson: '',
                phone: '',
                email: '',
                deliveryAddress: '',
                postalCode: '',
                province: '',
                city: '',
            }),
            forceExitConfirm: false,
            beforeUrl: '',
        }
    },
    created () {
        this.updateForm()
    },
    mounted () {
        this.moveConfirm = Inertia.on('before', (event) => {
            if (!this.formValid ) {
                if (!this.forceExitConfirm) {
                    this.beforeUrl = event.detail.visit.url.pathname
                    $('#exit').modal('show')
                    event.preventDefault()
                }
            }
        })
    },
    unmounted () {
        this.moveConfirm()
    },
    computed: {
        errorsKey () {
            var err = this.$page.props.errors.submitShipping ? Object.keys(this.$page.props.errors.submitShipping) : []
            return err
        },
        formValid () {
            if (
                this.formCollaboratorShipping.document === this.collaboratorShipping.document &&
                this.formCollaboratorShipping.businessName === this.collaboratorShipping.businessName &&
                this.formCollaboratorShipping.contactPerson === this.collaboratorShipping.contactPerson &&
                this.formCollaboratorShipping.phone === this.collaboratorShipping.phone &&
                this.formCollaboratorShipping.email === this.collaboratorShipping.email &&
                this.formCollaboratorShipping.deliveryAddress === this.collaboratorShipping.deliveryAddress &&
                this.formCollaboratorShipping.postalCode === this.collaboratorShipping.postalCode &&
                this.formCollaboratorShipping.province === this.collaboratorShipping.province &&
                this.formCollaboratorShipping.city === this.collaboratorShipping.city
            ) { return true }
            return false
        },
    },
    methods: {
        submit () {
            this.forceExitConfirm = true
            this.formCollaboratorShipping.post(route('collaborator.shipping.store'), {
                preserveScroll: true,
                errorBag: 'submitShipping',
                onSuccess:()=>{
                    $('#datosModal').modal('hide')
                    this.updateForm()
                    this.forceExitConfirm = false
                }
            })
        },
        forceExit () {
            setTimeout(() =>{
                Inertia.get(`${this.beforeUrl}`)
            }, 500)
        },
        updateForm () {
            this.formCollaboratorShipping.document = this.collaboratorShipping.document
            this.formCollaboratorShipping.businessName = this.collaboratorShipping.businessName
            this.formCollaboratorShipping.contactPerson = this.collaboratorShipping.contactPerson
            this.formCollaboratorShipping.phone = this.collaboratorShipping.phone
            this.formCollaboratorShipping.email = this.collaboratorShipping.email
            this.formCollaboratorShipping.deliveryAddress = this.collaboratorShipping.deliveryAddress
            this.formCollaboratorShipping.postalCode = this.collaboratorShipping.postalCode
            this.formCollaboratorShipping.province = this.collaboratorShipping.province
            this.formCollaboratorShipping.city = this.collaboratorShipping.city
        },
        goBack () {
            this.forceExitConfirm = true
            window.history.back()
        }
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