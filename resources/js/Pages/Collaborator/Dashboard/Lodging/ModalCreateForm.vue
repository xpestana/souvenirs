<template>
	<!-- Modal Request -->
    <div class="modal modal-create fade" id="create-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content modal-create-lodging modal mx-auto">
            	<div class="modal-header py-3 px-3 m-0 bg-collaborator-orange">
            		<h1 class="font-bold text-white inline-block text-lg">
                        <img class="inline w-7 mr-2" style="margin-top:-4px;"
		                    src="/vendor_asset/img/collaborator/dashboard/icons/lodging/HotelBlanco.svg"
		                >
                        Registrar hotel
                    </h1>
                    <button
	                    type="submit"
	                    class="btn inline-block rounded btn-outline-white py-1 px-2"
	                >
	                    <i class="fas fa-plus mr-2 text-white">
	                        </i>Añadir imagen
	                </button>
            	</div>
                <div class="modal-body px-3">
                    <div
			            class="form-lodging row mx-1.5 lg:mx-0 mt-8 justify-content-center"
			        >
			            <div class="col-12 col-md-12">
			                <form
			                    class="row px-0"
			                >
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-0">
			                                    <label class="font-bold">Nombre del hotel <span class="required-input">*</span></label>
			                                    <input
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="Nombre del hotel..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold">Número de habitaciones <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1.5" placeholder="N de habitación..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-0">
			                                    <label class="font-bold">Provincia <span class="required-input">*</span></label>
			                                    <input
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="Provincia..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold">Ciudad <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1.5" placeholder="Ciudad..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-0">
			                                    <label class="font-bold">Calle <span class="required-input">*</span></label>
			                                    <input
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="N habitaciones..."
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold">N - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1.5" placeholder="Nombre del hotel..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-0">
			                                    <label class="font-bold">Grupo <span class="required-input">*</span></label>
			                                    <select
			                                    	class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="Grupo..."
			                                     >
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
					                        <label class="font-bold">Modalidad <span class="required-input">*</span></label>
					                        <select
			                                    	class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="Modalidad..."
			                                     >
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
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-0">
			                                    <label class="font-bold">Categoría <span class="required-input">*</span></label>
			                                    <select
			                                    	class="w-100 rounded col-form-input py-1.5"
			                                        placeholder="Categoría..."
			                                     >
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
					                        <label class="font-bold">Página Web </label>
					                        <input
					                            type="text"
					                            class="w-100 rounded col-form-input py-1.5" placeholder="Página web..."
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 col-md-5 my-1.5 px-0">
		                            <label class="font-bold">N de licencia
		                            </label>
		                            <input
		                                class="w-100 rounded col-form-input py-1.5"
		                                placeholder="H/SE/0002..."
		                            >
			                    </div>
	                    		<div class="col-md-5"></div>
	                    		<div class="col-12 my-1.5 px-0">
		                            <label class="font-bold">Otros datos de interés
		                            </label>
		                            <textarea
		                                class="w-100 rounded col-form-input py-1.5"
		                                placeholder="Otros datos de interés..."
		                            ></textarea>
			                    </div>
			                </form>
			            </div>
			        </div>
                    <div class="mt-2.5 px-2 flex justify-content-between">
                        <button class="btn px-3.5 py-1 text-xs font-bold inline-block" data-dismiss="modal"  aria-label="Close">Volver</button>
                        <button
		                    type="submit"
		                    class="btn inline-block rounded text-white bg-collaborator-orange py-1 px-6"
		                    @click.prevent=""
		                >
		                    <i class="fas fa-save mr-2 text-white">
		                        </i>Guardar
		                </button>
                    </div>
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
			return {
				group: ['Hotel', 'Pensión/Albergue', 'Hostal', 'Apartahotel'],
				modalid: ['Playa', 'Rural', 'Carretera', 'Ciudad'],
				category: ['1 Estrella', '2 Estrellas', '3 Estrellas', '3 Estrellas', '4 Estrellas', '5 Estrellas'],
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
    .input-datos{
        border: 0;
        background-color: #e7f6ff;
        padding: 11.6px 12.4px;
        outline: none;
        font-size: 1.3rem;
        border: solid 2.5px #bfbfbf;
        border-radius: 5px;
    }
    .error-input{
        border: solid 2.5px red;
    }
    option {
    	background-color: #f5f5f5;
    	:hover{
    		background-color: #aad1e6;
    	}
    }
    option::hover{
		background-color: #aad1e6;
	}
</style>