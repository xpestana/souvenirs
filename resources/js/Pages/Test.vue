<template>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
   					<form @submit.prevent="submit">
   						<div class="address-wrapper row">
   							<div class="col-md-12 mb-4">
   							</div>
   							<div class="col-md-6">
                            	<BreezeLabel for="email" value="Email" />
            					<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email" autocomplete="email" placeholder="Email" />
                            </div>
                            <div class="col-md-6">
                            	<BreezeLabel for="conf_email" value="Confirmacion" />
            					<BreezeInput id="conf_email" type="conf_email" class="form-control mt-1 block w-full" v-model="form.email_confirmation" autocomplete="conf_email" placeholder="Confirmar Email" />
                            </div>
                            
                    		<div class="col-md-6 mt-3">
                    			<BreezeLabel for="password" value="Password" />
            					<BreezeInput id="password" type="password" class="form-control mt-1 block w-full" v-model="form.password" autocomplete="password" placeholder="Password" />
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
</template>
<script>

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
	   	},
	   	data() {
        	return {
            	form: this.$inertia.form({
                	email: null,
                	email_confirmation: null,
                	password: '',
            	})
        	}
    	},
    	methods: {
        	submit() {
            	this.form.post(route('register.collaborator'),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
            	})
        	},
    	}
	}
</script>