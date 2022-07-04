<template>
	<div class="container mt-4 p-6">
		<ModalCookies/>
		<form @submit.prevent="submit">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3 class="h3 text-center text-md-left pb-2">
					Alojamientos de {{ profile.firstname }}
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
							<h4 class="text-lg text-center text-md-left my-3 pt-4 d-inline">
								Registrar un 
							</h4>
						</div>
						<div class="col-9">
							<select name="" id="registerA" class="rounded border w-100 py-1" @change="showForm">
								<option value="-">Select</option>
								<option value="hotel">Hotel</option>
								<option value="lodging">Apartamento</option>
								<option value="complejo">Complejo turístico</option>
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
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.calle" placeholder="Calle *">
							</div>
							<div class="col-12 mb-3" :class="{'col-md-6' : registerHotel}">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.planta" placeholder="N° - Letra - Piso *">
							</div>
							<template v-if="registerLodging">
								<div class="col-md-12 mb-3">
									<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" placeholder="Otras indicaciones sobre la dirección">
								</div>
							</template>
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" placeholder="Ciudad *" >
							</div>
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" placeholder="CP *">
							</div>
							<template v-if="registerLodging">
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control w-100 mb-2 py-3" v-model="form.code" placeholder="N° de licencia VFT/SE/12345" >
							</div>
							</template>
							<div class="col-md-6 mb-3">
								<input type="url" class="form-control w-100 mb-2 py-3" v-model="form.url" placeholder="link web" >
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
								<textarea id="area" cols="10" rows="3" class="form-control w-100 mb-2 py-3" v-model="form.area" placeholder="Otros datos de interés"></textarea>
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
				<!-- <Link :href="route('collaborator.index')" class="btn btn-primary rounded-pill px-3 mt-3">
					Volver
				</Link>	 -->
				<template v-if="registerLodging || registerHotel">
				<button type="submit" class="btn btn-primary rounded-pill px-3 mt-3 text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Siguiente
				</button>
				</template>
			</div>
		</div>
		</form>
		<ModalCreateType
			ref="modalCreateType"
			:form.sync="form"
			@clickOpenForm="openFormCreate()"
		/>
		<ModalCreateForm
			ref="modalCreateForm"
			:form.sync="form"
		/>
		<div class="row justify-content-center">
			<div class="col-12 mt-11 px-0 text-center">
                <button
                    type="submit"
                    class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                    @click.prevent="openCreateLodging()"
                >
                    <i class="fas fa-plus mr-2 text-white">
                        </i>Añadir alojamiento
                </button>
            </div>
		</div>
		<button
            type="submit"
            class="btn rounded text-white bg-collaborator-orange py-1 px-6"
            @click.prevent="openModalImagen()"
        >
            Imagen
        </button>
        <!-- Modal Request -->
        <div class="modal modal-image fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content modal-exits modal mx-auto px-3">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" data-dismiss="modal" aria-label="Close" ></i>
                        </div>
                        <h2 class="text-md text-left mt-3 font-bold">Vista previa</h2>
                        <div class=" rounded-xl mt-4 bg-collaborator-orange">
                        	<img
                        		v-if="imagenValue"
                        		:src="img"
                        	>
                        	<div
                        	    v-else
                        		class="bg-collaborator-orange py-2.5  px-2 text-center text-white w-100 m-0 rounded-xl"
                        	>
                        		<h2 class="text-lg md:text-xl text-center mt-3.5 font-bold text-white">!No has subido una imagen todavía</h2>
                        	  	<i class="fas fa-arrow-down inline-block text-white text-lg md:text-xl"></i>
                        	</div>
                        </div>
                        <input
                        	ref="file"
                        	type="file"
                        	id="file"
                        	style="display: none;"
                        	@change="changeImage"
                        />
                        <div
                        	class=" rounded-xl bg-picker-img py-2.5 mt-4 mb-4 px-2 text-center text-muted cursor-pointer"
                        	@drop.prevent="addFile"
                        	@dragover.prevent
                        	@click="$refs.file.click()"
                        >
                        	<i class="fas fa-image inline-block text-white text-xl text-muted"></i>
                        	<label class="text-center block font-bold text-muted mt-1">!No has subido una imagen todavía</label>
                        	<p class="text-xs muted mt-1">Tamaño máximo  de la imagen 2MB</p>
                        </div>
                        <!--<div
                        	id ="leftContain"style="width:90%; height: 90;"
                        >
                        	<img id="img" class="img" align="center" src="" >
                        	<input type="file" @change="" name="">
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Request  -->
	</div>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
	import ModalCreateForm from '@/Pages/Collaborator/Dashboard/Lodging/ModalCreateForm'
	import DropZoneImage from '@/Components/DropZoneImage'
	import Dropzone from 'dropzone'
    export default {
		components: {
			layout:TemplateApp,
            ValidationErrors,
            Head,
            Link,
			ModalCookies,
			DropZoneImage
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
                imagenValue: null,
                dropzone: null,
        	}
    	},
    	computed: {
    		img () {
    			return this.imagenValue
    		}
    	},
    	methods:{
			showForm(){
				if(document.getElementById('registerA').value == 'hotel'){
					this.registerLodging = false;
					this.registerHousing = false;
					this.registerHotel = true;
					this.form.tipo = 'hotel';
					this.placeholderHab = 'Numero de habitaciones*';
					this.placeholderNombre = 'Nombre del hotel*';
				}else if(document.getElementById('registerA').value == 'lodging'){
					this.registerHotel = false;
					this.registerHousing = false;
					this.registerLodging = true;
					this.form.tipo = 'apartamento';
				}else if(document.getElementById('registerA').value == 'complejo'){
					this.registerHotel = true;
					this.registerHousing = true;
					this.registerLodging = false;
					this.form.tipo = 'complejo turístico';
					this.placeholderHab = 'Numero de apartamentos*';
					this.placeholderNombre = 'Nombre del complejo turístico*';
				}else{
					this.registerLodging = false;
					this.registerHousing = false;
					this.registerHotel = false;
				}
			},
    		submit() {
            	this.form.post(route('collaborator.store.hab'),{
                	_token: this.$page.props.csrf_token,
                	forceFormData: true,
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
            openCreateLodging () {
            	this.$refs.modalCreateType.openModal()
            },
            openFormCreate () {
            	this.$refs.modalCreateForm.openModal()
            },
            openModalImagen () {
            	$('#image').modal('show')
            },
            changeImage (value) {
            	console.log(value)
            	this.form.image = value.target.files[0]
      			this.imagenValue = URL.createObjectURL(this.form.image)
            },
            toggleActive () {

            },
            addFile (e) {
            	this.form.image = e.dataTransfer.files[0]
            	let file = this.form.image
            	let reader = new FileReader()
            	reader.onload = (e) => {
            		this.imagenValue= e.target.result
            	}
            	reader.readAsDataURL(file)
            	this.imagenValue = URL.createObjectURL(this.form.image)
            },
    	},
    	mounted() {
        },
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
	.bg-picker-img{
		background-color: #e7e7e7;
		border: solid 2px #b3b3b3;
		border-style: dashed;
	}
	@media (max-width:767px){
		.container-logo img{
			display: none;
		}
	}
</style>