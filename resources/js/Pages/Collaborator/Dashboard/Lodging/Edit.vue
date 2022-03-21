<template>
	<div class="container">
        <div class="row">
            <div class="col-md-1 col-12 pt-5">
                <Link :href="route('collaborator.index')"><i class="fas fa-angle-left text-white bg-info py-2 px-3"></i></Link>	
            </div>
            <div class="col-md-11 col-12">
                <section id="alojamiento">
                    <div class="row tarjeta my-5 p-3 shadow-md">
                        <div class="col-12 col-md-2 p-0">
                            <img class="img-foto w-100" :src="'/storage/hotel'+hotel.image" >
                        </div>
                        <div class="col-12 col-md-10 texto">
                            <p class="text-left text-muted">{{hotel.type.toUpperCase()}}</p>
                            <h1 class="pt-1 pb-2">{{hotel.calle}} {{hotel.planta}}</h1>
                            <div class="estadistica d-md-inline-flex">
                                <p class="px-2 text-muted">Benefecio total 334€</p>
                                <p class="px-2 text-muted">Pedidos totales: 8</p>
                                <p class="text-primary px-2">Obtener QR</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="form">
                    <form @submit.prevent="submit">
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <h1>Modifica tu alojamiento</h1>
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control w-100" v-model="form.code" disabled>
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3 mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Calle" v-model="form.calle">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="N°-Letra-Planta" v-model="form.planta">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control w-100" placeholder="Otras indicaciones"  v-model="form.address">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3  mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Ciudad"  v-model="form.city">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="CP"  v-model="form.cp">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control w-100" placeholder="Link-web"  v-model="form.url">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-md-6">
                            Actualizar imagen <button 
                                type="button"
                                style="border-radius: 20px"
                                size="sm"
                                class="btn btn-examinar" 
                                variant="info" 
                                @click="selectFeatured()"
                            >
                                Examinar
                            </button>
                            <i v-if="showF==1"
                                id="eraseFile" 
                                style="cursor:pointer" 
                                class="fas fa-trash-alt text-danger ml-5"
                                @click="eraseFeatured()"
                            ></i>
                            <input 
                                ref="image" 
                                id="image" 
                                type="file" 
                                @input="form.image = $event.target.files[0]"
                                style="display:none"
                                @change="onFeaturedChange" 
                            >
                            <span id="fileFeatured" class="text-success"></span>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                    	</div>
                    </div>
                    <div class="my-3 justify-content-start">
                        <div class="col-12 col-md-6 pl-0">
                            <textarea class="form-control w-100" placeholder="Otros datos de interés" v-model="form.area"></textarea>
                        </div>
                    </div>
                    <div class="my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <ValidationErrors class="my-3" />
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary rounded-pill" type="submit">Guardar cambios</button>
                        </div>
                    </div>
                    </form>
                </section>
            </div>
        </div>

    </div>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'

	export default {
        layout:TemplateApp,
        components:{
            Link,
            ValidationErrors
        },
        props:{
            hotel:Object,
        },
        data(){
            return{
                showF: 0,
                form: this.$inertia.form({
                    calle: this.hotel.calle,
                    planta: this.hotel.planta,
                    address: this.hotel.address,
                    city: this.hotel.zone,
                    cp: this.hotel.cp,
                    code: this.hotel.code,
                    url: this.hotel.url,
                    area: this.hotel.area,
                    image: null,
                }),
            }
        },
        methods:{
            submit() {
            	this.form.post(route('collaborator.update.hab',{id:this.hotel.id}),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(this.$page.props.flash.code == 200){
                            this.form.reset();
                            this.eraseFeatured();
                        };
                    }
                	
            	})
        	},
            selectFeatured(){
                this.$refs.image.click()
            },
            onFeaturedChange(){
                var filename = $('#image').val().split('\\').pop();
                $('#fileFeatured').html(filename);
                this.showF=1
            },
            eraseFeatured(){
                this.form.reset('image');
                $('#fileFeatured').html('');
                this.showF=0;
            },
        }
	}
</script>
<style scoped>
input, textarea{
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
#alojamiento .tarjeta h1{
    font-size: 30px;
    font-weight: bold;
}
#alojamiento .tarjeta img{
    max-height: 100px;
}
#form .btn-examinar {
    background-color: #dfdfdf;
}
#form h1{
    font-size: 20px;
}

@media (max-width:767px){
    #alojamiento .tarjeta img{
        max-height: 200px;
    }
}

</style>