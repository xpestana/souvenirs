<template>
	<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
	<form @submit.prevent="submit" class=" mt-10">
		<BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="E-mail*" v-model="form.email" required/>
		<BreezeInput type="text" class="form-control my-2 py-4" autocomplete="on" placeholder="Confirmar E-mail" v-model="form.email_confirmation" required/>
		<BreezeInput type="password" class="form-control my-2 py-4" autocomplete="off" placeholder="Contraseña" v-model="form.password" required/>
		<h3>Datos personales</h3>
		<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.name" autocomplete="name" placeholder="Persona en contacto *" required/>
		<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.phone" autocomplete="phone" placeholder="Número de teléfono *" required/>

		<select name="gestor" id="gestor" class="form-control w-100 select" required v-model="form.gestor">
			<option value="0">Eres gestor de *: </option>
			<option value="1">Hotel</option>
			<option value="2">Apartamento</option>
		</select>
	
		<h3>Datos fiscales</h3>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.razon" autocomplete="razon" placeholder="Razón social *" required/>
				<select name="nif" id="nif" v-model="form.nif" class="form-control w-100 select" required>
					<option value="NIF Español">NIF Español</option>
					<option value="Número VAT intracomunitario">Número VAT intracomunitario</option>
					<option value="Pasaporte">Pasaporte</option>
					<option value="Documento oficial país de residencia">Documento oficial país de residencia</option>
					<option value="Certificado de residencia">Certificado de residencia</option>
					<option value="Otro documento probatorio">Otro documento probatorio</option>
					<option value="No censado">No censado</option>
				</select>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.id" autocomplete="id" placeholder="N° de Identificador Fiscal *" required/>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.country" autocomplete="country" placeholder="País *" value="España" readonly="" required/>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" autocomplete="city" placeholder="Ciudad *" required/>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" autocomplete="cp" placeholder="Codigo Postal *" required/>
				<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" autocomplete="address" placeholder="Dirección fiscal *" required/>
			<button type="submit" class="btn btn-primary mt-4 w-100 rounded-pill py-3 register_btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Regístrate ahora</button>
			<ValidationErrors class="my-3" />
		</form>
	</template>
	<script>
		import BreezeInput from '@/Components/Input.vue'
		import BreezeButton from '@/Components/Button.vue'
		import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
		import Notify from '@/Layouts/Components/Toast.vue'

		export default {
			components:{
				BreezeInput,
				BreezeButton,
				ValidationErrors,
				Notify
			},
			data(){
				return {
					form: this.$inertia.form({
						email: null,
						email_confirmation: null,
						password: '',
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
					this.form.post(route('admin.collaborator.store'),{
						_token: this.$page.props.csrf_token,
						errorBag: 'submit',
						preserveScroll: true,
					})
				},
			}
		}
	</script>