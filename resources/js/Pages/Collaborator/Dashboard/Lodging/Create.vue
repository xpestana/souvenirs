<template>
	<div class="container mt-4 p-10 pb-4">
		<ModalCookies/>
		<form @submit.prevent="submit">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3 class="h3 text-center text-md-left pb-2">
					Lodging of {{ profile.firstname }}
				</h3>
				<div class="d-flex justify-content-center justify-content-md-start">
					<img class="img-foto rounded-circle w-24" src="/vendor_asset/img/default.png">
					<div class="d-flex flex-column mt-3 ml-2 text-left">
						<p class="">{{ profile.firstname }}</p> 
						<p class="text-info">{{ user.email }}</p>
						<p class="">{{ profile.phone }} </p>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row my-4">
						<div class="col-3">
							<h4 class="h4 text-center text-md-left my-3 pt-4 d-inline">
								Register a 
							</h4>
						</div>
						<div class="col-9">
							<select name="" id="registerA" class="rounded border w-100 py-1" @change="showForm">
								<option value="-">Select</option>
								<option value="hotel">Hotel</option>
								<option value="lodging">Apartment</option>
								<option value="complejo">Holiday resort</option>
							</select>
						</div>
					</div>
					<template v-if="registerLodging || registerHotel">
						<div class="row justify-content-between">
							<template v-if="registerHotel">
								<div class="col-12 col-md-6 mb-3">
									<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.nombre_hotel" :placeholder="placeholderNombre">
								</div>
								<div class="col-12 col-md-6 mb-3">
									<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.numero_habitaciones" :placeholder="placeholderHab">
								</div>
							</template>
							<div class="col-12 mb-3" :class="{'col-md-6' : registerHotel}">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.calle" placeholder="Street *">
							</div>
							<div class="col-12 mb-3" :class="{'col-md-6' : registerHotel}">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.planta" placeholder="N° - Letter - Floor *">
							</div>
							<template v-if="registerLodging">
								<div class="col-md-12 mb-3">
									<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" placeholder="Other indications about the address">
								</div>
							</template>
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" placeholder="Town *" >
							</div>
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" placeholder="CP *">
							</div>
							<template v-if="registerLodging">
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.code" placeholder="License number VFT/SE/12345" >
							</div>
							</template>
							<div class="col-md-6 mb-3">
								<input type="url" class="form-control w-100 mb-2 py-3" v-model="form.url" placeholder="Website link" >
							</div>
							<div class="col-md-12 mb-3">
								Add image <button 
										type="button"
										style="border-radius: 20px"
										size="sm"
										class="btn bg-transparent text-uppercase" 
										variant="info" 
										@click="selectFeatured()"
									>
										Examine
									</button>
									<i v-if="showF==1"
										id="eraseFile" 
										style="cursor:pointer" 
										class="fas fa-trash-alt text-danger ml-5"
										@click="eraseFeatured()"
									></i>
									<input 
										ref="image" 
										id="image" 
										type="file" 
										@input="form.image = $event.target.files[0]"
										style="display:none"
										@change="onFeaturedChange" 
									>
									<span id="fileFeatured" class="text-success"></span>
									<progress v-if="form.progress" :value="form.progress.percentage" max="100">
										{{ form.progress.percentage }}%
									</progress>
							</div>
							<div class="col-md-12 mb-3">
								<textarea id="area" cols="10" rows="3" class="form-control w-100 mb-2 py-3" v-model="form.area" placeholder="Other data of interest"></textarea>
							</div>
							<div class="w-100">
								<ValidationErrors class="my-3" />
							</div>
						</div>
					</template>
                	
				</div>				
			</div>
			
			<div class="col-md-6 d-flex">
				<template v-if="registerLodging || registerHotel">
				<div class="container-logo my-auto">
					<img src="/vendor_asset/img/logo/hilogo.png" class="w-100">
				</div>
				</template>
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 d-inline-flex justify-content-between">
				<Link :href="route('collaborator.index')" class="btn btn-primary rounded-pill px-3 mt-3">
					Return
				</Link>	
				<template v-if="registerLodging || registerHotel">
				<button type="submit" class="btn btn-primary rounded-pill px-3 mt-3 text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Following
				</button>
				</template>
			</div>
		</div>
		</form>
	</div>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'

	export default {
		layout:TemplateApp,
		components:{
            ValidationErrors,
            Head,
            Link,
			ModalCookies
		},
		data() {
        	return {
				registerLodging:false,
				registerHotel:false,
				registerHousing:false,
				placeholderHab:null,
				placeholderNombre:null,
        		showF: 0,
            	user: this.$page.props.auth.user,
            	profile: this.$page.props.auth.profile,
            	form: this.$inertia.form({
					tipo: null,
					nombre_hotel:null,
					numero_habitaciones:null,
                    calle: null,
                    planta: null,
                    address: null,
                    city: 'Sevilla',
                    cp: null,
                    code: null,
                    url: null,
                    area: null,
                    image: null,
                }),
        	}
    	},
    	methods:{
			showForm(){
				if(document.getElementById('registerA').value == 'hotel'){
					this.registerLodging = false;
					this.registerHotel = true;
					this.form.tipo = 'hotel';
					this.placeholderHab = 'Number of rooms*';
					this.placeholderNombre = 'Name of hotel*';
				}else if(document.getElementById('registerA').value == 'lodging'){
					this.registerHotel = false;
					this.registerLodging = true;
					this.form.tipo = 'apartamento';
				}else if(document.getElementById('registerA').value == 'complejo'){
					this.registerHotel = true;
					this.registerHousing = true;
					this.registerLodging = false;
					this.form.tipo = 'complejo turístico';
					this.placeholderHab = 'Number of apartments*';
					this.placeholderNombre = 'Resort Name*';
				}else{
					this.registerLodging = false;
					this.registerHousing = false;
					this.registerHotel = false;
				}
			},
    		submit() {
            	this.form.post(route('collaborator.store.hab'),{
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
                this.$refs.image.click()
            },
            onFeaturedChange(){
                var filename = $('#image').val().split('\\').pop();
                $('#fileFeatured').html(filename);
                this.showF=1
            },
            eraseFeatured(){
                this.form.reset('image');
                $('#fileFeatured').html('');
                this.showF=0;
            },
    	}
	}
</script>
<style scoped>
	input, textarea{
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
	}
	button{
		color: #495057;
	}
	@media (max-width:767px){
		.container-logo img{
			display: none;
		}
	}
</style>