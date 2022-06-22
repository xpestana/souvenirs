<template>
    <div class="container">
        <div class="row mt-4 mt-md-6 mb-6 justify-content-center">
            <div class="col-10 col-md-12 card py-3 px-3 rounded-5">
                <h1>Datos de envio</h1>
            </div>
        </div>
        <!--Formulario INFORMACION PERSONAL -->
        <form @submit.prevent="submit()">
            <div class="row px-2 mt-5 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                    <label class="py-2">Documento de identificación <span class="required-input">*</span></label>
                    <input
                        v-model="formCollaboratorShipping.document"
                        type="text"
                        class="input-datos form-control-file" placeholder="NIF..."
                    >
                </div>
            </div>
            <div class="row mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Razón social <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.businessName" type="text" class="input-datos form-control-file" placeholder="Razón social...">
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Persona de contacto <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.contactPerson" type="text" class="input-datos form-control-file" placeholder="N id Fiscal...">
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Telefono <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.phone" type="text" class="input-datos form-control-file" placeholder="Telefono...">
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Correo electrónico <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.email" type="text" class="input-datos form-control-file" placeholder="Correo electrónico...">
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Domicio de entrega <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.deliveryAddress" type="text" class="input-datos form-control-file" placeholder="Domicilio de facturarión...">
                </div>
            </div>
            <div class="row  mt-4 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Código postal <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.postalCode" type="text" class="input-datos form-control-file" placeholder="Código postal...">
                </div>
            </div>
            <div class="row mt-4 mb-12 justify-content-center justify-content-md-start">
                <div class="col-11 col-md-5">
                        <label class="py-2">Provincia <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.province" type="text" class="input-datos form-control-file" placeholder="Provincia...">
                </div>
                <div class="col-11 mt-4 mt-md-0 col-md-5">
                        <label class="py-2">Ciudad <span class="required-input">*</span></label>
                        <input v-model="formCollaboratorShipping.city" type="text" class="input-datos form-control-file" placeholder="Ciudad...">
                </div>
            </div>
            <div class="row justify-content mb-12">
                <div class="col-11 col-md-5 text-center text-md-left">
                    <button type="submit" class="btn-submit btn-lg px-3 py-1 rounded-2"><i class="fa fa-save mr-2"></i>Guardar cambios</button>
                </div>
            </div>
        </form>
        <!--Formulario MODAL DATOS FISCALES -->
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies' 
export default {
    layout:TemplateApp,
    components:{
        Head,
        Link,
        ModalCookies
    },
    data() {
        return {
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
        errors () {
            return this.$page.props.errors
        }
    },
    methods: {
        submit () {
            this.formCollaboratorShipping.post(route('collaborator.shipping.store'), {
                preserveScroll: true,
                errorBag: 'submitShipping',
            })
        },
    },
}
</script>

<style lang="scss" scoped>
    .card {
        background-color: #f6f6f6;
        border: none;
        box-shadow: 4.1px 4.1px 8.1px 0 rgba(0, 0, 0, 0.25);
    }
    .required-input{
        color: #ff9c06;
    }
    .error-input{
        border: 2px solid red;
    }
    h1{
        font-size: 2rem;
        font-weight: bolder;
        color: #545454;
    }
    form label{
        font-weight: bolder;
        font-size: 1.5rem;
        display: block;
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

    .btn-submit{
        font-size: 1.3rem;
        //padding: 11.3px 38.3px;
        border-radius: 5px;
        background-color: #ff9c06;
        color: #fff;
        padding: 4rem 8rem;
    }

</style>