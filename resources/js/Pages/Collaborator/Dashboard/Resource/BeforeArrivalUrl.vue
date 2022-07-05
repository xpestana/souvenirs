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
                        <select
                        	class="w-100 rounded col-form-input py-1"
                            placeholder="Ciudad..."
                         >
                         	<option value=""></option>
							<option value="sevilla">Sevilla</option>
						</select>
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                             type="submit"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                        >
                           Generar Url
                        </button>
                    </div>
                </form>
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
	    methods: {
	        goBack () {
	            window.history.back()
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
</style>