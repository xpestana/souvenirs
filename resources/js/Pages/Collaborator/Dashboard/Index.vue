<template>
 <Head title="Alojamientos"/>
 <div class="container">
     <ModalCookies/>
    <div class="main">
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h1>¿Need help?</h1>
                <p>Specialized care</p>
                <p>(+34) 722 193 903</p>
            </div>
            <div class="col-12 text-center px-0 px-lg-4">
                <template v-if="hotels.length == 0">
                    <a href="javascript:void(0)" class="btn btn-outline-info boton-inicio" @click.prevent="lodging"> <i class="fas fa-plus"></i>Add Lodging</a>
                </template>
                <template v-else>
                    <section id="cabecera">
                        <div class="container">
                            <div class="row caja-info">
                                <div class="col-12 col-md-9 info-boton">
                                    <a type="button" class="btn btn-outline-info boton rounded-pill px-4"  @click.prevent="lodging"><i class="fas fa-plus"></i>Add Lodging</a>
                                    <h5 v-if="this.user_id > 0" class="text-info p-3"><Link :href="route('collaborator.sales.hab',{id: user_id})">Total sales<i class="fas fa-angle-right p-1"></i></Link></h5>
                                </div>
                                <div class="col-12 col-md-3 info-total text-right" v-if="$page.props.auth.user.profile.gestor == 2">
                                    <h3 class="text-info"><strong>Total</strong></h3><br>
                                    <h4><strong>Benefit {{ total }} €</strong></h4><br>
                                    <h4><strong>Orders {{ orders }}</strong></h4><br>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="alojamientos">
                        <div class="container">
                            <div v-for="hotel in hoteles" :key="hotel.id" class="row tarjeta my-4 p-3">
                                    <div class="col-12 col-md-2 p-0">
                                        <Link :href="route('collaborator.sales.details',{hab:hotel.id})">
                                        <img class="img-foto w-100 h-36 md:h-28" :src="'/storage/hotel'+hotel.image" >
                                        </Link>
                                    </div>
                                    <div class="col-12 col-md-8 texto">
                                        <div class="text-md-left">
                                            <p class="d-md-inline mr-md-3 text-center">{{hotel.type.toUpperCase()}}</p>
                                            <template v-if="hotel.type == 'hotel'">
                                                <p class="d-md-inline mr-md-2 text-center">Registered Rooms {{ hotel.hab }} </p>
                                                <p class="d-md-inline text-center">{{ hotel.zone }}</p>
                                            </template>
                                        </div>
                                         <Link :href="route('collaborator.sales.details',{hab:hotel.id})">
                                            <h1 class="pt-1 pb-2 title">{{hotel.calle}} {{hotel.planta}}</h1>
                                        </Link>
                                        <div class="estadistica">
                                            <p class="px-2">Total benefit {{ hotel.total_benefit }} €</p>
                                            <p class="px-2">Total orders: {{ hotel.total_orders }}</p>
                                            <button class="btn btn-link px-2" data-toggle="modal" :data-target="'#centralModal'+hotel.id">Get QR</button>
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
                                                                                    { offset: 0, color: '#B4CEE2' },
                                                                                    { offset: 1, color: '#B4CEE2' },
                                                                                ],
                                                                            },
                                                                            }"
                                                                            fileExt="png"
                                                                            :backgroundOptions="{ color: '#ffffff' }"
                                                                            :cornersSquareOptions="{ type: 'dot', color: '#B4CEE2' }"
                                                                            :cornersDotOptions="{ type: undefined, color: '#B4CEE2' }"
                                                                            :download="false"
                                                                            downloadButton="view-cart bg-info mt-3 souvenirs_btn"
                                                                            :downloadOptions="{ name: 'souvenirs', extension: 'png' }"
                                                                            crossOrigin="anonymous"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="row px-3 pt-4 pb-5">
                                                                    <div class="col-6 text-left">
                                                                        <a class="bnt btn-modal text-white rounded-pill px-4 py-1" href="#" data-dismiss="modal" >Return</a>
                                                                    </div>
                                                                    <div class="col-6 text-right">
                                                                        <a class="bnt btn-modal text-white rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(hotel.id,hotel.calle+' '+hotel.planta)">Download</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Central Modal Small -->

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 p-0 my-auto botones">
                                        <Link :href="route('collaborator.sales.details',{hab:hotel.id})" class="btn btn-info w-75 my-1 py-0 text-white">See more</Link>
                                        <Link  :href="route('collaborator.edit.hab',{hab:hotel.id})" class="btn btn-secondary w-75  my-1 py-0">Edit</Link>
                                    </div>
                            </div>
                        </div>  
                    </section>
                </template>
            </div>
        </div>    
    </div>
</div>  
</template>
<script>
    import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
    import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'  
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import QRCodeVue3 from "qrcode-vue3"

	export default {
		layout:TemplateApp,
		components:{
			Head,
            Link,
            QRCodeVue3,
            ModalCookies
       },
       props: {
        hotels: Object,
        url:String
        },
        created(){
            if(this.hotels.length > 0){
                this.user_id = this.hotels[0].pivot.user_id
            }
            console.log(this.hoteles);
        },
        computed:{
            hoteles(){
            const obj = this.hotels.map((col)=>{
                var total_benefit = 0;
                col.orders.forEach(function(order) {
                    total_benefit = parseInt(total_benefit)  + parseInt(order.total);
                });
                this.total = this.total + (total_benefit/100)
                this.orders = this.orders + (col.orders.length)
            return {
                id : col.id,
                calle: col.calle,
                planta: col.planta,
                image : col.image,
                type : col.type,
                hab : col.hab,
                zone : col.zone,
                total_benefit : total_benefit/100,
                total_orders : col.orders.length
            }
            });
            return obj;
        },

        },
        data(){
            return{
                showModal:false,
                total: 0,
                orders: 0,
                user_id:0
            }
        },
        methods: {
            lodging(){
                this.$inertia.get(route('collaborator.create.hab'),{}, {
                    preserveScroll: true
                })
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
    }
}
</script>
<style scope>
body{
    background-color: transparent;
}
.modal .btn-modal{
    background-color: #5a80fb;
}
.main h1{
    font-size: 2em;
    font-weight: bolder;
}
.main .boton-inicio{
    padding: 10px 50px;
    font-size: 25px;
    margin-top: 50px;
    border-radius:20px;
}
.main .boton-inicio i{
    padding-right: 20px;
}
.main .boton-inicio:hover{
    color:#fff;
}

/* responsive main */
@media (max-width:450px){
    .main .boton-inicio{
        padding: 10px;
    }
    .main .boton-inicio i{
        padding-right: 5px;
    }
}
/*estilo templates*/ 
.containter{
    max-width: 75% !important;
}
#cabecera h1{
    font-size: 2em;
    font-weight: bolder;
}

#cabecera .info-boton{
    text-align: left;
}
#cabecera .info-boton .boton i{
    padding-right: 20px;
}
#cabecera .boton:hover{
    color:#fff;
}
#cabecera .caja-info .info-total{
    line-height: 0;
    font-size: 21px;
}
#alojamientos .tarjeta{
    box-shadow: 1px 1px 3px 3px rgba(0 0 0 / 20%);
}
#alojamientos .tarjeta .texto p{
    color:#999;
    text-align: left;
}
#alojamientos .tarjeta .botones{
    text-align: right;
}
#alojamientos .tarjeta h1{
    font-size: 30px;
    font-weight: bold;
    text-align: left;
}
#alojamientos .tarjeta h1:hover{
    color: #3f9ae5;
}
#alojamientos .tarjeta .estadistica{
    display: inline-flex;
    float:left;
}
#alojamientos .tarjeta .estadistica p{
    padding-top:0.5em;
}
/* responsive */
@media (max-width:450px){
    #cabecera .boton{
        padding: 10px;
    }
    #cabecera .boton i{
        padding-right: 5px;
    }
}
@media (max-width:930px){
    .container{
        max-width: 90%;
    }
}
@media (max-width:767px){
    #alojamientos .tarjeta .estadistica{
        display: block;
    }
    #alojamientos .tarjeta .estadistica p{
        padding-top:0;
    }
    #alojamientos .tarjeta .botones{
        text-align: center;
        padding: 15px !important;
    }
    #cabecera .caja-info{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    #cabecera .info-boton{
        text-align: center;
    }
}
</style>