<template>
<form @submit.prevent="submit">
   						<div class="address-wrapper row">
   							<div class="col-md-12 mb-4">
   								<h5>Datos del administrador</h5>
   							</div>
   							<div class="col-md-6">
                            	<BreezeLabel for="firstname" value="Nombre del administrador" />
            					<BreezeInput id="firstname" type="firstname" class="form-control mt-1 block w-full" v-model="form.firstname" autocomplete="firstname" placeholder="Nombre del administrador" />
                            </div>
                            <div class="col-md-6">
                            	<BreezeLabel for="lastname" value="Apellido del administrador" />
            					<BreezeInput id="lastname" type="lastname" class="form-control mt-1 block w-full" v-model="form.lastname" autocomplete="lastname" placeholder="Apellido del administrador" />
                            </div>
                            
                    		<div class="col-md-6 mt-3">
                    			<BreezeLabel for="email" value="Email del administrador, para inicio de sesión" />
            					<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email" autocomplete="email" placeholder="Email del administrador" />
                    		</div>
                            <div class="col-md-6 mt-3">
                                <BreezeLabel for="email" value="Email del administrador, para inicio de sesión" />
                                <BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email_confirmation" autocomplete="email" placeholder="Email del administrador" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <BreezeLabel for="email" value="password del administrador, para inicio de sesión" />
                                <BreezeInput id="email" type="text" class="form-control mt-1 block w-full" v-model="form.password" autocomplete="email" placeholder="password del administrador" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <BreezeLabel for="email" value="Email del administrador, para inicio de sesión" />
                                <BreezeInput id="email" type="text" class="form-control mt-1 block w-full" v-model="form.password_confirmation" autocomplete="email" placeholder="confirmar password" />
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
                showF: 0,
                form: this.$inertia.form({
                    firstname: null,
                    lastname: null,
                    email: null,
                    email_confirmation: null,
                    password: null,
                    password_confirmation: null,
                })
            }
        },
        methods: {
            submit() {
                this.form.post(route('admin.store'),{
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