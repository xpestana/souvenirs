<template>
	<form @submit.prevent="submit">

					<h4 class="h4 text-center text-md-left my-3 pt-4">Registra un alojamiento</h4>
					<div class="row justify-content-between">
						<div class="col-md-12 mb-3">
							<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.calle" placeholder="Calle *" required>
                    	</div>
                    	<div class="col-md-12 mb-3">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.planta" placeholder="N° - Letra - Planta *" required>
                    	</div>
                    	<div class="col-md-12 mb-3">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" placeholder="Otras indicaciones sobre la dirección">
                    	</div>
                    	<div class="col-md-6 mb-3">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" placeholder="Ciudad *" >
                    	</div>
                    	<div class="col-md-6 mb-3">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" placeholder="CP *" required>
                    	</div>
                    	<div class="col-md-6 mb-3">
                    		<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.code" placeholder="N° de licencia VFT/SE/12345" >
                    	</div>
                    	<div class="col-md-6 mb-3">
                    		<input type="url" class="form-control w-100 mb-2 py-3" v-model="form.url" placeholder="Link web" >
                    	</div>
                    	<div class="col-md-12 mb-3">
                    		Añadir imagen <button 
                                    type="button"
                                    style="border-radius: 20px"
                                    size="sm"
                                    class="btn bg-transparent text-uppercase" 
                                    variant="info" 
                                    @click="selectFeatured()"
                                >
                                    Examinar
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
                    		<textarea id="area" cols="10" rows="3" class="form-control w-100 mb-2 py-3" v-model="form.area" placeholder="Otros datos de interés"></textarea>
                    	</div>
                    	<div class="w-100">
							<ValidationErrors class="my-3" />
						</div>
                	</div>
                	
			<div class="col-md-6 d-flex">
				<div class="container-logo my-auto">
					<img src="/vendor_asset/img/logo/logosintexto.png" class="w-100">
				</div>
			</div>
		<div class="row">
			<div class="col-12 d-inline-flex justify-content-between">
				<Link :href="route('collaborator.index')" class="btn btn-primary rounded-pill px-3 mt-3">
					Volver
				</Link>	
				<button type="submit" class="btn btn-primary rounded-pill px-3 mt-3 text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Siguiente
				</button>
			</div>
		</div>
		</form>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'

	export default {
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
                    calle: null,
                    planta: null,
                    address: null,
                    city: 'Sevilla',
                    cp: null,
                    code: null,
                    url: null,
                    area: null,
                    image: null,
                    collaborator: this.collaborator,
                }),
        	}
    	},
    	props: {
        	collaborator: Number,
    	},
    	methods:{
    		submit() {
            	this.form.post(route('admin.lodging.store'),{
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
