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
                                <p class="px-2 text-muted">Total benefit {{ totalBeneficio }}€</p>
                                <p class="px-2 text-muted">Total orders: {{hotel.orders.length}}</p>
                                <button class="btn btn-link px-2 py-0" data-toggle="modal" :data-target="'#centralModal'+hotel.id">Get QR</button>
                                <!-- Central Modal Small -->
                                <div class="modal fade" :id="'centralModal'+hotel.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <!-- Change class .modal-sm to change the size of the modal -->
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content mx-auto">
                                            <div class="modal-body p-0">
                                                <div class="row mt-5 mb-2">
                                                    <div class="col-12 my-4 d-flex justify-content-center">
                                                        <QRCodeVue3
                                                            :width="1080"
                                                            :height="1080"
                                                            :imgclass="'souvenirs_img'+hotel.id"
                                                            style="max-width: 50%;"
                                                            :value="url+'?h='+hotel.id"
                                                            :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                                                            :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                                            :dotsOptions="{
                                                                type: 'square',
                                                                color: '#31516B',
                                                                gradient: {
                                                                type: 'linear',
                                                                rotation: 0,
                                                                colorStops: [
                                                                    { offset: 0, color: '#31516B' },
                                                                    { offset: 1, color: '#31516B' },
                                                                ],
                                                            },
                                                            }"
                                                            fileExt="png"
                                                            :backgroundOptions="{ color: '#ffffff' }"
                                                            :cornersSquareOptions="{ type: 'dot', color: '#6cb2eb' }"
                                                            :cornersDotOptions="{ type: undefined, color: '#6cb2eb' }"
                                                            :download="false"
                                                            downloadButton="view-cart bg-info mt-3 souvenirs_btn"
                                                            :downloadOptions="{ name: 'souvenirs', extension: 'png' }"
                                                            crossOrigin="anonymous"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="row px-3 pt-4 pb-5">
                                                    <div class="col-6 text-left">
                                                        <button class="bnt btn-primary-c text-white rounded-pill px-4 py-1" href="#" data-dismiss="modal" >Return</button>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <button class="bnt btn-primary-c text-white rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(hotel.id,hotel.calle+' '+hotel.planta)">Download</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Central Modal Small -->
                            </div>
                        </div>
                    </div>
                </section>
                <section id="form">
                    <form @submit.prevent="submit">
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <h1>Modify your 
                                <template v-if="hotel.type == 'apartamento'">
                                    Lodging
                                </template>
                                <template v-else>
                                    Hotel
                                </template>
                            </h1>
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <template  v-if="hotel.type == 'hotel'">
                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" class="form-control w-100 mb-2 py-3" v-model="form.nombre_hotel" placeholder="Name of the hotel*">
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" class="form-control w-100 mb-2 py-3" v-model="form.numero_habitaciones" placeholder="Number of rooms*">
                            </div>
                            <div class="w-100"></div>
                        </template>
                        <div class="col-12 col-md-3 mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Street" v-model="form.calle">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="N°-Letter-Floor" v-model="form.planta">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control w-100" placeholder="Other indications"  v-model="form.address">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3  mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Town"  v-model="form.city">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="CP"  v-model="form.cp">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" v-model="form.code" placeholder="License number VFT/SE/12345">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="Website link"  v-model="form.url">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-md-6">
                            Update image <button 
                                type="button"
                                style="border-radius: 20px"
                                size="sm"
                                class="btn btn-examinar" 
                                variant="info" 
                                @click="selectFeatured()"
                            >
                                Examine
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
                            <textarea class="form-control w-100" placeholder="Other data of interest" v-model="form.area"></textarea>
                        </div>
                    </div>
                    <div class="my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <ValidationErrors class="my-3" />
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary rounded-pill" type="submit">Save Changes</button>
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
    import QRCodeVue3 from "qrcode-vue3"
	export default {
        layout:TemplateApp,
        components:{
            Link,
            ValidationErrors,
            QRCodeVue3
        },
        props:{
            hotel:Object,
            url:String,
        },
        data(){
            return{
                showF: 0,
                form: this.$inertia.form({
                    type:this.hotel.type,
                    nombre_hotel:this.hotel.name,
                    numero_habitaciones:this.hotel.hab,
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
            souvenirs_btn(id,lodging){
            var urlItem = $('.souvenirs_img'+id).attr('src');
            axios({
                    url: urlItem,
                    method: 'GET',
                    responseType: 'blob'
                })
                .then((response) => {
                        const url = window.URL
                            .createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', `${lodging}.png`);
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                })                
            }
        },
        computed:{
            totalBeneficio(){
                const total = this.hotel.orders.reduce((acc,col)=> acc + parseInt(col.total),0);
                return (total/100)
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