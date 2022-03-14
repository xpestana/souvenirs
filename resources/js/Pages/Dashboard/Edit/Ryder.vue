<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
   					<form @submit.prevent="submit">
   						<div class="address-wrapper row">
   							<div class="col-md-12 mb-4">
   								<h5>Datos del Ryder</h5>
   							</div>
   							<div class="col-md-6">
                            	<BreezeLabel for="firstname" value="Nombre del ryder" />
            					<BreezeInput id="firstname" type="firstname" class="form-control mt-1 block w-full" v-model="form.firstname" autocomplete="firstname" placeholder="Nombre del ryder" />
                            </div>
                            <div class="col-md-6">
                            	<BreezeLabel for="lastname" value="Apellido del ryder" />
            					<BreezeInput id="lastname" type="lastname" class="form-control mt-1 block w-full" v-model="form.lastname" autocomplete="lastname" placeholder="Apellido del ryder" />
                            </div>
                            <div class="col-md-6 mt-3">
                        		<label class="col-form-label">Género</label>
                        		<div class="col-lg-6 col-md-8">
                            		<span class="custom-radio">
                                		<input name="gender" v-model="form.gender" value="M" type="radio"> H
                            		</span> 
                            		<span class="custom-radio pl-1">
                                		<input name="gender" v-model="form.gender" value="F" type="radio"> M
                            		</span>
                        		</div>
                    		</div>
                    		<div class="col-md-6 mt-3">
                    			<BreezeLabel for="email" value="Email del ryder, para inicio de sesión" />
            					<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email" autocomplete="email" placeholder="Email del ryder" />
                    		</div>
                    		<div class="col-md-6 mt-3">
                    			<BreezeLabel for="address" value="Dirección de habitación" />
            					<BreezeInput id="address" type="address" class="form-control mt-1 block w-full" v-model="form.address" autocomplete="address" placeholder="Dirección de habitación" />
                    		</div>
   							<div align="center" class="col-12 mt-4">
   								<div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
					        	<BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                					Registrar
	            				</BreezeButton>
	            				<BreezeValidationErrors class="my-3" />
                        		<div class="login-footer text-center">
                            		<div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                		{{ status }}
                            		</div>
                        		</div>
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
	   	props: {
        	user: Object,
    	},
    	created(){
    		console.log(this.user);
    	},
	   	data() {
        	return {
        		showF: 0,
            	form: this.$inertia.form({
            		_method: "PUT",
                	firstname: this.user.profile.firstname,
                	lastname: this.user.profile.lastname,
                	email: this.user.email,
                	gender: this.user.profile.gender,
                	address: this.user.profile.ryder.address
            	})
        	}
    	},
    	methods: {
        	submit() {
            	this.form.post(route('ryders.update',{ryder: this.user.id}),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(this.$page.props.flash.code == 200){
                            this.form.reset();
                            this.eraseFeatured();
                        };
                    }
                	
            	})
        	},
    	}
	}
</script>