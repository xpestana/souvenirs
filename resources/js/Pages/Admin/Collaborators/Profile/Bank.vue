<template>
    <div id="dashboard-perfil-bank" class="container  py-8 ml-2 md:ml-0 md:px-24" :class="{'position-relative': windowWidth < 768}">
        <ModalCookies/>
        <!-- HEADER -->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    Información bancaria
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
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import Layout from '@/Pages/Admin/Layouts/Layout'
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:Layout,
    components:{
        Head,
        Link,
        ModalCookies,
        ValidationAlert,
    },
    props: ['collaboratorBank'],
    data() {
        return {
            windowWidth: window.innerWidth,
            validForm: true,
            formCollaboratorBank: this.$inertia.form({
            	_method: "POST",
                holder: '',
                iban: '',
            }),
            forceExitConfirm: false,
            beforeUrl: '',
            typeBack: '1',
            errorsKey: [],
        }
    },
    computed: {
        formatErrors () {
            var map = this.errorsKey.map( item => {
                switch (item) {
                    case 'holder':
                        return 'Titulo de la cuenta'
                        break;
                    case 'iban':
                        return 'Iban'
                        break;
                    default:
                    return item
                }
            })
            return map
        },
        formValid () {
            if (
                this.formCollaboratorBank.holder === this.collaboratorBank.holder &&
                this.formCollaboratorBank.iban === this.collaboratorBank.iban
            ) { return true }
            return false
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
        submit () {
            this.forceExitConfirm = true
            /*this.formCollaboratorBank.post(route('collaborator.bank.store'), {
                preserveScroll: true,
                errorBag: 'submitBank',
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
        changeValidIban (input) {
            var value = input.target.value
            var regexIban = /^ES\d{22}$/
            var valid = regexIban.test(value)
            if (valid) { this.validForm = true }
            else { this.validForm = false }
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
            this.formCollaboratorBank.holder = this.collaboratorBank.holder
            this.formCollaboratorBank.iban = this.collaboratorBank.iban
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
            this.errorsKey = this.$page.props.errors.submitBank ? Object.keys(this.$page.props.errors.submitBank) : []
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