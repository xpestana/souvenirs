<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
                <div class="col-md-12 mb-4">
                    <h2 class="text-info">Modificar datos del hotel y gerente</h2>
                </div>
   				<div class="register-contact  clearfix">
   					<form @submit.prevent="submit">
   						<div class="address-wrapper row">
                            
   							<div class="col-md-12 mb-4">
   								<h5>Datos del gerente del hotel</h5>
   							</div>
   							<div class="col-md-6">
                            	<BreezeLabel for="firstname" value="Nombres del gerente" />
            					<BreezeInput id="firstname" type="firstname" class="form-control mt-1 block w-full" v-model="form.firstname" autocomplete="firstname" placeholder="Nombres del gerente" />
                            </div>
                            <div class="col-md-6">
                            	<BreezeLabel for="lastname" value="Apellidos del gerente" />
            					<BreezeInput id="lastname" type="lastname" class="form-control mt-1 block w-full" v-model="form.lastname" autocomplete="lastname" placeholder="Apellidos del gerente" />
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
                    			<BreezeLabel for="email" value="Email del gerente, para inicio de sesión" />
            					<BreezeInput id="email" type="email" class="form-control mt-1 block w-full" v-model="form.email" autocomplete="email" placeholder="Email del gerente" />
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
   							<div class="col-md-6 mt-3 pt-4">
   								<button 
                                    type="button"
                                    style="border-radius: 20px"
                                    size="sm"
                                    class="btn bg-secundary text-white text-uppercase mt-4" 
                                    variant="info" 
                                    @click="selectFeatured()"
                                >
                                    Modificar el Logo del hotel
                                </button>
                                <i v-if="showF==1"
                                    id="eraseFile" 
                                    style="cursor:pointer" 
                                    class="fas fa-trash-alt text-danger ml-5"
                                    @click="eraseFeatured()"
                                ></i>
                                <input 
                                    ref="featured" 
                                    id="featured" 
                                    type="file" 
                                    @input="form.featured = $event.target.files[0]"
                                    style="display:none"
                                    @change="onFeaturedChange" 
                                >
                                <span id="fileFeatured" class="text-success"></span>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                                <jet-input-error :message="form.errors.featured" class="mt-2" />
   							</div>
                            <div class="col-md-6 mt-3">
                                <div class="tab-content">
                                    <div id="thumb1" class="tab-pane fade show active">
                                        <a data-fancybox="images" :href="'/storage/hotel/'+hotel.image"><img :src="'/storage/hotel/'+hotel.image" :alt="hotel.name"></a>
                                    </div>
                                </div>
                            </div>
   							<div align="center" class="col-12 mt-4">
   								<div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
					        	<BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                					Modificar
	            				</BreezeButton>
	            				<BreezeValidationErrors class="my-3" />
                        		<div class="login-footer text-center">
                            		<div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                		{{ status }}
                            		</div>
                        		</div>
   							</div>
   						</div>
                        <input type="hidden" v-model="form.user_id">
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
            hotel: Object,
        },
	   	data() {
        	return {
        		showF: 0,
            	form: this.$inertia.form({
                	firstname: this.hotel.user[0].profile.firstname,
                	lastname: this.hotel.user[0].profile.lastname,
                	name: this.hotel.name,
                	email: this.hotel.user[0].email,
                	type: this.hotel.type,
                	address: this.hotel.address,
                	zone: this.hotel.zone,
                	gender: this.hotel.user[0].profile.gender,
                	file:null,
                	featured: null,
                    user_id:this.hotel.user[0].id,
            	})
        	} 
    	},
        created(){
            console.log("hotel", this.hotel);
        },
    	methods: {
        	submit() {
            	this.form.post(route('hotels.update',{hotel:this.hotel.id}),
                    {
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
        	selectFeatured(){
                this.$refs.featured.click()
            },
            onFeaturedChange(){
                var filename = $('#featured').val().split('\\').pop();
                $('#fileFeatured').html(filename);
                this.showF=1
            },
            eraseFeatured(){
                this.form.reset('featured');
                $('#fileFeatured').html('');
                this.showF=0;
            },
    	}
	}
</script>