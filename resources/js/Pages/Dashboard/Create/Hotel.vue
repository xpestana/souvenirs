<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
   					<form @submit.prevent="submit">
   						<div class="address-wrapper row">
   							<div class="col-md-12 mb-4">
   								<h5>Datos del gerente del hotel</h5>
   							</div>
   							<div class="col-md-6">
                            	<BreezeLabel for="email" value="Correo único del hotel" />
            					<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email" autocomplete="username" placeholder="Correo único del hotel" />
                            </div>
   							<div class="col-md-12 my-4">
   								<h5>Datos y dirección del hotel</h5>
   							</div>
   							<div class="col-md-6 mt-3">
                                <div class="address-fname">
                                	<BreezeLabel for="name" value="Nombre del hotel" />
                                	<BreezeInput id="name" type="text" class="form-control mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" placeholder="Nombre del hotel" />
                            	</div>
                            </div>
   							<div class="col-md-6 mt-3">
   								<BreezeLabel for="address" value="Direccion del hotel" />
            					<BreezeInput id="address" type="text" class="form-control mt-1 block w-full" v-model="form.address" required autofocus autocomplete="address" placeholder="Direccion del hotel" />					
   							</div>
   							<div class="col-md-6 mt-3">
   								<BreezeLabel for="zone" value="Zona del hotel" />
            					<BreezeInput id="zone" type="text" class="form-control mt-1 block w-full" v-model="form.zone" required autocomplete="zone" placeholder="Zona del hotel" />
   							</div>
   							<div class="col-md-6 mt-3">
   								<label for="type">Tipo de hospedaje</label>
   								<select id="type" class="form-control mt-1 block w-100" v-model="form.type">
                					<option value="apartament">Apartamento de hotel</option>
                					<option value="hotel">Hotel</option>
            					</select>
   							</div>
   							<div class="col-md-6 mt-3">
   								<label for="type">Logo del hotel</label>
   							</div>
   							<div align="center" class="col-12 mt-4">
   								<div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
					        		<BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                						Registrar
	            					</BreezeButton>
   							</div>
   						</div>
   					</form>
   				</div>
        
    
   			</div>
   		</div>
    </Layout>
</template>
<script>
	import Layout from '@/Layouts/LayoutProfile.vue'  
	import BreezeButton from '@/Components/Button.vue'
	import BreezeInput from '@/Components/Input.vue'
	import BreezeLabel from '@/Components/Label.vue'
	import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
	import { Head, Link } from '@inertiajs/inertia-vue3'

	export default {
    	components: {
        	BreezeButton,
        	BreezeInput,
        	BreezeLabel,
        	BreezeValidationErrors,
        	Head,
        	Link,
        	Layout,
	   	},
	   	data() {
        	return {
            	form: this.$inertia.form({
                	name: '',
                	email: '',
                	type: 'hotel',
                	address: '',
                	zone: '',
            	})
        	}
    	},
    	methods: {
        	submit() {
            	this.form.post(route('hotels.store'),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                	preserveScroll: false,
            	})
        	}
    	}
	}
</script>