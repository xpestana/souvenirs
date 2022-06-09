<template>
    <div class="detalles">
        <div class="container mt-16 px-md-5">
            <div class="row titulo">
                <div class="col-12">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-4xl"><strong>Ventas de las <br>colaboraciones</strong></h1>
                </div>
            </div>
            <div class="row justify-content-around my-4">
                <div class="col-12 col-md-4">
                    <button class="btn btn-lg btn-secondaryc w-100">Pedir flayer</button>
                </div>
                <div class="col-12 col-md-4 mt-3 mt-md-0">
                    <button class="btn btn-lg btn-secondaryc w-100"  data-toggle="modal" data-target="#AssociateQR">Obtener QR</button>
                    <div class="modal fade" id="AssociateQR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                                :imgclass="'souvenirs_img'+this.$page.props.auth.user.id"
                                                style="max-width: 50%;"
                                                :value="url+'?c='+this.$page.props.auth.user.id"
                                                :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                                                :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                                :dotsOptions="{
                                                    type: 'square',
                                                    color: '#B4CEE2',
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
                                            <a class="btn text-white btn-azulc rounded-pill px-4 py-1" href="#" data-dismiss="modal" >Volver</a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn text-white btn-azulc rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(this.$page.props.auth.user.id,this.$page.props.auth.profile.firstname)">Descargar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tabla">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-light" >
                                <tr>
                                    <th scope="col" class="text-center">ID de transacción</th>
                                    <th scope="col" class="text-center">Devuelto</th>
                                    <th scope="col" class="text-center">Fecha</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Beneficio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="venta in ventas" :key="venta.id">
                                    <td class="text-center">{{venta.id_t }}</td>
                                    <td class="text-center">{{moment(venta.date).format("DD/MM/YYYY")}}</td>
                                    <td class="text-center">{{ parseInt(venta.total_benefit*0.20).toFixed(2) }}</td>
                                    <td class="text-center">{{venta.total_benefit.toFixed(2)}}€</td>
                                </tr>
                                <tr v-if="ventas.length == 0">
                                    <td colspan="7" class="text-center">Sin ventas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row pie justify-content-end">
                <div class="col-sm-4 col-md-3 mt-4">
                    <h2 class="text-info"><strong>Total {{total}}€</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 col-md-4">
                    <paginator :paginator="orders" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import Layout from '@/Pages/Associates/Layouts/Layout.vue'  
import { Head, Link } from '@inertiajs/inertia-vue3'
import Paginator from '@/Components/Paginator'
import Moment from 'moment'
import QRCodeVue3 from "qrcode-vue3"
export default {
    layout:Layout,
    props:{
        orders:Object,
        url:String
    },
    components:{
        Head,
        Link,
        Paginator,
        QRCodeVue3
    },
    data(){
        return{
            total:0
        }
    },
    created(){
        this.moment=Moment;
    },
    methods:{
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
        ventas(){
            const obj = this.orders.data.map((col)=>{
            this.total += parseInt(col.total);
            return {
                id : col.id,
                calle: col.calle,
                planta: col.planta,
                address: col.address,
                image : col.image,
                date : col.created_at,
                type : col.type,
                shippings : col.shippings,
                id_t: col.transaction_id,
                // email : col.shippings[0].email,
                total_benefit : parseInt(col.total)/100,
            }
            });
            this.total = this.total/100;
            return obj;
        },
    }
}
</script>

<style scope>
strong{
    font-weight: bold;
}
.pie h2{
    font-size: 2em;
}
.btn-secondaryc{
    background-color: #aaaaaa;
    color: #fff;
}
</style>