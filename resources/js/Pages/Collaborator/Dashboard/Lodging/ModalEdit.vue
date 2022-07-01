<template>
	<!-- Modal Request -->
    <div class="modal modal-create fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="myModalType"
    style="z-index:1500;"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-create-lodging modal mx-auto">
            	<div class="modal-header py-3 pr-3 pl-11 m-0 bg-collaborator-orange">
            		<div class="row justify-content-md-between w-100">
						<div class="col-12 col-md-5 text-center text-md-left mb-2 mb-md-0">
							<h1 class="font-bold text-white inline-block text-lg lg:text-2xl">
							<img class="inline w-7 mr-2" style="margin-top:-4px;"
									:src="'/vendor_asset/img/collaborator/dashboard/icons/lodging/'+form.type+'.svg'"
								>
								Editar {{form.type}}
							</h1>
						</div>
						<div class="col-12 col-md-5  text-center text-md-right">
							<button
								type="submit"
								class="btn inline-block rounded btn-outline-white py-1 px-2"
								@click="openModalImagen"
							>
							<i class="fas fa-plus mr-2 text-white"></i>Añadir imagen
							</button>
						</div>
					</div>
            	</div>
            	<pre>{{ errorsKey }}</pre>
                <div class="modal-body px-3.5 pb-4 ">
		            
					<form @submit.prevent="submit" position-relative>
					<!--Alert validation -->
		            <ValidationAlert
		                :errors="formatErrors"
		            />
                    <div
			            class="form-lodging row mx-1.5 lg:mx-0 mt-3.5 justify-content-center"
			        >
			            <div class="col-12 col-md-12">
			                <div
			                    class="row px-0"
			                >
			                    <div class="col-12 my-0.5 px-0" v-if="form.type == 'complejo turístico' || form.type == 'hotel'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Nombre del {{form.type}} <span class="required-input">*</span></label>
			                                    <input
			                                        type="text" v-model="formModal.nombre_hotel"
			                                        class="w-100 rounded col-form-input py-1"
			                                        :placeholder="'Nombre del '+form.type+'...'"
			                                         :class="{'error-input': errorsKey.includes('nombre_hotel')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6" v-if="form.type == 'hotel'">
					                        <label class="font-bold mb-0.5">Número de habitaciones <span class="required-input">*</span></label>
					                        <input
					                        	v-model="formModal.numero_habitaciones"
					                            type="number"
					                            class="w-100 rounded col-form-input py-1" id="nhab" placeholder="N de habitación..."
					                            :class="{'error-input': errorsKey.includes('numero_habitaciones')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
								<div class="col-12 my-0.5 px-0" v-if="form.type == 'complejo turístico'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Numero de apartamentos <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.numero_habitaciones"
			                                        type="text" id="napart"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Numero de apartamentos..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° de llaves <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1" v-model="formModal.nllaves" placeholder="N° de llaves..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Provincia <span class="required-input">*</span></label>
												 <input
						                            type="text"
						                            class="w-100 rounded col-form-input py-1"
						                            v-model="formModal.province" placeholder="Provincia..."
						                            :class="{'error-input': errorsKey.includes('province')}"
						                        >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Ciudad <span class="required-input">*</span></label>
					                        <input
					                        	v-model="formModal.city"
					                            type="text"
					                            class="w-100 rounded col-form-input py-1"
					                            placeholder="Ciudad..."
					                            :class="{'error-input': errorsKey.includes('city')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Calle <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.calle"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="N habitaciones..."
			                                        :class="{'error-input': errorsKey.includes('calle')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="Nombre del hotel..."
					                            :class="{'error-input': errorsKey.includes('planta')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
								<div class="col-12 my-0.5 px-0"  v-if="form.type == 'apartamento'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Otras indicaciones</label>
			                                    <input
			                                    	v-model="formModal.otro"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Otras indicaciones..."
			                                        :class="{'error-input': errorsKey.includes('otro')}"
			                                    >
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0" v-if="form.type == 'hotel'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Grupo <span class="required-input">*</span></label>
			                                    <select
			                                    	v-model="formModal.group"
			                                    	class="w-100 rounded col-form-input py-1"
			                                        placeholder="Grupo..."
			                                        :class="{'error-input': errorsKey.includes('group')}"
			                                     >
			                                     	<option value=""></option>
													<option
														v-for="(item, index) in group"
														:key="index"
														:value="item"
													>
														{{ item }}
													</option>
												</select>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Modalidad <span class="required-input">*</span></label>
					                        <select
		                                    	v-model="formModal.modality"
		                                    	class="w-100 rounded col-form-input py-1"
		                                        placeholder="Modalidad..."
		                                        :class="{'error-input': errorsKey.includes('modality')}"
		                                     >
		                                     	<option value=""></option>
												<option
													v-for="(item, index) in modalid"
													:key="index"
													:value="item"
												>
													{{ item }}
												</option>
											</select>
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2" v-if="form.type == 'hotel'">
			                                    <label class="font-bold mb-0.5">Categoría <span class="required-input">*</span></label>
			                                    <select
			                                    	v-model="formModal.category"
			                                    	class="w-100 rounded col-form-input py-1"
			                                        placeholder="Categoría..."
			                                        :class="{'error-input': errorsKey.includes('category')}"
			                                     >
			                                     	<option value=""></option>
													<option
														v-for="(item, index) in category"
														:key="index"
														:value="item"
													>
														{{ item }}
													</option>
												</select>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Página Web </label>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                        >
				                    	</div>
										<div class="col-12 col-md-6 pr-md-2" :class="{'mt-2.5':form.type == 'hotel'}">
			                                    <label class="font-bold mb-0.5">N° de licencia </label>
			                                    <input
			                                        type="text" v-model="formModal.code"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Ej:AT/SE/00002"
			                                    >
			                            </div>
			                        </div>
			                    </div>
	                    		<div class="col-md-5"></div>
	                    		<div class="col-12 my-0.5 px-0">
		                            <label class="font-bold mb-0.5">Otros datos de interés
		                            </label>
		                            <textarea
		                                class="w-100 rounded col-form-input py-1"
		                                placeholder="Otros datos de interés..." v-model="formModal.area"
		                            ></textarea>
			                    </div>
			                </div>
			            </div>
			        </div>
                    <div class="mt-1.5 px-2 flex justify-content-between">
                        <button class="btn px-3.5 text-gray-500 py-1 text-xs font-bold inline-block" data-dismiss="modal"  aria-label="Close">
							<i class="fas fa-reply"></i>
							Volver
						</button>
                        <button
		                    type="submit"
		                    class="btn inline-block rounded text-white bg-collaborator-orange py-1 px-6"
		                    :class="{ 'opacity-25': formModal.processing }"
                             :disabled="formModal.processing"
		                >
		                    <i class="fas fa-save mr-2 text-white">
		                        </i>Guardar
		                </button>
                    </div>
					</form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Modal Request  -->
    <!-- Modal upload image -->
    <div class="modal modal-image fade" id="modalImage" tabindex="-1" role="dialogI" aria-labelledby="myModalLabelImage"
    aria-hidden="true" style="z-index:1900;">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog-image modal-dialog-centered" role="document">
            <div class="modal-content modal-images modal mx-auto px-3">
                <div class="modal-body p-0 relative">
                    <div>
                        <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer cerrarModal" data-dismiss="modal" @click="closeModalImage()"></i>
                    </div>
                    <h2 class="text-md text-left mt-3 font-bold">Vista previa</h2>
                    <div class=" rounded-xl mt-3" style="max-height: 120px;">
                    	<img
                    		v-if="imagenValue"
                    		:src="img"
                    		class=" w-full rounded-xl"
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
                    	class=" rounded-xl bg-picker-img py-2.5 mt-3 mb-3 px-2 text-center text-muted cursor-pointer"
                    	@drop.prevent="addFile"
                    	@dragover.prevent
                    	@click="$refs.file.click()"
                    >
                    	<i class="fas fa-image inline-block text-white text-xl text-muted"></i>
                    	<label class="text-center block font-bold text-muted mt-1 cursor-pointer">Suelta aquí tu imagen o explora en tus archivos</label>
                    	<p class="text-xs muted mt-1">Tamaño máximo  de la imagen 2MB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal upload image  -->
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
	import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert' 
	export default {
		layout:TemplateApp,
		components:{
            Head,
            Link,
            ValidationAlert,
        },
        props: {
            form: Object,
            id:String
        },
		data () {
			return{
				formModal: this.$inertia.form({
                    id: this.form.id,
					tipo: this.form.type,
					nombre_hotel:this.form.name,
					numero_habitaciones:this.form.hab,
					calle: this.form.calle,
					planta: this.form.planta,
					address: this.form.address,
					city: this.form.zone,
					cp: 'cp',
					code: this.form.code,
					url: this.form.url,
					area: this.form.area,
					image: null,
					nllaves:null,
					otro:null,
					modality: null,
					group:null,
					category:null,
				}),
				imagenValue: null,
				group: ['Hotel', 'Pensión/Albergue', 'Hostal', 'Apartahotel'],
				modalid: ['Playa', 'Rural', 'Carretera', 'Ciudad'],
				category: ['1 Estrella', '2 Estrellas', '3 Estrellas', '3 Estrellas', '4 Estrellas', '5 Estrellas'],
			}
		},
		computed: {
			img () {
    			return this.imagenValue
    		},
    		errorsKey () {
	            var err = this.$page.props.errors.submit ? Object.keys(this.$page.props.errors.submit) : []
	            return err
	        },
	        formatErrors () {
	            var map = this.errorsKey.map( item => {
	                switch (item) {
	                    case 'nombre_hotel':
			                return 'Nombre del hotel'
			                break;
						case 'numero_habitaciones':
							return 'Número de habitación'
							break;
						case 'calle':
							return 'Calle'
							break;
						case 'city':
							return 'Ciudad'
							break;
						case 'cp':
							return 'CP'
							break;
						case 'code':
							return 'N de licencia'
							break;
						case 'url':
							return 'Página web'
							break;
						case 'area':
							return 'Otros datos de interés'
							break;
						case 'planta':
							return 'N- letra-piso'
							break;
						case 'address':
							return 'Otros datos de interés'
							break;
						case 'otro':
							return 'Otras indicaciones'
							break;
						case 'nllaves':
							return 'N de llaves'
							break;
						case 'category':
							return 'Categoría'
							break;
						default:
		                return item
	                }
	            })
	            return map
	        },
		},
		mounted () {
			$('.cerrarModal').click(function(){
				$('#modalImage').modal('hide')
			})
		},
		methods: {
			openModal () {
				$('#create-form').modal('show')
			},
			submit() {
                this.formModal.post(route('collaborator.update.hab',{id:this.formModal.id}),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        console.log('success')
                        if(this.$page.props.flash.code == 200){
                            console.log('222')
                            this.formModal.reset();
                            this.eraseFeatured();
                            $('#edit'+this.formModal.id).modal('hide')
                        };
                    }
                	
            	})
                
        	},
        	addFile (e) {
            	this.formModal.image = e.dataTransfer.files[0]
            	this.imagenValue = URL.createObjectURL(this.formModal.image)
            },
            changeImage (value) {
            	console.log(value)
            	this.formModal.image = value.target.files[0]
      			this.imagenValue = URL.createObjectURL(this.formModal.image)
            },
            openModalImagen () {
            	$('#modalImage').modal('show')
            },
            closeModalImage () {
            	$('#modalImage').modal('hide')
            },
            clickBackModalType () {
            	$('#create-form').modal('hide')
            	this.$emit('clickBackModalType')
            }
		},
	}
</script>
<style lang="scss">
	.bg-header-colaborator{
        background-color: #f6f6f6;
    }  
    .required-input{
        color: #ff9c06;
    }
    .title{
        font-size: 2rem;
        font-weight: bolder;
        color: #545454;
        diplay: inline-block;
    }
	.modal-dialog{
		max-width: 60% !important;
		margin: 0.5rem auto  !important;
	}
	.modal-dialog-image{
		max-width: 30% !important;
		margin: 0.5rem auto  !important;
	}
	img{
		max-height: 120px;
	}
	.bg-picker-img{
		background-color: #e7e7e7;
		border: solid 2px #b3b3b3;
		border-style: dashed;
	}
	.required-input{
        color: #ff9c06;
    }
	.error-input{
        border: solid 2.5px red;
    }
    .required-input{
        color: #ff9c06;
    }
    option {
    	background-color: #f5f5f5;
    	padding: .7rem .3rem;
    }
    option:hover{
		background-color: #aad1e6;
	}
	@media (max-width:767px) {
		.modal-dialog{
			max-width: 95% !important;
		}
		.modal-content{
			max-height: 44em;
			overflow-y: auto;
		}
		.modal-dialog-image{
			max-width: 70% !important;
			margin: 0.5rem auto  !important;
		}
	}
</style>