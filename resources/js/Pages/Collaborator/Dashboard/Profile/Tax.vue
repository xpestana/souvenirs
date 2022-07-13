<template>
    <section id="dashboard-perfil-tax" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i> Datos fiscales</h1>
            </div>
        </div>
        <!--END Header section-->
         <!-- Content section-->
        <div class="perfil-tax row mx-1.5 lg:mx-0 mt-8">
            <form @submit.prevent="submitProfile" class="col-12 col-md-9">
                <ValidationAlert
                    :errors="formatErrors"
                />
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Documento de identificación <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="NIF..."
                            v-model="form.nif" 
                            :class="{'error-input': errorsKey.includes('nif')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Razón social <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Razón social..."
                            v-model="form.razon" 
                            :class="{'error-input': errorsKey.includes('razon')}"
                        >
                    </div>
                    <div class="col-12 col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Persona de contacto <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="N° Id Fiscal..."
                            v-model="form.identifier" 
                            :class="{'error-input': errorsKey.includes('identifier')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Teléfono <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Teléfono..."
                            v-model="form.phone" 
                            :class="{'error-input': errorsKey.includes('phone')}"
                        >
                    </div>
                    <div class="col-12  col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Correo eléctronico <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Correo eléctronico..."
                            v-model="form.email" 
                            :class="{'error-input': errorsKey.includes('email')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Domicilio de facturación <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Domicilio de facturación..."
                            v-model="form.address"
                            :class="{'error-input': errorsKey.includes('address')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Código postal <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Código postal..."
                            v-model="form.cp"
                            :class="{'error-input': errorsKey.includes('cp')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Provincia <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Provincia..."
                            v-model="form.province" 
                            :class="{'error-input': errorsKey.includes('province')}"
                        >
                    </div>
                    <div class="col-12 col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Ciudad <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Ciudad..."
                            v-model="form.city" 
                            :class="{'error-input': errorsKey.includes('city')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">
                        <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"><i class="fas fa-save mr-2 text-white"></i>Guardar cambios</button>
                    </div>
                </div>
            </form>
            
        </div>
        <!-- END Content section-->
        <!-- Modal Request -->
        <div class="modal modal-exit fade" id="exit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content modal-exits modal mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" data-dismiss="modal" @click.prevent="closeModalBack()"></i>
                        </div>
                        <h2 class="text-lg text-center mt-3.5 font-bold">Hay cambios sin guardar</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            ¿Estas seguro que quieres salir?
                        </p>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" data-dismiss="modal" @click.prevent="closeModalBack()">Seguir editando</button>
                        </div>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" data-dismiss="modal"  @click.prevent="forceExit()">Salir sin guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Request  -->
    </section>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3';
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:TemplateApp,
    components:{
        Link,
        ValidationAlert
    },
    props: ['auth'],
    data(){
        return{
            form: this.$inertia.form({
            	_method: "PUT",
                name: '',
                email: '',
                phone: '',
                razon: '',
				nif: '',
                identifier: '',
                province: '',
				city: '',
				cp: '',
				address: '',
            }),
            forceExitConfirm: false,
            beforeUrl: '',
            typeBack: '1',
            errorsKey: [],
        }
    },
    computed: {
        formValid () {
            if (
                this.form.name === this.auth.profile.firstname &&
                this.form.email === this.auth.user.email &&
                this.form.phone === this.auth.profile.phone &&
                this.form.razon === this.auth.profile.razon &&
                this.form.nif === this.auth.profile.nif &&
                this.form.identifier === this.auth.profile.identify &&
                this.form.city === this.auth.profile.city &&
                 this.form.province === this.auth.profile.province &&
                this.form.cp === this.auth.profile.cp &&
                this.form.address === this.auth.profile.address
            ) { return true }
            return false
        },
        formatErrors () {
            var map = this.errorsKey.map( item => {
                switch (item) {
                    case 'name':
                        return 'Nombre'
                        break;
                    case 'email':
                        return 'Correo electrónico'
                        break;
                    case 'phone':
                        return 'Telefono'
                        break;
                    case 'razon':
                        return 'Razón social'
                        break;
                    case 'nif':
                        return 'Documento de identificación'
                        break;
                    case 'identifier':
                        return 'Persona de contacto'
                        break;
                    case 'city':
                        return 'Ciudad'
                        break;
                    case 'province':
                        return 'Provincia'
                        break;
                    case 'cp':
                        return 'Código postal'
                        break;
                    case 'address':
                        return 'Domicilio de facturación'
                        break;
                    default:
                    return item
                }
            })
            return map
        },
    },
    created () {
        this.updateForm()
    },
    mounted () {
        this.moveConfirm = Inertia.on('before', (event) => {
            if (!this.formValid) {
                if (!this.forceExitConfirm) {
                    this.beforeUrl = event.detail.visit.url.pathname
                    $('#exit').modal('show')
                    event.preventDefault()
                    event.returnValue = ''
                }
            }
        })
    },
    unmounted () {
        this.moveConfirm()
    },
    methods: {
        submitProfile() {
            this.forceExitConfirm = true
            this.form.put(route('collaborator.fiscal.update'), {
                preserveScroll: true,
                errorBag: 'submitTax',
                onSuccess:()=>{
                    this.forceExitConfirm = false
                    $('#datosModal').modal('hide')
                    this.updateForm()
                },
                onError: (errors) => {
                    this.forceExitConfirm = false
                    this.getErrorsKey()
                    this.emitter.emit('errors')
                },
            })
        },    
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
        updateForm () {
            this.form.name = this.auth.profile.firstname
            this.form.email = this.auth.user.email
            this.form.phone = this.auth.profile.phone
            this.form.razon = this.auth.profile.razon
            this.form.nif = this.auth.profile.nif
            this.form.identifier = this.auth.profile.identify
            this.form.city = this.auth.profile.city
            this.form.province = this.auth.profile.province
            this.form.cp = this.auth.profile.cp
            this.form.address = this.auth.profile.address
        },
        goBack () {
            if (!this.formValid) {
                if (!this.forceExitConfirm) {
                    this.typeBack = '2'
                    $('#exit').modal('show')
                }
            } else {
                window.history.back()
            }
        },
        closeModalBack () {
            this.typeBack = '1'
            this.forceExitConfirm = false
            $('#exit').modal('hide')
        },
        forceExit () {
            this.forceExitConfirm = true
            if (this.typeBack == '2') { window.history.back() }
            else {
                setTimeout(() =>{
                    Inertia.get(`${this.beforeUrl}`)
                }, 500)
            }
        },
        getErrorsKey () {
            this.errorsKey = this.$page.props.errors.submitTax ? Object.keys(this.$page.props.errors.submitTax) : []
        },
    },
    updated(){
    },
}
</script>
<style scoped>
</style>