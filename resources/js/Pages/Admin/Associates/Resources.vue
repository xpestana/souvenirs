<template>
	<section id="admin-collaborator-resource" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()">
                    </i>
                    Recursos
                </h1>
            </div>
        </div>
        <!-- MIGA DE PAN -->
		<div class="header row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de anfitriones / {{user.profile.firstname}} / <b>Recursos</b></p>
            </div>
        </div>
		<!-- END MIGA DE PAN -->
        <!-- GENERATE BANNER -->
    	<div
            class="section-url mx-1.5 row lg:mx-0"
            :class="{'mb-8': !urlBanner.fullPath}"
        >
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="font-bold col-12 px-0 text-xl flex align-items-center">
                        <img
                            class="w-6 mr-2"
                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerNegro.svg"
                            alt="icon"
                        >
                        <div class="inline-block">Banners</div>
                        <i v-if="statusResources.completedBanner" class="fas fa-check-circle pl-1 text-xs ml-4 text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 ml-4 text-xs text-danger"></i>
                    </div>
                    <div class="col-12 my-2 px-0">
                        <span v-if="statusResources.completedBanner" class="font-bold text-success">Este usuario ya ha generado algún banner desde su registro en HiCitty</span>
                        <span v-else class="font-bold text-danger">Este usuario no ha generado algún banner desde su registro en HiCitty</span>
                    </div>
                </div>
                <form
                    class="row"
                >
                    <div class="col-12 col-lg-10 my-1.5 px-0">
                        <label class="font-bold">Ciudad de destino</label>
                        <Select
                            v-model="formBanner.city"
                            :options="citys"
                            textLabel="Buscar ciudad..."
                            icon="icon"
                        />
                    </div>
                    <div class="col-12 col-lg-10 my-1.5 px-0">
                        <label class="font-bold">Tamaño del banner</label>
						<Select
							v-model="formBanner.width"
							:options="banners"
							textLabel="Tamaño..."
						/>
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                            class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                            :class="{ 'opacity-25': loading }" :disabled="loading"
                            @click.prevent="submitBanner()"
                        >
                        Generar Banner
                        </button>
                    </div>
                </form>
            </div>
    	</div>
        <div
    		v-if="urlBanner.fullPath"
    		class="mx-1.5 flex justify-content-between lg:mx-0 mt-4 mb-4"
    	>
    		<label class="block font-bold">¡Banner generado con exito!</label>
    		<div v-if="windowWidth >= 768">
    			<span class="block cursor-pointer text-md text-orangec  font-bold" @click.prevent="copy()"><i class="fas fa-copy mr-1"></i> Copiar código de Banner</span>
    			<span v-if="message" class="block text-sm mt-1">{{message}}</span>
    		</div>
    	</div>
    	<div
            v-if="urlBanner.fullPath"
            class="mb-8"
            :class="{'flex mb-4 justify-content-center': windowWidth < 768}"
        >
    		<a :href="urlBanner.href"><img :src="urlBanner.fullPath"></a>
    	</div>
        <div
            v-if="windowWidth < 768"
             class="mb-8 text-center"
        >
            <span class="block cursor-pointer text-md text-orangec  font-bold" @click.prevent="copy()"><i class="fas fa-copy mr-1"></i> Copiar código de Banner</span>
            <span v-if="message" class="block text-sm mt-1">{{message}}</span>
        </div>
        <!-- END GENERATE BANNER -->
        <!-- GENERATE URL -->
    	<div class="section-url mx-1.5 row lg:mx-0">
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="font-bold col-12 px-0 text-xl flex align-items-center">
                        <img
                            class="w-6 mr-2"
                            src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlNegro.svg"
                            alt="icon"
                        >
                        <div class="inline-block">Url's personalizadas</div>
                        <i v-if="statusResources.completedUrl" class="fas fa-check-circle pl-1 text-xs ml-4 text-success"></i>
                        <i v-else class="fas fa-times-circle pl-1 ml-4 text-xs text-danger"></i>
                    </div>
                    <div class="col-12 my-2 px-0">
                        <span v-if="statusResources.completedUrl" class="font-bold text-success">Este usuario ya ha generado una url desde su registro en HiCitty</span>
                        <span v-else class="font-bold text-danger">Este usuario no ha generado una url desde su registro en HiCitty</span>
                    </div>
                </div>
                <form
                    class="row"
                >
                    <div class="col-12 col-lg-10 my-1.5 px-0">
                        <label class="font-bold">Ciudad de destino</label>
                        <Select
                            v-model="formUrl.city"
                            :options="citys"
                            textLabel="Buscar ciudad..."
                            icon="icon"
                        />
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                            class="btn rounded text-white bg-collaborator-orange py-1 px-10"
                            :class="{ 'opacity-25': loading }" :disabled="loading"
                            @click.prevent="submitUrl()"
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
                <div>
                    <span class="block cursor-pointer text-md text-orangec  font-bold" @click.prevent="copy()"><i class="fas fa-copy orange mr-1"></i> Copiar Enlace</span>
                    <span v-if="message" class="block text-sm mt-1">{{message}}</span>
                </div>
            </div>
        </div>
        <!-- END GENERATE URL -->
    </section>
</template>

<script>
	import Layout from '@/Pages/Admin/Layouts/Layout'
    import { Link } from '@inertiajs/inertia-vue3';
    import Select from '@/Components/Select'
	export default {
	    layout:Layout,
	    components:{
            Link,
            Select
	    },
	    props:['user'],
        data () {
            return {
                windowWidth: window.innerWidth,
                formUrl: {
                    city: 'Sevilla',
                    user_id: this.user.id,
                },
                formBanner: {
					city: 'Sevilla',
                    width: null,
                    user_id: this.user.id,
				},
				banners: [
					{label: '200x700', value: '200x700'},
					{label: '728x90', value: '728x90'},
					{label: '160x600', value: '160x600'},
				],
                citys: [
					{label: 'Sevilla', value: 'Sevilla'},
                ],
                message: null,
                loading: false,
                url: false,
                urlBanner: {
                    fullPath: null,
                    path: null,
                    href: null,
                },
                statusResources: {
                    completedBanner: false,
                    completedUrl: false,
                    completedRequestDisplay: false,
                    completedReseivedDisplay: false,
                },
            }
        },
        created () {
            this.statusResources.completedBanner = this.user.completedBanner
            this.statusResources.completedUrl = this.user.completedUrl
            this.statusResources.completedRequestDisplay = this.user.completedRequestDisplay
            this.statusResources.completedReseivedDisplay = this.user.completedReseivedDisplay
        },
	    methods: {
	        goBack () {
	            window.history.back()
	        },
            submitUrl () {
                this.loading = true
                axios({
                    url: route('admin.associate.url'),
                    method: 'POST',
                    data: { user_id: this.formUrl.user_id, city: this.formUrl.city },
                })
                .then( res => {
                    console.log(res)
                    this.url = res.data.url
                    this.statusResources.completedUrl = res.data.completedUrl
                })
                .finally(()=>{
                    this.loading = false
                })
            },
            submitBanner () {
                this.loading = true
                axios({
                    url: route('admin.associate.banner'),
                    method: 'POST',
                    data: { ...this.formBanner },
                })
                .then( res => {
                    console.log(res)
                    this.urlBanner = res.data.url
                    this.statusResources.completedBanner = res.data.completedBanner
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(()=>{
                    this.loading = false
                })
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
                        this.alertCopy('No se pudo copiar')
                        console.error("No se pudo copiar el texto");
                    }else{
                        this.alertCopy('¡Copiado en el portapapeles!')
                        console.log("El texto ahora está en el portapapeles");
                    }
                } catch (err) {
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
    .select-box .selected[data-v-f6a555f2] {
        background-color: #fff;
    }
</style>