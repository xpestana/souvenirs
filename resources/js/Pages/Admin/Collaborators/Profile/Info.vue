<template>
    <section id="dashboard-perfil-infor" class="container py-8 ml-2 md:ml-0 md:px-24" :class="{'position-relative': windowWidth < 768}">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i> Información del perfil</h1>
            </div>
        </div>
        <div class="header row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de partners / {{user.profile.firstname}} / <b>Información del perfil</b></p>
            </div>
        </div>
        <!--END Header section-->
         <!-- Content section-->
        <div
            class="perfil-infor row mx-1.5 lg:mx-0 mt-2 mt-lg-0 justify-content-start"
            :class="{'position-relative': windowWidth >= 768}"
        >
            <!--Alert validation -->
            <ValidationAlert
                :errors="formatErrors"
            />
            <div class="col-12 col-md-6">
                <form @submit.prevent="submitProfile" class="row">
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold"><i class="fas fa-user mr-1"></i>Nombre</label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Nombre..."
                        :class="{'error-input': errorsKey.includes('name')}" v-model="form.name"
                        >
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label  class="font-bold"><i class="fas fa-envelope mr-1"></i>Correo eléctronico</label>
                        <input type="text" v-model="form.email" class="w-100 rounded col-form-input py-1.5" placeholder="Correo eléctronico..."
                            :class="{'error-input': errorsKey.includes('email')}"
                        >
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label  class="font-bold"><i class="fas fa-phone-alt mr-1"></i>Número de telefono</label>
                        <input type="text"  v-model="form.phone" class="w-100 rounded col-form-input py-1.5" placeholder="Número de telefono..."
                        :class="{'error-input': errorsKey.includes('phone')}"
                        >
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold"><i class="fas fa-key mr-1"></i>Cambiar contraseña</label>
                        <div class="relative w-100">
                            <i class="far fa-eye cursor-pointer absolute left-0 inset-y-1/3 my-auto px-2.5" v-on:click="showPass('password')"></i>
                            <input v-model="form.password" type="password" class="col-form-input w-100 rounded pl-8 py-1.5" id="password" placeholder="********"
                            :class="{'error-input': errorsKey.includes('password')}"
                            >
                        </div>
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold"><i class="fas fa-key mr-1"></i>Confirmar contraseña</label>
                        <div class="relative w-100">
                            <i class="far fa-eye cursor-pointer absolute left-0 inset-y-1/3 my-auto px-2.5" v-on:click="showPass('confirm-password')"></i>
                            <input v-model="form.confirm_password" type="password" class="col-form-input w-100 rounded pl-8 py-1.5" id="confirm-password" placeholder="********"
                            :class="{'error-input': errorsKey.includes('confirm_password')}"
                            >
                        </div>
                    </div>
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">
                        <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"><i class="fas fa-save mr-2 text-white"></i>Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Content section-->
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
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3';
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:Layout,
    components:{
        Link,
        ValidationAlert
    },
    props: ['auth','user'],
    data(){
        return{
            form: this.$inertia.form({
                _method: "PUT",
                name: '',
                email: '',
                phone: '',
                password: null,
                confirm_password: null,
            }),
            forceExitConfirm: false,
            beforeUrl: '',
            typeBack: '1',
            errorsKey: [],
            windowWidth: window.innerWidth,
        }
    },
    computed: {
        formValid () {
            if (
                this.form.name === this.user.profile.firstname &&
                this.form.email === this.user.email &&
                this.form.phone === this.user.profile.phone
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
                    default:
                    return item
                }
            })
            return map
        },
    },
    created () {
        this.updateForm()
        console.log(this.errorsKey)
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
    methods: {
        submitProfile() {
            this.forceExitConfirm = true
            /*this.form.put(route('collaborator.profile.update'), {
                preserveScroll: true,
                errorBag: 'submitProfile',
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
            })*/
        },    
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';
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
        updateForm () {
            this.form.name = this.user.profile.firstname
            this.form.email = this.user.email
            this.form.phone = this.user.profile.phone
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
        getErrorsKey () {
            this.errorsKey = this.$page.props.errors.submitProfile ? Object.keys(this.$page.props.errors.submitProfile) : []
        },
    }
}
</script>
<style scoped>
</style>