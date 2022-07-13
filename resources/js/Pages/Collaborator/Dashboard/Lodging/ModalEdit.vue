<template>
	<!-- Modal Request -->
    <div class="modal modal-create fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="myModalType"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-create-lodging modal mx-auto">
            	<div class="modal-header py-3 pr-3 pl-11 m-0 bg-collaborator-orange">
            		<div class="row justify-content-md-between w-100">
						<div class="col-12 col-md-auto text-center text-md-left mb-2 mb-md-0">
							<h1 class="font-bold text-white inline-block text-lg lg:text-xl">
							<img class="inline w-7 mr-2" style="margin-top:-4px;"
									:src="'/vendor_asset/img/collaborator/dashboard/icons/lodging/'+nameImage+'.svg'"
								>
								Editar {{ formatName }}
							</h1>
						</div>
						<div class="col-12 col-md-4  text-center text-md-right">
							<button
								type="submit"
								class="btn inline-block rounded btn-outline-white py-1 px-2"
								@click="openModalImagen()"
							>
							<i class="fas fa-plus mr-2 text-white"></i>Añadir imagen
							</button>
						</div>
					</div>
            	</div>
                <div class="modal-body px-3.5 pb-4 ">
					<form position-relative>
					<!--Alert validation -->
		            <ValidationAlert
		                :errors="formatErrors"
		            />
                    <div
			            class="form-lodging row mx-1.5 lg:mx-0 mt-3.5 justify-content-center"
			        >
			            <div class="col-12 col-md-12">
			            	<div
			                	v-if="formComputed.type == 'hotel'"
			                    class="row px-0"
			                >
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Nombre del hotel <span class="required-input">*</span></label>
			                                    <input
			                                        type="text" v-model="formModal.nombre_hotel"
			                                        class="w-100 rounded col-form-input py-1"
			                                        :placeholder="'Nombre del hotel...'"
			                                         :class="{'error-input': errorsKey.includes('nombre_hotel')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Número de habitaciones <span class="required-input">*</span></label>
					                        <input
					                            type="number"
					                            class="w-100 rounded col-form-input py-1" v-model="formModal.numero_habitaciones" placeholder="N° habitaciones..."
					                            :class="{'error-input': errorsKey.includes('numero_habitaciones')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
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
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Calle <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.calle"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Calle..."
			                                        :class="{'error-input': errorsKey.includes('calle')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="N°..."
					                            :class="{'error-input': errorsKey.includes('planta')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Grupo <span class="required-input">*</span></label>
			                                    <!--<select
			                                    	v-model="formModal.group"
			                                    	class="w-100 rounded col-form-input py-1"
			                                        :class="{'error-input': errorsKey.includes('group')}"
			                                     >
			                                     	<option value="" hidden selected>Grupo...</option>
													<option
														v-for="(item, index) in group"
														:key="index"
														:value="item"
													>
														{{ item }}
													</option>
												</select>-->
												<Select
													v-model="formModal.group"
													:options="group"
													textLabel="Grupo..."
													:error="errorsKey.includes('group')"
												/>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Modalidad <span class="required-input">*</span></label>
					                        <!--<select
		                                    	v-model="formModal.modality"
		                                    	class="w-100 rounded col-form-input py-1"
		                                        :disabled="formModal.group == null"
		                                        :class="{'error-input': errorsKey.includes('modality')}"
		                                     >
		                                     	<option  value="" hidden selected>Modalidad....</option>
												<option
													v-for="(item, index) in modalid"
													:key="index"
													:value="item"
												>
													{{ item }}
												</option>
											</select>-->
											<Select
												v-model="formModal.modality"
												:options="modalid"
												textLabel="Modalidad..."
												:error="errorsKey.includes('modality')"
												:disabled="formModal.group == null"
											/>
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Categoría <span class="required-input">*</span></label>
			                                    <!--<select
			                                    	v-model="formModal.category"
			                                    	class="w-100 rounded col-form-input py-1"
			                                    	:disabled="formModal.group == null || formModal.modality == null"
			                                        :class="{'error-input': errorsKey.includes('category')}"
			                                     >
			                                     	<option  value="" hidden selected>Categoría...</option>
													<option
														v-for="(item, index) in category"
														:key="index"
														:value="item"
													>
														{{ item }}
													</option>
												</select>-->
												<Select
													v-model="formModal.category"
													:options="category"
													textLabel="Categoría..."
													:error="errorsKey.includes('category')"
													:disabled="formModal.group == null || formModal.modality == null"
												/>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Página Web</label>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                        >
				                    	</div>
										<div class="col-12 col-md-6 pr-md-2 mt-2.5">
			                                    <label class="font-bold mb-0.5">N° de licencia </label>
			                                    <input
			                                        type="text" v-model="formModal.code"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Ej:AT/SE/00002"
			                                    >
			                            </div>
			                        </div>
			                    </div>
	                    		<div class="col-12 my-1.5 px-0">
		                            <label class="font-bold mb-0.5">Otros datos de interés
		                            </label>
		                            <textarea
		                                class="w-100 rounded col-form-input py-1"
		                                placeholder="Otros datos de interés..." v-model="formModal.area"
		                            ></textarea>
			                    </div>
			                </div>
			                <div
			                	v-if="formComputed.type == 'apartamento'"
			                    class="row px-0"
			                >
			                	<div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Calle <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.calle"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Calle..."
			                                        :class="{'error-input': errorsKey.includes('calle')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="N°..."
					                            :class="{'error-input': errorsKey.includes('planta')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Otras indicaciones</label>
			                                    <input
			                                    	v-model="formModal.address"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Otros..."
			                                        :class="{'error-input': errorsKey.includes('address')}"
			                                    >
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
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
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
										<div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">N° de licencia </label>
			                                    <input
			                                        type="text" v-model="formModal.code"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Ej:AT/SE/00002"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <div class="flex justify-content-between justify-content-md-start">
												 <label class="font-bold mb-0.5 inline-block">Página Web <span class="required-input">*</span></label> 
												<span class="ml-md-2 mb-1 icon relative inline-block"><i><i class="fas fa-exclamation-circle icon__fas"></i></i> <div class="tooltipp rounded-md shadow text-xs font-light">Escribe aquí el enlace del anuncio de tu apartamento. Booking, Airbnb, Wimdu...</div></span>
											</div>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                            :class="{'error-input': errorsKey.includes('url')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
								<div class="col-12 my-1.5 px-0">
									<label class="font-bold mb-0.5">Otros datos de interés
		                            </label>
		                            <textarea
		                                class="w-100 rounded col-form-input py-1"
		                                placeholder="Otros datos de interés..." v-model="formModal.area"
		                            ></textarea>
			                    </div>
			                </div>
			                <div
			                	v-if="formComputed.type == 'complejo'"
			                    class="row px-0"
			                >
			                    <div class="col-12 my-0.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Nombre del complejo turístico<span class="required-input">*</span></label>
			                                    <input
			                                        type="text" v-model="formModal.nombre_hotel"
			                                        class="w-100 rounded col-form-input py-1"
			                                        :placeholder="'Nombre del hotel...'"
			                                         :class="{'error-input': errorsKey.includes('nombre_hotel')}"
			                                    >
			                            </div>
			                        </div>
			                    </div>
								<div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Número de apartamentos <span class="required-input">*</span></label>
			                                    <input
			                                        type="number" v-model="formModal.numero_habitaciones"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Número de apartamentos..."
			                                        :class="{'error-input': errorsKey.includes('numero_habitaciones')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° de llaves <span class="required-input">*</span></label>
					                        <!--<select
		                                    	v-model="formModal.nllaves"
		                                    	class="w-100 rounded col-form-input py-1"
		                                        placeholder="N° de llaves..."
		                                        :class="{'error-input': errorsKey.includes('nllaves')}"
		                                     >
		                                     	<option value="" hidden selected>N° de llaves...</option>
												<option
													v-for="(item, index) in llaves"
													:key="index"
													:value="item"
												>
													{{ item }}
												</option>
											</select>-->
											<Select
												v-model="formModal.nllaves"
												:options="llaves"
												textLabel="N° de llaves..."
												:error="errorsKey.includes('nllaves')"
											/>
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
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
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Calle <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.calle"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Calle..."
			                                        :class="{'error-input': errorsKey.includes('calle')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="N°, letra, piso..."
					                            :class="{'error-input': errorsKey.includes('planta')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
			                    <div class="col-12 my-1.5 px-0">
			                        <div class="row px-0">
										<div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">N° de licencia </label>
			                                    <input
			                                        type="text" v-model="formModal.code"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Ej:AT/SE/00002"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Página Web</label>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                            :class="{'error-input': formComputed.tipo == 'apartamento' && errorsKey.includes('url')}"
					                        >
				                    	</div>
			                        </div>
			                    </div>
	                    		<div class="col-12 my-1.5 px-0">
		                            <label class="font-bold mb-0.5">Otros datos de interés
		                            </label>
		                            <textarea
		                                class="w-100 rounded col-form-input py-1"
		                                placeholder="Otros datos de interés..." v-model="formModal.area"
		                            ></textarea>
			                    </div>
			                </div>
			                <!--<div
			                    class="row px-0"
			                >
			                    <div class="col-12 my-0.5 px-0" v-if="form.type == 'complejo' || form.type == 'hotel'">
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
								<div class="col-12 my-0.5 px-0" v-if="form.type == 'complejo'">
			                        <div class="row px-0">
			                            <div class="col-12 col-md-6 pr-md-2">
			                                    <label class="font-bold mb-0.5">Número de apartamentos <span class="required-input">*</span></label>
			                                    <input
			                                    	v-model="formModal.numero_habitaciones"
			                                        type="number" id="napart"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Número de apartamentos..."
			                                        :class="{'error-input': errorsKey.includes('numero_habitaciones')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N° de llaves <span class="required-input">*</span></label>
					                        <select
		                                    	v-model="formModal.nllaves"
		                                    	class="w-100 rounded col-form-input py-1"
		                                        placeholder="N° de llaves..."
		                                        :class="{'error-input': errorsKey.includes('nllaves')}"
		                                     >
		                                     	<option value=""></option>
												<option
													v-for="(item, index) in llaves"
													:key="index"
													:value="item"
													:selected="item == formModal.nllaves"
												>
													{{ item }}
												</option>
											</select>
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
			                                        placeholder="Calle..."
			                                        :class="{'error-input': errorsKey.includes('calle')}"
			                                    >
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">N - Letra-Piso <span class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.planta"
					                            class="w-100 rounded col-form-input py-1" placeholder="N..."
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
			                                    	v-model="formModal.address"
			                                        type="text"
			                                        class="w-100 rounded col-form-input py-1"
			                                        placeholder="Otras indicaciones..."
			                                        :class="{'error-input': errorsKey.includes('address')}"
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
														:selected="item == formModal.group"
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
													:selected="item == formModal.modality"
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
			                                    {{ formModal.category }}
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
														:selected="item == formModal.category"
													>
														{{ item }}
													</option>
												</select>
			                            </div>
			                            <div class="col-12 mt-2.5 mt-md-0 col-md-6">
					                        <label class="font-bold mb-0.5">Página Web  <span v-if="form.type == 'apartamento'" class="required-input">*</span></label>
					                        <input
					                            type="text" v-model="formModal.url"
					                            class="w-100 rounded col-form-input py-1" placeholder="Página Web..."
					                            :class="{'error-input': form.type == 'apartamento' && errorsKey.includes('url')}"
					                        >
				                    	</div>
										<div class="col-12 col-md-6 pr-md-2" :class="{'mt-2.5': form.type == 'hotel'}">
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
			                </div>-->
			            </div>
			        </div>
                    <div class="mt-1.5 px-2 flex justify-content-between">
                        <button class="btn px-3.5 text-gray-500 py-1 text-xs font-bold inline-block" @click.prevent="closeModalEdit()">
							<i class="fas fa-reply"></i>
							Volver
						</button>
                        <button
		                    type="submit"
		                    class="btn inline-block rounded text-white bg-collaborator-orange py-1 px-6"
		                    :class="{ 'opacity-25': formModal.processing }"
                            :disabled="formModal.processing"
                            @click.prevent="submit"
		                >
		                    <i class="fas fa-save mr-2 text-white">
		                        </i>Guardar
		                </button>
                    </div>
					</form>
                </div>
                <!-- Modal para subir imagen -->
                <div class="modal modal-image fade" :id="`modalImage${id}`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index:1900;">
				    <div class="modal-dialog modal-dialog-image modal-sm modal-dialog-centered" role="document">
			            <div class="modal-content modal-images mx-auto py-3 px-3">
			                <div class="modal-body p-0 relative">
			                    <div>
			                        <i class="fas fa-times text-muted absolute right-1 md:right-2 top-1 md:top-2 cursor-pointer cerrarModal" @click.prevent="closeModalImage()"></i>
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
			                    		<h2 class="text-lg md:text-xl text-center mt-3.5 font-bold text-white">¡No has subido una imagen todavía!</h2>
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
				<!-- Fin modal para subir imagen -->
				<!-- Modal guardar cambios -->
		        <div class="modal modal-exit fade" :id="`modalExitEdit${id}`" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		        aria-hidden="true" style="z-index:2900;">
		        <!-- Change class .modal-sm to change the size of the modal -->
		            <div class="modal-dialog modal-dialog-image modal-sm modal-dialog-centered" role="document">
		                <div class="modal-content modal-exits modal mx-auto px-2">
		                    <div class="modal-body p-0 relative">
		                        <div>
		                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" @click.prevent="closeModalBack()"></i>
		                        </div>
		                        <h2 class="text-lg text-center mt-3.5 font-bold">Hay cambios sin guardar</h2>
		                        <p class="px-4 my-2 text-xs text-center">
		                            ¿Estás seguro que quieres salir?
		                        </p>
		                        <div class="my-2.5 text-center">
		                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" @click.prevent="closeModalBack()">Seguir editando</button>
		                        </div>
		                        <div class="my-2.5 text-center">
		                            <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" @click.prevent="forceExit()">Salir sin guardar</button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <!-- Modal guardar cambios  -->
            </div>
        </div>
        
    </div>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
	import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
	import Select from '@/Components/Select'
	export default {
		layout:TemplateApp,
		components:{
            Head,
            Link,
			ValidationAlert,
			Select,
        },
        props: {
            form: Object,
            id:String
        },
		data () {
			return{
				formModal: this.$inertia.form({
                    id: null,
					tipo: null,
					nombre_hotel: null,
					numero_habitaciones: null,
					calle: null,
					planta: null,
					address: null,
					city: null,
					cp: null,
					code: null,
					url: null,
					area: null,
					image: null,
					nllaves: null,
					modality: null,
					province: null,
					group: null,
					category: null,
				}),
				imagenValue: null,
				group: [{label: 'Hotel', value: 'Hotel'}, {label: 'Pensión/Albergue', value: 'Pensión/Albergue'}, {label: 'Apartahotel',  value: 'Apartahotel'}],
				modalid: [{label: 'Playa', value: 'Playa'}, {label: 'Rural', value: 'Rural'}, {label: 'Carretera',  value: 'Carretera'}, {label: 'Ciudad',  value: 'Ciudad'}],
				category: [{label: '1 Estrella', value: '1 Estrella'}, {label: '2 Estrellas', value: '2 Estrellas'}, {label: '3 Estrellas', value: '3 Estrellas'}, {label: '4 Estrellas',  value: '4 Estrellas'}, {label: '5 Estrellas',  value: '5 Estrellas'}, {label: '5 Estrellas gran lujo',  value: '5 Estrellas gran lujo'}],
				llaves: [{label: '1', value: '1'}, {label: '2', value: '2'}, {label: '3',  value: '3'}, {label: '4',  value: '4'}, {label: '5',  value: '5'}],
				errorsKey: [],
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
			},
			img () {
    			return this.imagenValue
    		},
	        formatErrors () {
	            var map = this.errorsKey.map( item => {
	                switch (item) {
	                    case 'nombre_hotel':
			                return 'Nombre del hotel'
			                break;
						case 'numero_habitaciones':
							return this.form.tipo === 'hotel' ? 'Número de habitaciones' : 'Número de apartamentos'
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
							return 'Otras indicaciones'
							break;
						case 'nllaves':
							return 'N de llaves'
							break;
						case 'category':
							return 'Categoría'
							break;
						case 'province':
							return 'Provincia'
							break;
						case 'modality':
							return 'Modalidad'
							break;
						case 'group':
							return 'Grupo'
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
	        validExit () {
	        	if (this.formModal.tipo === 'apartamento'){
	        		if (
	        			this.formModal.city != this.form.zone ||
	        			this.formModal.province != this.form.province ||
	        			this.formModal.calle != this.form.calle ||
	        			this.formModal.planta != this.form.planta ||
	        			this.formModal.address != this.form.address ||
	        			this.formModal.url != this.form.url ||
	        			this.formModal.code != this.form.code ||
	        			this.formModal.area != this.form.area
	        		) return true
	        		else return false
	        	} else if (this.formModal.tipo === 'hotel'){
	        		if (
	        			this.formModal.nombre_hotel != this.form.name ||
	        			this.formModal.numero_habitaciones != this.form.hab ||
	        			this.formModal.province != this.form.province ||
	        			this.formModal.city != this.form.zone ||
	        			this.formModal.calle != this.form.calle ||
	        			this.formModal.planta != this.form.planta ||
	        			this.formModal.group != this.form.group||
	        			this.formModal.category != this.form.category ||
	        			this.formModal.url != this.form.url ||
	        			this.formModal.code != this.form.code ||
	        			this.formModal.area != this.form.area
	        		) return true
	        		else return false
	        	} else {
	        		if (
	        			this.formModal.nombre_hotel != this.form.name ||
	        			this.formModal.numero_habitaciones != this.form.hab ||
	        			this.formModal.nllaves != this.form.nllaves ||
	        			this.formModal.province != this.form.province ||
	        			this.formModal.city != this.form.zone ||
	        			this.formModal.calle != this.form.calle ||
	        			this.formModal.planta != this.form.planta ||
	        			this.formModal.url != this.form.url ||
	        			this.formModal.code != this.form.code ||
	        			this.formModal.area != this.form.area
	        		) return true
	        		else return false
	        	}
	        	return false
	        },
	        formatName () {
	        	if (this.form.type == 'complejo') return 'complejo turístico'
	        	return this.form.type
	        },
	        nameImage () {
	        	if (this.form.type == 'complejo') return 'complejo turístico'
	        	return this.form.type
	        },
		},
		mounted (){
			this.emitter.on('chageFormEdit', this.chageFormEdit)
		},
		methods: {
			chageFormEdit () {
				this.formModal.id = this.form.id
				this.formModal.tipo = this.form.type
				this.formModal.nombre_hotel = this.form.name
				this.formModal.numero_habitaciones = this.form.hab
				this.formModal.calle = this.form.calle
				this.formModal.planta = this.form.planta
				this.formModal.address = this.form.address
				this.formModal.city = this.form.zone
				this.formModal.cp = null
				this.formModal.code = this.form.code
				this.formModal.url = this.form.url
				this.formModal.area = this.form.area
				this.formModal.image = this.form.img
				this.formModal.nllaves = this.form.nllaves
				this.formModal.modality = this.form.modality
				this.formModal.province = this.form.province
				this.formModal.group = this.form.group
				this.formModal.category = this.form.category
			},
			openModal () {
				$(`#${this.id}`).modal({show: true, backdrop: 'static', keyboard: false})
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
                            this.formModal.reset()
                            this.errorsKey = []
                            this.eraseFeatured()
                            $(`#${this.id}`).modal('hide')
                        };
                    },
                    onError: (errors) => {
                    	console.log(errors)
                    	this.getErrorsKey()
                    	this.emitter.emit('errors')
                    },
                	
            	})
                
        	},
        	addFile (e) {
            	this.formModal.image = e.dataTransfer.files[0]
            	this.imagenValue = URL.createObjectURL(this.formModal.image)
            },
            changeImage (value) {
            	this.formModal.image = value.target.files[0]
      			this.imagenValue = URL.createObjectURL(this.formModal.image)
            },
            openModalImagen () {
            	$(`#modalImage${this.id}`).modal('show')
            },
            closeModalImage () {
            	$(`#modalImage${this.id}`).modal('hide')
            },
            closeModalEdit () {
            	if (this.validExit) {
            		$(`#modalExitEdit${this.id}`).modal('show')
            	} else {
            		this.errorsKey = []
            		$(`#${this.id}`).modal('hide')
            	}
            },
            eraseFeatured(){
                this.formModal.reset('image')
            },
            closeModalBack () {
            	$(`#modalExitEdit${this.id}`).modal('hide')
            },
            forceExit () {
            	$(`#modalExitEdit${this.id}`).modal('hide')
            	setTimeout(()=>{
					$(`#${this.id}`).modal('hide')
            		this.errorsKey = []
            		this.formModal.reset()
            	},200)
            },
            getErrorsKey () {
	            this.errorsKey = this.$page.props.errors.submit ? Object.keys(this.$page.props.errors.submit) : []
	        },
		},
	}
</script>
<style lang="scss" scoped>
	.tooltipp{
		position: absolute;
		border: none;
		background-color: #fff;
		z-index:90000;
		color: #000;
		width: 200px;
		padding: .5rem;
		text-align: left;
		min-height: 30px;
		right: -15px;
		top: 25px;
		display: none;
	}
	.tooltipp::after{
		content: '';
		position: absolute;
		border-left: 10px solid transparent;
		border-bottom: 10px solid #fff;
		border-right: 10px solid transparent;
		border-top: 10px solid transparent;
		bottom: 63px;
		right: 12px;
	}

	.icon:hover {
		color: #ff9c06;
	}

	.icon:hover .tooltipp {
		display: block;
	}
	
	.icon__fas{
		transform: rotate(180deg);
	}

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
		max-width: 55% !important;
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