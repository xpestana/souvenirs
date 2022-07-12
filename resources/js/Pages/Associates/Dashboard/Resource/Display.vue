<template>
	<section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Displays</h1>
            </div>
        </div>
        <div
            class="mx-1.5 lg:mx-0 mt-8 mb-3.5"
        >
        	<span>Descubre los <strong>displays</strong> que te ofrecemos para <strong>captar la atención del cliente</strong> y que pueda <strong>acceder facilmente a los servicios</strong> que ofrecemos.</span>
    	</div>
    	<div
            class="mx-1.5 lg:mx-0 mb-4"
        >
        	<span><strong>Escoge el display</strong> que mejor se adacte a ti, <strong>la ciudad de destino y te los enviaremos</strong> a tu dirección ára que puedas empezar a vemder.</span>
    	</div>
    	<div class="mx-1.5 row lg:mx-0">
    		<div class="col-12">
                <div
                    class="row"
                >
                    <!--END Alert validation -->
                    <div class="col-12 col-md-4 my-1.5 px-0">
                        <label class="font-bold">Ciudad de destino</label>
                        <Select
                            v-model="form.city"
                            :options="citys"
                            textLabel="Buscar ciudad..."
                            icon="icon"
                        />
                    </div>
                     <div class="col-12 my-1.5 mt-8 px-0">
                         <div>
                             <label class="font-bold">Seleccione los displays que necesites</label> <span class="text-xs font-light">(Puede ser más de una opción)</span>
                         </div>
                         <div class="row justify-content-center mt-8">
                             <div v-for="(item, index) in displays" :key="index" class="col-12 col-md-5 col-lg-5 mx-3.5 mb-8">
                                <div class="row justify-content-center">
                                    <div
                                        class="rounded-xl col-7 col-md-6 col-lg-5 p-1.5 mr-md-3 cursor-pointer"
                                        :class="form.displays.includes(item) ? 'border-display-active' : 'border-display'"
                                        @click.prevent="selectDisplay(item)"
                                    >
                                        <div class="rounded-xl h-32 bg-black">ddd</div>
                                    </div>
                                    <div
                                        class="col-7 col-md-5 col-lg-4 text-left p-0 mt-3 mt-md-0"
                                    >
                                        <label class="font-bold">Flyers</label>
                                        <div>
                                            Display físico de facíl  distribución. Haz que el cliente tenga al alcance de la mano todos los servicios de la ciudad
                                        </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-12 mt-4 px-0 text-center text-lg-left">                  
                        <button
                            type="button"
                             class="btn rounded text-white bg-collaborator-orange py-1 px-6"
                             @click.prevent="openModalConfirm"
                        >
                           Pedir Displays
                        </button>
                    </div>
                </div>
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
    <NotiModal :id="'request-display-associate'">
        <template v-slot:header>
            <i class="fas fa-truck text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
            ¿Son correctos los datos pedidos?
        </template>
        <template v-slot:text>
           ¿Son correctos los datos pedidos?
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                @click="sendRequestDisplay"
            >Enviar notificación
            </button>
        </template>
    </NotiModal>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Select from '@/Components/Select'
    import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
    import NotiModal from '@/Pages/Collaborator/components/NotiModal'
	export default {
	    layout:TemplateApp,
	    components:{
            Link,
            Select,
            NotiModal
	    },
	    props:['url'],
        data () {
            return {
                form: this.$inertia.form({
                    city: '',
                    displays: [],
                }),
                displays: [
                    {title: 'Flyers', content: 'Display físico de facíl distribución. Haz que el cliente tenga al alcance de la mano todos los servicios de la ciudad'},
                    {title: 'Flyers1', content: 'Display físico de facíl distribución. Haz que el cliente tenga al alcance de la mano todos los servicios de la ciudad'},
                ],
                citys: [
					{label: 'Sevilla', value: 'sevilla'},
				],
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
            selectDisplay (item) {
                var existDisplay = this.form.displays.includes(item)
                if (existDisplay) {
                    var index = this.form.displays.indexOf(item)
                    this.form.displays.splice(index, 1)
                } else {
                    this.form.displays.push(item)
                }
            },
            openModalConfirm (){
                $('#request-display-associate').modal('show')
                console.log('modal')
            },
            sendRequestDisplay () {

            }
            
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
    .border-display-active{
      border: 4px solid #FF9C06;
    }
    .border-display{
      border: 4px solid transparent;
    }
</style>