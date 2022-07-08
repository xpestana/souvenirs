<template>
	<section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Url`s personalizadas</h1>
            </div>
        </div>
        <div
            class="mx-1.5 lg:mx-0 mt-8 mb-3.5"
        >
        	<span>Para enlazar todos los servicios que ofrecemos solo tienes que seleccionar la ciudad a la que se dirige el cliente y colocar el enlace en los puntos de interés de acceso para el cliente.</span>
    	</div>
    	<div
            class="mx-1.5 lg:mx-0 mb-4"
        >
        	<span>Una vez selecciones la ciudad de destino, simplemente haz click en el botón y ya tendrás tu enlace para empezar a vender.</span>
    	</div>
    	<div class="mx-1.5 row lg:mx-0">
    		<div class="col-12 col-md-4">
                <form
                    class="row"
                >
                    <!--END Alert validation -->
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold">Ciudad de destino</label>
                         <div class="relative w-100 collaborator-box">
                            <i class="fas fa-search absolute inset-y-1/3 px-2"></i>
                            <select
                                v-model="form.city"
                            	class="w-100 collaborator-input rounded col-form-input py-1 pl-8"
                                placeholder="Ciudad..."
                             >
    							<option
                                    value="sevilla"
                                    :selected="form.city == 'sevilla'"
                                >
                                    Sevilla
                                </option>
    						</select>
                        </div>
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                             type="submit"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                             :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                             @click.prevent="getUrl()"
                        >
                           Generar Url
                        </button>
                    </div>
                </form>
            </div>
    	</div>
        <div
            v-if="url"
            class="mx-1.5 mt-8"
        >
            <h3 class="font-bold text-xl">¡Enlace generado con éxito!</h3>
            <div class="flex justify-content-between mt-3">
                <span class="block">{{url}}</span>
                <span class="block cursor-pointer text-md orange  font-bold" @click.prevent="copy()"><i class="fas fa-copy orange mr-1"></i> Copiar Enlace</span>
            </div>
        </div>
    </section>
</template>

<script>
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
	import { Link } from '@inertiajs/inertia-vue3';
	export default {
	    layout:TemplateApp,
	    components:{
	        Link
	    },
	    props:['url'],
        data () {
            return {
                form: this.$inertia.form({
                    city: 'sevilla',
                }),
            }
        },
	    methods: {
	        goBack () {
	            window.history.back()
	        },
            getUrl () {
                this.form.get(this.route('collaborator.recursos.antes.url'), {
                    errorBag: 'submit',
                    preserveScroll: true,
                    
                    onSuccess: (result) => {
                        console.log('success')
                    },
                    onError: (errors) => {
                        console.log(errors)
                    },
                });
            },
            copy () {
                var id = "el-id-del-textarea";
                var existsTextarea = document.getElementById(id);

                if(!existsTextarea){
                    console.log("Creando textarea");
                    var textarea = document.createElement("textarea");
                    textarea.id = id;
                    // Coloca el textarea en el borde superior izquierdo
                    textarea.style.position = 'fixed';
                    textarea.style.top = 0;
                    textarea.style.left = 0;

                    // Asegurate que las dimensiones del textarea son minimas, normalmente 1px 
                    // 1em no funciona porque esto generate valores negativos en algunos exploradores
                    textarea.style.width = '1px';
                    textarea.style.height = '1px';

                    // No se necesita el padding
                    textarea.style.padding = 0;

                    // Limpiar bordes
                    textarea.style.border = 'none';
                    textarea.style.outline = 'none';
                    textarea.style.boxShadow = 'none';

                    // Evitar el flasheo de la caja blanca al renderizar
                    textarea.style.background = 'transparent';
                    document.querySelector("body").appendChild(textarea);
                    console.log("The textarea now exists :)");
                    existsTextarea = document.getElementById(id);
                }else{
                    console.log("El textarea ya existe")
                }
                
                existsTextarea.value = this.url;
                existsTextarea.select();

                try {
                    var status = document.execCommand('copy');
                    if(!status){
                        console.error("No se pudo copiar el texto");
                    }else{
                        console.log("El texto ahora está en el portapapeles");
                    }
                } catch (err) {
                    console.log('Uy, no se pudo copiar');
                }
            },
	    },
	}
</script>

<style scoped>
	option {
    	background-color: #f5f5f5;
    	padding: .7rem .3rem;
    }
    option:hover{
		background-color: #aad1e6;
	}
    .orange{
      color: #FF9C06;
    }
</style>