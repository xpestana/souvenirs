<template>
<div class="fondo">
	<div class="container px-0 px-lg-5 pt-md-5">
		<div class="tabla-container">
			<div class="row text-center">
				<div class="col-12 py-4">
					<h1 class="display-4 text-azulc font-weight-bolder">Gestión de administradores</h1>
				</div>
			</div>
			<div class="row justify-content-center justify-content-md-between px-lg-5 pt-4">
				<div class="col-11 col-md-6 col-lg-5 text-center text-md-left">
					<button type="button" class="btn btn-azulc py-1 px-3 text-white" data-toggle="modal" data-target="#createAdmin">Agregar administrador<i class="fas fa-plus px-1 px-lg-2"></i></button>
						<!-- Central Modal Small -->
						<div class="modal fade" id="createAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
						aria-hidden="true">
						<!-- Change class .modal-sm to change the size of the modal -->
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content mx-auto" style="width:100% !important">
									<div class="modal-body p-0">
										<form @submit.prevent="submitAdmin">
											<div class="row mt-5 mb-2 px-5 mx-0 mx-md-2">
												<div class="col-12 col-md-6 my-1 pr-md-1">
													<BreezeInput type="text" class="w-100 p-input" placeholder="Nombre" v-model="formadmin.firstname" required/>
												</div>
												<div class="col-12 col-md-6 my-1 pl-md-1">
													<BreezeInput type="text" class="w-100 p-input" placeholder="Apellido" v-model="formadmin.lastname" required/>
												</div>
												<div class="col-12 my-1">
													<BreezeInput type="email" class="w-100 p-input" autocomplete="on" placeholder="Correo electrónico" v-model="formadmin.email" required/>
												</div>
												<div class="col-12 my-1">
													<BreezeInput type="email" class="w-100 p-input" autocomplete="off" placeholder="Repetir correo electrónico" v-model="formadmin.email_confirmation" required/>
												</div>
												<div class="col-12 my-1">
													<BreezeInput type="password" class="w-100 p-input" autocomplete="off" placeholder="Contraseña" v-model="formadmin.password" required/>
												</div>
												<div class="col-12 my-1">
													<BreezeInput type="password" class="w-100 p-input" autocomplete="off" placeholder="Confirmar contraseña" v-model="formadmin.password_confirmation" required/>
												</div>
											</div>
											<div class="row">
												<div class="col-12 px-5 py-2">
													<breeze-valid/>
												</div>
											</div>
											<div class="row px-3 py-4 mb-3">
												<div class="col-6 text-left">
													<button type="button" class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" href="#" data-dismiss="modal" >Volver</button>
												</div>
												<div class="col-6 text-right">
													<button type="submit" class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" >Guardar</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- Central Modal Small -->
				</div>
				<div class="col-8 col-sm-5 col-md-5 col-lg-3 mt-2 mt-md-0">
					<div class="input-search m-0">
						<span class="fa fa-search text-muted d-block position-absolute text-center"></span>
						<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="form.search" @keyup.prevent="submit">
					</div>
				</div>
			</div>
			<div class="row px-lg-5 pt-3">
				<div class="col-12">
					<div class="table-responsive-md bg-white">
						<table class="table table-striped table-borderless">
							<thead class="table-active text-center">
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido</th>
									<th scope="col">Dirección de correo</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody class="text-center" id="tbody">
								<tr v-for="admin in admins.data" :key="admin.id">
									<td>{{admin.profile.firstname}}</td>
									<td>{{admin.profile.lastname}}</td>
									<td>{{admin.email}}</td>
									<td>
										<div class="d-inline-flex">
											<button type="button" class="btn btn-sm btn-editar text-white d-inline" data-toggle="modal" :data-target="'#editAdmin'+admin.id" @click="asignarDatos(admin.profile.firstname,admin.profile.lastname,admin.email)">Editar</button>
											<button type="button" class="btn btn-sm btn-danger ml-1 d-inline" @click="eliminar">Eliminar</button>
										</div>
										<!-- Central Modal Small -->
										<div class="modal fade" :id="'editAdmin'+admin.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
										aria-hidden="true">
										<!-- Change class .modal-sm to change the size of the modal -->
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content mx-auto" style="width:100% !important">
													<div class="modal-body p-0">
														<form @submit.prevent="submitEdit(admin.id)">
															<div class="row mt-5 mb-2 px-5 mx-0 mx-md-2">
																<div class="col-12 col-md-6 my-1 pr-md-1">
																	<BreezeInput type="text" class="w-100 p-input" placeholder="Nombre" v-model="formedit.firstname" required/>
																</div>
																<div class="col-12 col-md-6 my-1 pl-md-1">
																	<BreezeInput type="text" class="w-100 p-input" placeholder="Apellido" v-model="formedit.lastname" required/>
																</div>
																<div class="col-12 my-1">
																	<BreezeInput type="email" class="w-100 p-input" autocomplete="on"  placeholder="Correo electrónico" v-model="formedit.email" required/>
																</div>
																<div class="col-12 my-1">
																	<BreezeInput type="email" class="w-100 p-input" autocomplete="off" placeholder="Repetir correo electrónico" v-model="formedit.email_confirmation" required/>																</div>
																<div class="col-12 my-1">
																	<BreezeInput type="password" class="w-100 p-input" autocomplete="off" placeholder="Contraseña"  v-model="formedit.password"/>
																</div>
																<div class="col-12 my-1">
																	<BreezeInput type="password" class="w-100 p-input" autocomplete="off" placeholder="Confirmar contraseña" v-model="formedit.password_confirmation" />
																</div>
															</div>
															<div class="row">
																<div class="col-12">
																	<ValidationErrors/>
																</div>
															</div>
															<div class="row px-3 py-4 mb-3">
																<div class="col-6 text-left">
																	<button type="button" class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" href="#" data-dismiss="modal" >Volver</button>
																</div>
																<div class="col-6 text-right">
																	<button type="submit" class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" >Guardar</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<!-- Central Modal Small -->
									</td>
								</tr>
								<tr v-if="admins.data.length < 1">
									<td colspan="4">No hay resultados para la busqueda</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row justify-content-md-center px-0 px-lg-5 py-2 mb-3 mx-md-5">
				<div class="col-12 col-md-6 px-1 px-sm-auto py-3 py-sm-0">
					<paginator :paginator="admins" />
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
import Paginator from '@/Components/Paginator'
import { Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Pages/Admin/Layouts/Layout'
import BreezeInput from '@/Components/Input'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
import BreezeValid from '@/Components/ValidationErrors.vue'
export default {
	layout:Layout,
	components: {
		Paginator,
		Link,
		BreezeInput,
		ValidationErrors,
		BreezeValid
	},
	props: {
		admins: Object
	},
	created(){
		console.log("usuarios administradores: ",this.admins.data);
		console.log("admins: ",this.admins);
		//console.log("datos de perfil administradores: ",this.admins.data[0].profile);
	},
	data(){
		return{
			form: this.$inertia.form({
				search: null,
			}),
			formadmin: this.$inertia.form({
				firstname: null,
				lastname: null,
				email: null,
				email_confirmation: null,
				password: null,
				password_confirmation: null,
			}),
			formedit: this.$inertia.form({
				_method:"PUT",
				firstname: null,
				lastname: null,
				email: null,
				email_confirmation: null,
				password: null,
				password_confirmation: null,
			})
		}
	},
	mounted(){
		this.busqueda()
	},
	methods:{
		busqueda(){
			let input = this.$page.url.split("?search=","2")[1];
			if(input !== undefined){
				this.form.search = input;	
			}
		},
		submit() {
			this.admins.data = {};
			let nodos = document.getElementById('tbody').childNodes.length;
			if(nodos == 3 || nodos > 4){
				let tr =`<tr><td colspan="4">
					<div class="spinner-border text-info" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</td></tr>`
				document.getElementById('tbody').insertAdjacentHTML("afterbegin",tr);
			}
			setTimeout(()=>{
				this.form.get(this.route('admin.administradores'), {
					preserveScroll: true,
				});
			},1500);
		},
		submitAdmin() {
			const modalcreate = $('#createAdmin');
			this.formadmin.post(route('admin.store'),{
				_token: this.$page.props.csrf_token,
				preserveScroll: true,
				forceFormData: true,
				onSuccess: (result) => {
					modalcreate.modal('hide');
					if(this.$page.props.flash.code == 200){
						this.form.reset();
						this.eraseFeatured();
					};
				}
				
			})
		},
		submitEdit(id) {
			const modal = $('#editAdmin'+id);
			this.formedit.post(route('admin.update',{admin: id}),{
				_token: this.$page.props.csrf_token,
				errorBag: 'submit',
				preserveScroll: true,
				forceFormData: true,
				onSuccess: (result) => {
					modal.modal('hide')
					if(this.$page.props.flash.code == 200){
						this.form.reset();
						this.eraseFeatured();
					};
				}
				
			})
		},
		asignarDatos(nombre,apellido,email){
			this.formedit.firstname = nombre;
			this.formedit.lastname = apellido;	
			this.formedit.email = email;
			this.formedit.email_confirmation = email;
		},
		eliminar(){
			this.$swal({
                title: '¿Esta seguro de eliminar este usuario?',
                icon: 'warning',
                showCloseButton: false,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            }).then((res)=>{
                if(res.isConfirmed)
                {
                    // alert('Aceptado')
                }
            })
		}
	},
	computed: {
	}
	
}
</script>
<style scoped>
.fondo{
	background:no-repeat url('/vendor_asset/img/fadmins2.png');
	background-size: cover;
	height: 100%;
}
.tabla-container .input-search span{
    z-index: 2;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    pointer-events: none;
}
.tabla-container .input-search input{
    padding-left: 35px;
}
.tabla-container .btn-editar{
	background-color: #2b59a2;
}
.tabla-container .p-input{
    padding: 12px 10px;
}
@media (max-width:767px){
	.tabla-container{
		position:static;
	}
	.tabla-container .display-4{
		font-size: 35px;
	}
	.fondo{
		background:none;
		background-size: static;
	}	
}
</style>