<template>
	<div class="row justify-content-center">
		<div class="col-md-7">
			<h2>Perfil</h2>
			<form @submit.prevent="submitProfile">
				<BreezeLabel for="name" value="Name" />
        		<BreezeInput id="name" type="name" class="form-control mt-1 block w-full" v-model="formP.name" autocomplete="name" placeholder="Name" />

        		<BreezeLabel for="email" value="email" />
        		<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="formP.email" autocomplete="email" placeholder="Email" />

        		<BreezeLabel for="phone" value="phone" />
        		<BreezeInput id="phone" type="phone" class="form-control mt-1 block w-full" v-model="formP.phone" autocomplete="phone" placeholder="phone" />

        		<BreezeLabel for="password" value="password" />
        		<BreezeInput id="password" type="password" class="form-control mt-1 block w-full" v-model="formP.password" autocomplete="password" placeholder="password" />

        		<button type="submit" class="btn btn-primary  rounded-pill  w-50 py-1 mt-3" :class="{ 'opacity-25': formF.processing }" :disabled="formF.processing">
												Guardar
											</button>
				<BreezeValidationErrors />
			</form>
		</div>
		<div class="col-md-7 mt-4">
			<form @submit.prevent="submitFiscal">
			<h3>Datos fiscales</h3>
				<div class="row justify-content-between">
					<div class="col-md-6">
						<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.razon" autocomplete="razon" placeholder="Razón social *" required/>
					</div>
					<div class="col-md-6">
						<select v-model="formF.nif" class="form-control w-100 select" required>
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
						<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.id" autocomplete="id" placeholder="N° de Identificador Fiscal *" required/>
					</div>
					<div class="col-md-6">
						<!-- <BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.country" autocomplete="country" placeholder="País *" value="España" required/> -->
					</div>
					<div class="col-md-6">
						<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.city" autocomplete="city" placeholder="Ciudad *" required/>
					</div>
					<div class="col-md-6">
						<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.cp" autocomplete="cp" placeholder="Codigo Postal *" required/>
					</div>
					<div class="col-md-6">
						<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="formF.address" autocomplete="address" placeholder="Dirección fiscal *" required/>
					</div>
					<div class="w-100">
					</div>
					<div align="center" class="col-12 mt-3 text-center">
						<BreezeValidationErrors />
						<button type="submit" class="btn btn-primary  rounded-pill  w-50 py-1 mt-3" :class="{ 'opacity-25': formF.processing }" :disabled="formF.processing">
							Guardar
						</button>
						<div v-if="status" class="mb-4 font-medium text-sm text-danger mt-4">
							{{ status }}
						</div>	
					</div>
				</div>
			</form>
		</div>

	</div>
	
</template>
<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'   
import BreezeButton from '@/Components/Button.vue'
    import BreezeInput from '@/Components/Input.vue'
    import BreezeLabel from '@/Components/Label.vue'
    import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  

export default {
	layout:TemplateApp,
    components: {
        Head,
        Link,
        BreezeValidationErrors,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
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
				id: this.$page.props.auth.profile.identify,
				city: this.$page.props.auth.profile.city,
				cp: this.$page.props.auth.profile.cp,
				address: this.$page.props.auth.profile.address,
            }),
        }
    },
    methods: {
        submitProfile() {
            this.formP.put(this.route('collaborator.profile.update'), {
                preserveScroll: true,
                errorBag: 'submitProfile',
            })
        },
        submitFiscal() {
        	// this.formF.nif = $('#nif').val();
            this.formF.put(this.route('collaborator.fiscal.update'), {
                preserveScroll: true,
                errorBag: 'submitFiscal',
				onError: (errors) => {
					console.log(errors);
				},
            })
        },
    }
}

</script>