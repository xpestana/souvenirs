<template>
	<div class="container">
        <ModalCookies/>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <h1 class="display-4 text-info">Información personal</h1>
            </div>
        </div>
            <!--Formulario INFORMACION PERSONAL -->
            <form @submit.prevent="submitProfile">
            <div class="row mt-5 justify-content-center justify-content-md-start">
                <div class="col-12 col-md-5">
                    <label class="py-2">Persona de contacto</label>
                    <input type="text" class="input-datos" placeholder="Persona de contacto" v-model="formP.name">
                </div>
                <div class="col-12 col-md-5">
                    <label class="py-2">Correo electrónico</label>
                    <input type="text" class="input-datos" placeholder="Correo electrónico"  v-model="formP.email">
                </div>
            </div>
            <div class="row mt-2 py-2 justify-content-center justify-content-md-start">
                <div class="col-12 col-md-5">
                    <label class="py-2">Numero de teléfono</label>
                    <input type="text" class="input-datos" placeholder="Numero de teléfono"  v-model="formP.phone">
                </div>
                <div class="col-12 col-md-5">
                    <label class="py-2">Contraseña</label>
                    <input type="password" class="input-datos" placeholder="Contraseña"  v-model="formP.password">
                </div>
            </div>
            <div class="row  mt-2 py-2 justify-content-center justify-content-md-start">
                <div class="col-12 col-md-5">
                        <label class="py-2">Datos fiscales</label>
                        <div class="d-md-inline-flex">
                            <input type="text" class="input-datos" placeholder="Datos fiscales" :value="formF.address+','+formF.city">
                            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#datosModal">Editar</button>
                        </div>
                </div>
                <div class="col-12 mt-3 text-left" v-if="errors.submitProfile">
                    <div class="font-medium text-danger">Whoops! Algo salió mal.</div>
                    <ul class="mt-3 list-disc list-inside text-sm text-danger">
                        <li v-for="(error, key) in errors.submitProfile" :key="key">{{ error }}</li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between my-2 h-100">
                <div class="col-12 col-md-5 align-self-start">
                    <a href="javascript:void(0);" @click.prevent="logout" class="btn btn-lg text-white btn-cerrar mt-4">Cerrar sesión<i class="fas fa-key pl-1 pr-2"></i></a>
                </div>
                <div class="col-12 col-md-5 text-right align-self-end">
                    <button class="btn btn-primary px-3 py-1 rounded-pill">Guardar cambios</button>
                </div>
            </div>
            </form>
            <!--Formulario MODAL DATOS FISCALES -->
            <form @submit.prevent="submitFiscal">
                <div class="modal fade" id="datosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content p-4">
                            <div class="modal-body p-0">
                                <div class="row">
                                    <label class="pl-3 mb-2">Datos fiscales</label>
                                </div>
                                <div class="row my-3">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="Razón social" v-model="formF.razon">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select class="w-100" v-model="formF.nif" id="nif">
                                            <option value="NIF Español">NIF Español</option>
                                            <option value="Número VAT intracomunitario">Número VAT intracomunitario</option>
                                            <option value="Pasaporte">Pasaporte</option>
                                            <option value="Documento oficial país de residencia">Documento oficial país de residencia</option>
                                            <option value="Certificado de residencia">Certificado de residencia</option>
                                            <option value="Otro documento probatorio">Otro documento probatorio</option>
                                            <option value="No censado">No censado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="N° Identificador Fiscal*" v-model="formF.identifier">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="España" value="España">
                                    </div>
                                </div>                
                                <div class="row my-3">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="Ciudad*" v-model="formF.city">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="Codigo Postal*" v-model="formF.cp">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Dirección fiscal*" v-model="formF.address" >
                                    </div>
                                </div>    
                                <div class="row justify-content-between align-items-end mt-4">
                                    <div class="col-12 my-2">
                                        <div v-if="errors.submitFiscal">
                                            <div class="font-medium text-danger">Whoops! Algo salió mal.</div>

                                            <ul class="mt-3 list-disc list-inside text-sm text-danger">
                                                <li v-for="(error, key) in errors.submitFiscal" :key="key">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-6 text-left">
                                        <button class="btn rounded-pill py-0 px-5 boton-modal text-white" data-dismiss="modal" >Volver</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="submit" class="btn rounded-pill py-0 boton-modal  text-white" :class="{ 'opacity-25': formF.processing }" :disabled="formF.processing">Guardar cambios</button>
                                    </div>
                                </div>            
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            formP: this.$inertia.form({
            	_method: "PUT",
                name: this.$page.props.auth.profile.firstname,
                email: this.$page.props.auth.user.email,
                phone: this.$page.props.auth.profile.phone,
                password: null,
            }),
            formF: this.$inertia.form({
            	_method: "PUT",
                razon: this.$page.props.auth.profile.razon,
				nif: this.$page.props.auth.profile.nif,
				identifier: this.$page.props.auth.profile.identify,
				city: this.$page.props.auth.profile.city,
				cp: this.$page.props.auth.profile.cp,
				address: this.$page.props.auth.profile.address,
            }),
        }
    	},
    	methods:{
    		submitProfile() {
            this.formP.put(route('collaborator.profile.update'), {
                preserveScroll: true,
                errorBag: 'submitProfile',
                })
            },
            submitFiscal() {
                this.formF.nif = $('#nif').val();
                this.formF.put(route('collaborator.fiscal.update'), {
                    preserveScroll: true,
                    errorBag: 'submitFiscal',
                    onSuccess:()=>{
                        $('#datosModal').modal('hide')
                    }
                })
            },
            logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            }
    	},
        computed: {
            errors() {
                return this.$page.props.errors
            },
        }
	}
</script>
<style scoped>
.input-datos{
    border: 0;
    background-color: #efefef;
    padding: 5px 60px 5px 10px;
    outline: none;
}
form label{
    font-size:1.7em;
    display: block;
}
form .boton-modal{
    background-color: #5a80fb;
}
.btn-cerrar{
    background-color: #e2e2e2;
}
.modal input{
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
.modal-content{
    width: 100% !important;
}
.h-100{
    height: 100px !important;
}
</style>