<template>
	<section id="dashboard-resource-beforearrival" class="container py-8 ml-2 md:ml-0 md:px-24">
	 	<div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="cursor-pointer fas fa-arrow-left text-muted mr-2" @click.prevent="goBack()"></i>Displays</h1>
            </div>
        </div>
        <div
            class="mx-1.5 lg:mx-0 mt-8 mb-3.5 position-relative"
        >
        	<span>Descubre los <strong>displays</strong> que te ofrecemos para <strong>captar la atención del cliente</strong> y que pueda <strong>acceder facilmente a los servicios</strong> que ofrecemos.</span>
            <ValidationAlert
                :errors="formatErrors"
            />
    	</div>
    	<div
            class="mx-1.5 lg:mx-0 mb-4"
        >
        	<span><strong>Escoge el display</strong> que mejor se adacte a ti, <strong>la ciudad de destino y te los enviaremos</strong> a tu dirección ára que puedas empezar a vemder.</span>
    	</div>
    	<div class="mx-1.5 row lg:mx-0">
    		<div class="col-12">
                <form
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
                            :error="errorsKey.includes('city')"
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
                                        <div class="rounded-xl h-32 bg-black position-relative">
                                            <div
                                                v-if="form.displays.includes(item) && windowWidth <= 768"
                                                class="circle-display position-absolute top-3 right-3"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="col-7 col-md-5 col-lg-4 text-left p-0 mt-3 mt-md-0"
                                    >
                                        <label class="font-bold">{{ item.title }}</label>
                                        <div>
                                            {{ item.content }}
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
                </form>
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
            <div class="w-100 rounded bg-grey p-2 text-left">
                <div class="mb-3">
                <span class="block">Ciudad de destino:</span>
                <span class="block font-bold">Sevilla</span>
                </div>
                 <div>
                    <span class="block">Displays seleccionados:</span>
                    <span
                        v-for="(item, index) in form.displays"
                        class="block font-bold"
                    >
                        {{ item.title }}
                    </span>
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <button
                class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 mt-2 text-xs mb-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="sendRequestDisplay"
            >Enviar notificación
            </button>
             <button
                class="btn rounded btn-outline-orange px-3.5 py-1 text-xs"
                data-dismiss="modal" aria-label="Close"
            >Cambiar opciones
            </button>
        </template>
    </NotiModal>
     <NotiModal :id="'notidisplay-associate'">
        <template v-slot:header>
            <i class="far fa-check-circle text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
             ¡Pedido recibido!
        </template>
        <template v-slot:text>
            Te mandaremos un correo electrónico para confirmarte cuando el pedido haya sido enviado.
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                 data-dismiss="modal" aria-label="Close"
            >Cerrar mensaje
            </button>
        </template>
    </NotiModal>
</template>

<script>
   import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import Select from '@/Components/Select'
    import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
    import NotiModal from '@/Pages/Collaborator/components/NotiModal'
    import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
	export default {
	    layout:TemplateApp,
	    components:{
            Link,
            Select,
            NotiModal,
            ValidationAlert,
	    },
	    props:['url'],
        data () {
            return {
                form: this.$inertia.form({
                    city: 'Sevilla',
                    displays: [],
                }),
                displays: [
                    {title: 'Flyers', content: 'Display físico de facíl distribución. Haz que el cliente tenga al alcance de la mano todos los servicios de la ciudad'},
                    {title: 'Flyers', content: 'Display físico de facíl distribución. Haz que el cliente tenga al alcance de la mano todos los servicios de la ciudad.'},
                ],
                citys: [
					{label: 'Sevilla', value: 'Sevilla'},
                ],
                errorsKey: [],
                windowWidth: window.innerWidth,
            }
        },
        computed: {
            formatErrors () {
                var map = this.errorsKey.map( item => {
                    switch (item) {
                        case 'city':
                            return 'Ciudad de destino'
                            break;
                        case 'displays':
                            return 'Al menos una opción de "Displays'
                            break;
                        default:
                        return item
                    }
                })
                return map
            },
        },
	    methods: {
	        goBack () {
	            window.history.back()
            },
            selectDisplay (value) {
                var existDisplay = this.form.displays.includes(value)
                if (existDisplay) {
                    var index = this.form.displays.indexOf(value)
                    this.form.displays.splice(index, 1)
                } else {
                    this.form.displays.push(value)
                }
            },
            openModalConfirm (){
                $('#request-display-associate').modal('show')
            },
            sendRequestDisplay () {
                let id = $('#notidisplay-associate')
                let send = $('#request-display-associate')
                this.form.displays = this.form.displays.map(item => item.title)
                this.form.post(route('associates.resource.send.display'), {
                    preserveScroll: true,
                    errorBag: 'submit',
                    onSuccess: (result) => {
                        send.modal('hide')
                        setTimeout(()=>{
                            id.modal('show')
                        }, 1000)
                    },
                    onError: (errors) => {
                        send.modal('hide')
                        this.getErrorsKey()
                        this.emitter.emit('errors')
                    },
                })
            },
            getErrorsKey () {
                this.errorsKey = this.$page.props.errors.submit ? Object.keys(this.$page.props.errors.submit) : []
            },
	    },
	}
</script>

<style scoped>
    .border-display-active{
      border: 4px solid #FF9C06;
    }
    .border-display{
      border: 4px solid transparent;
    }
    .bg-grey{
        background-color: #e9e9e9;
    }
    .circle-display{
        width: 12px;
        height: 12px;
        background-color: #FF9C06;
        border-radius: 50%;
    }
</style>