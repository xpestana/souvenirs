<template>
	<section class="bg-register" style="background-image: url('/vendor_asset/img/skyline.png');">
		<div class="degradado">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 card  tab-content dashboard-content shadow-lg my-5">
						<form @submit.prevent="submit" class="mt -4">
							<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
							<div class="row">
								<div class="col-md-7">
									<h3>Datos personales</h3>
									<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.name" autocomplete="name" placeholder="Persona en contacto *" required/>
									<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.phone" autocomplete="phone" placeholder="Número de teléfono *" required/>

									<select name="gestor" id="gestor" class="form-control w-100 select" required v-model="form.gestor">
										<option value="0">Eres gestor de *: </option>
										<option value="1">Hotel</option>
										<option value="2">Apartamento</option>
									</select>
								</div>
								<div class="col-md-5">
									<img src="/vendor_asset/img/logo/logo.png" class="my-4 mx-auto">
								</div>
								<div class="col-md-12 mt-4">
									<h3>Datos fiscales</h3>
									<div class="row justify-content-between">
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.razon" autocomplete="razon" placeholder="Razón social *" required/>
										</div>
										<div class="col-md-6">
											<select name="nif" id="nif" v-model="form.nif" class="form-control w-100 select" required>
												<option value="NIF Español">NIF Español</option>
												<option value="Número VAT intracomunitario">Número VAT intracomunitario</option>
												<option value="Pasaporte">Pasaporte</option>
												<option value="Documento oficial país de residencia">Documento oficial país de residencia</option>
												<option value="Certificado de residencia">Certificado de residencia</option>
												<option value="Otro documento probatorio">Otro documento probatorio</option>
												<option value="No censado">No censado</option>
											</select>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.id" autocomplete="id" placeholder="N° de Identificador Fiscal *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.country" autocomplete="country" placeholder="País *" value="España" readonly="" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" autocomplete="city" placeholder="Ciudad *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" autocomplete="cp" placeholder="Codigo Postal *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" autocomplete="address" placeholder="Dirección fiscal *" required/>
										</div>
										<div class="w-100">
											<ValidationErrors class="my-3" />
										</div>
										<div align="center" class="col-12 mt-3 text-center">
											<button type="submit" class="btn btn-primary  rounded-pill  w-50 py-1 mt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
												Crear cuenta
											</button>
											<div v-if="status" class="mb-4 font-medium text-sm text-danger mt-4">
												{{ status }}
											</div>	
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	import BreezeInput from '@/Components/Input.vue'
	import BreezeButton from '@/Components/Button.vue'
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import Notify from '@/Layouts/Components/Toast.vue'

	export default {
		components:{
			BreezeInput,
			BreezeButton,
			ValidationErrors,
			Notify,
		},
		data(){
			return {
				form: this.$inertia.form({
					name: null,
					phone: null,
					gestor: "0",
					razon: null,
					nif: 'NIF Español',
					id: null,
					city: null,
					cp: null,
					address: null,
				})
			}
		},
		methods: {
			submit() {
				var gestor = document.getElementById('gestor').value;
				this.form.gestor = gestor;
				this.form.post(route('collaborator.register.data'),{
					_token: this.$page.props.csrf_token,
					errorBag: 'submit',
					preserveScroll: true,
				})
			},
			logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
		}
	}
</script>
<style scope>
	.degradado {
		background: linear-gradient(180deg, rgb(255 255 255 / 88%) 0%, rgb(0 212 255 / 0%) 30%);
		display:flex;
	}
	form .select{
		font-size: 1.1em;
		color: #6c757d;
		padding-top: 0px;
		padding-left: 10px;
	}
	body{
		background-color: #6fb2c6;
	}
	.bg-register{
		width: 100%;
		background-position: bottom left;
		background-size: contain;
		background-repeat: no-repeat;
	}
</style>