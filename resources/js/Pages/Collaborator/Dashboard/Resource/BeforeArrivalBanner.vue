<template>
	<section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="md:fixed md:w-30 z-1000 header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Banners</h1>
            </div>
        </div>
        <div class="md:invisible header-pivot row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Banners</h1>
            </div>
        </div>
        <div
            class="mx-1.5 mt-8 md:mt-9 mb-3.5"
        >
        	<span>Aquí podrás escoger y generar el banner que mejor se adapte a tus necesidades y poder empezar a vender.</span>
    	</div>
    	<div
            class="mx-1.5 lg:mx-0 mb-4"
        >
        	<span>Una vez asignes la ciudad  del destino su tamaño y el tamaño del banner, se generará una vista previa y ya solo tendrás que colocarlo en tus <strong>mails, páginas web...</strong> y podrás empezar a ofrecele a tu cliente todos los servicios de la ciudad de destino antes de su llegada.</span>
    	</div>
    	<div class="mx-1.5 row lg:mx-0">
    		<div class="col-12 col-md-4">
                <form
                    class="row"
                >
                    <!--END Alert validation -->
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold">Ciudad de destino</label>
                        <div class="w-100 collaborator-box">
							<Select
								v-model="form.city"
								:options="citys"
								textLabel="Ciudad..."
								icon="icon"
							/>
	                        <!--<select
	                        	v-model="form.city"
	                        	class="w-100 rounded collaborator-input col-form-input py-1  pl-8"
	                            placeholder="Ciudad..."
	                         >
								<option value="sevilla" :selected="form.city == 'sevilla'">Sevilla</option>
								<option value="madrid" :selected="form.city == 'madrid'">Madrid</option>
							</select>-->
						</div>
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold">Tamaño del banner</label>
                        <!--<select
                        	v-model="form.width"
                        	class="w-100 rounded col-form-input py-1"
                            placeholder="Tamaño..."
                         >
							<option value="200x700">200x700</option>
							<option value="728x90">728x90</option>
							<option value="160x600">160x600</option>
						</select>-->
						<Select
							v-model="form.width"
							:options="banners"
							textLabel="Tamaño..."
						/>
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                             type="submit"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                             :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                             @click.prevent="getBanner()"
                        >
                           Generar banner
                        </button>
                    </div>
                </form>
            </div>
    	</div>
    	<div
    		v-if="url.fullPath"
    		class="mx-1.5 flex justify-content-between lg:mx-0 mt-4 mb-4"
    	>
    		<label class="block font-bold">¡Banner generado con exito!</label>
    		<div>
    			<span class="block cursor-pointer text-md orange  font-bold" @click.prevent="copy()"><i class="fas fa-copy mr-1"></i> Copiar código de Banner</span>
    			<span v-if="message" class="block text-sm mt-1">{{message}}</span>
    		</div>
    	</div>
    	<div v-if="url.fullPath">
    		<a :href="href"><img :src="url.fullPath"></a>
    	</div>
    </section>
</template>

<script>
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
	import { Link } from '@inertiajs/inertia-vue3';
	import Select from '@/Components/Select'
	export default {
	    layout:TemplateApp,
	    components:{
			Link,
			Select,
	    },
	    props: {
	    	url: Object,
	    	href: String,
	    },
	    data () {
	    	return {
	    		form: this.$inertia.form({
					city: 'sevilla',
					width: null,
				}),
				message: null,
				citys: [
					{label: 'Sevilla', value: 'sevilla'},
				],
				banners: [
					{label: '200x700', value: '200x700'},
					{label: '728x90', value: '728x90'},
					{label: '160x600', value: '160x600'},
				]
	    	}
		},
	    computed: {
	    	img () {
	    		if (this.url.fullPath) {
	    			var u = this.href
		    		var h = `${this.url.fullPath}`
		    		var a = `<a href="${u}"><img src="${h}"></a>`
		    		return a
	    		}
	    		return ''
	    	},
	    },
	    methods: {
	        goBack () {
	        	window.history.back()
	        },
	        getBanner () {
	        	this.form.get(this.route('collaborator.recursos.antes.banner'), {
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
			    
			    existsTextarea.value = this.img;
			    existsTextarea.select();

			    try {
			        var status = document.execCommand('copy');
			        if(!status){
			        	this.alertCopy('No se pudo copiar')
			            console.error("No se pudo copiar el texto");
			        }else{
			        	this.alertCopy('¡Copiado en el portapapeles!')
			            console.log("El texto ahora está en el portapapeles");
			        }
			    } catch (err) {
			    	this.alertCopy('No se pudo copiar')
			        console.log('Uy, no se pudo copiar');
			    }
	        },
	        alertCopy (m) {
	        	this.message = m
	        	setTimeout(()=>{
	        		this.message = null
	        	}, 4000)
	        },
	    },
	}
</script>

<style scoped>
	option {
    	background-color: #f5f5f5;
    	padding: .5rem .3rem;
		margin-top:1rem;
    }
    option:hover{
		background-color: #aad1e6;
	}
	.orange{
	  color: #FF9C06;
	}

	.error-input{
        border: solid 2.5px red;
    }

	a, select {
		z-index: 10 !important;
	}
	.header-pivot {
		display: none;
	}
	.header{
		z-index: 1000!important;
	}
	@media (min-width: 768px){
		.header-pivot {
			display: block;
			width: 60vw;
		}
		.header{
			width: 60vw;
		}
	}

	/*img{
		width: 100%;
		height: 100%;
	}*/
</style>