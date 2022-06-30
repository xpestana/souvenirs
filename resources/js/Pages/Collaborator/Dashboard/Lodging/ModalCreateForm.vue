<template>
	<!-- Modal Request -->
    <div class="modal modal-create fade" id="create-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-create-lodging modal mx-auto">
            	<div class="modal-header py-3 pr-3 pl-11 m-0 bg-collaborator-orange">
            		<div class="row justify-content-md-between w-100">
						<div class="col-12 col-md-5 text-center text-md-left mb-2 mb-md-0">
							<h1 class="font-bold text-white inline-block text-lg lg:text-2xl">
							<img class="inline w-7 mr-2" style="margin-top:-4px;"
									:src="'/vendor_asset/img/collaborator/dashboard/icons/lodging/'+formComputed.tipo+'.svg'"
								>
								Registrar {{formComputed.tipo}}
							</h1>
						</div>
						<div class="col-12 col-md-5  text-center text-md-right">
							<button
								type="submit"
								class="btn inline-block rounded btn-outline-white py-1 px-2"
							>
							<i class="fas fa-plus mr-2 text-white"></i>Añadir imagen
							</button>
						</div>
					</div>
            	</div>
                <div class="modal-body px-3.5 pb-4">
					<form @submit.prevent="submit">
                    <div
			            class="form-lodging row mx-1.5 lg:mx-0 mt-3.5 justify-content-center"
			        >
			            <div class="col-12 col-md-12">
			                <div
			                    class="row px-0"
			                >
			                    <div class="col-12 my-0.5 px-0" v-if="formComputed.tipo == 'complejo túristico' || formComputed.tipo == 'hotel'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Nombre del {{formComputed.tipo}} <span class="required-input">*</span></label>
			                                    <input
			                                        type="text" v-model="formModal.nombre_hotel"
			                                        class="w-100 rounded col-form-input py-1"
			                                        :placeholder="'Nombre del '+formComputed.tipo+'...'"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6" v-if="formComputed.tipo == 'hotel'">
					                        <label class="font-bold mb-0.5">Número de habitaciones <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1" id="nhab" placeholder="N de habitación..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
								<div class="col-12 my-0.5 px-0" v-if="formComputed.tipo == 'complejo túristico'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Numero de apartamentos <span class="required-input">*</span></label>
			                                    <input
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
			                                    <select
			                                    	class="w-100 rounded col-form-input py-1"
			                                        placeholder="Provincia..."
			                                    >
													<option value="-">Select</option>
												</select>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Ciudad <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1" v-model="formModal.city" placeholder="Ciudad..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Calle <span class="required-input">*</span></label>
			                                    <input
			                                        type="text" v-model="formModal.calle"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="N habitaciones..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="Nombre del hotel..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
								<div class="col-12 my-0.5 px-0"  v-if="formComputed.tipo == 'apartamento'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Otras indicaciones</label>
			                                    <input
			                                        type="text" v-model="formModal.otro"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Otras indicaciones..."
			                                    >
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0" v-if="formComputed.tipo == 'hotel'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Grupo <span class="required-input">*</span></label>
			                                    <input
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="N habitaciones..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Modalidad <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1" placeholder="Nombre del hotel..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2" v-if="formComputed.tipo == 'hotel'">
			                                    <label class="font-bold mb-0.5">Categoría <span class="required-input">*</span></label>
			                                    <input
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="N habitaciones..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Página Web </label>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                        >
				                    	</div>
										<div class="col-12 col-md-6 pr-md-2" :class="{'mt-2.5':formComputed.tipo == 'hotel'}">
			                                    <label class="font-bold mb-0.5">N° de licencia <span class="required-input">*</span></label>
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
		                                placeholder="Otros datos de interés..." v-model="formModal.address"
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
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	export default {
		layout:TemplateApp,
		components:{
            Head,
            Link,
        },
        props: ['form'],
		data () {
			return{
				formModal: this.$inertia.form({
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
					nllaves:null,
					otro:null
				}),
			}
		},
		computed: {
			formComputed: {
				get () {
					return this.form
				},
				set (value) {
					this.$emit('update:form', value)
				}
			}
		},
		methods: {
			openModal () {
				$('#create-form').modal('show')
			},
			submit() {
				this.formModal.tipo = this.formComputed.tipo;
				if(this.formModal.tipo == 'hotel'){
					this.formModal.numero_habitaciones = document.getElementById('nhab').value
				}
				if(this.formModal.tipo == 'complejo túristico'){
					this.formModal.numero_habitaciones = document.getElementById('napart').value
				}
            	this.formModal.post(route('collaborator.store.hab'),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(this.$page.props.flash.code == 200){
                            this.formModal.reset();
                            this.eraseFeatured();
                        };
                    }
                	
            	})
        	},
		},
	}
</script>
<style lang="scss" scoped>
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

	@media (max-width:767px) {
		.modal-dialog{
			max-width: 95% !important;
		}
		.modal-content{
			max-height: 44em;
			overflow-y: auto;
		}
	}

</style>