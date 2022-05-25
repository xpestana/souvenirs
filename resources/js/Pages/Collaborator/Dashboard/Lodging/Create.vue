<template>
	<div class="container mt-4 p-10 pb-4">
		<ModalCookies/>
		<form @submit.prevent="submit">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3 class="h3 text-center text-md-left pb-2">
					<template v-if="profile.gestor == 1">
						Hotels of {{ profile.firstname }}
					</template>
					<template v-if="profile.gestor == 2">
						Lodging of {{ profile.firstname }}
					</template>
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
					
					<h4 class="h4 text-center text-md-left my-3 pt-4">
						<template v-if="profile.gestor == 1">
							Register a hotel
						</template>
						<template v-if="profile.gestor == 2">
							Register a lodging
						</template>
					</h4>
					<div class="row justify-content-between">
						<template v-if="profile.gestor == 1">
							<div class="col-12 col-md-6 mb-3">
                    			<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.nombre_hotel" placeholder="Name of the hotel*">
                    		</div>
							<div class="col-12 col-md-6 mb-3">
                    			<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.numero_habitaciones" placeholder="Number of rooms*">
                    		</div>
						</template>
						<div class="col-12 mb-3" :class="{'col-md-6' : profile.gestor == 1}">
							<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.calle" placeholder="Street *">
                    	</div>
                    	<div class="col-12 mb-3" :class="{'col-md-6' : profile.gestor == 1}">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.planta" placeholder="N° - Letter - Floor *">
                    	</div>
						<template v-if="profile.gestor == 2">
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
						<template v-if="profile.gestor == 2">
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
                	
				</div>				
			</div>
			<div class="col-md-6 d-flex">
				<div class="container-logo my-auto">
					<img src="/vendor_asset/img/logo/logosintexto.png" class="w-100">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 d-inline-flex justify-content-between">
				<Link :href="route('collaborator.index')" class="btn btn-primary rounded-pill px-3 mt-3">
					Return
				</Link>	
				<button type="submit" class="btn btn-primary rounded-pill px-3 mt-3 text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Following
				</button>
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
        		showF: 0,
            	user: this.$page.props.auth.user,
            	profile: this.$page.props.auth.profile,
            	form: this.$inertia.form({
					tipo: this.$page.props.auth.profile.gestor == 1 ? 'hotel' : 'apartamento',
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