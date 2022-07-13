<template>
    <section id="dashboard-retiros-header" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="fas fa-arrow-left text-muted mr-2 cursor-pointer" @click="back"></i> 
                    Historial de retiros
                </h1>
            </div>
        </div>
        <!--END Header section-->
        <div class="retiros-saldo row mx-1.5 lg:mx-0 mt-6 px-6 lg:px-0 lg:pr-1">
            <div class="col-12 col-lg-7">
                <div class="row bg-collaborator-orange rounded-xl justify-content-between py-2.5 py-1.5">
                    <div class="col-12 col-lg-6">
                        <p class="text-white text-center lg:text-left mt-lg-1">
                            <b>Saldo pendiente:</b> <br class="d-lg-none"> {{(withdrawal*0.20).toFixed(2)}}€
                        </p>
                    </div>
                    <div class="col-12 col-lg-5  text-center lg:text-right">
                        <button  @click="requestTransfer" class="btn bg-white text-orangec py-1 mt-1 mt-lg-0 font-semibold">Pedir transferencia</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7 mt-6 px-0">
                <p><b>Última transferencia de saldo realizada: </b>
                <template v-if="orders.data.length > 0">
                    {{moment(dateTEST).format("DD/MM/YYYY")}}
                </template>
                <template v-else>
                    sin retiros
                </template>
                    
                </p>
            </div>
        </div>

        <div class="retiros-filtros row mt-6 mb-1.5 mx-0.5 lg:mx-0 justify-content-between">
            <div class="col-12 col-lg-6 px-lg-0">
                <div class="total-fechas row mb-3.5">
                    <div class="col-md-6 col-12">
                        <label class="font-bold mb-1 text-base">Mostrar desde:</label>
                        <input type="date" v-model="desde" id="desde" class="w-100 rounded col-form-input py-1.5">
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="font-bold mb-1 text-base">Hasta:</label>
                        <input type="date" v-model="hasta" @change="filter" class="w-100 rounded col-form-input py-1.5">
                    </div>
                </div>        
            </div>
            <!-- <div class="d-none d-lg-block col-lg-4 text-center text-lg-left py-2.5  px-lg-0">
                <p class="pt-1.5"><b>Facturación total: </b>{{total.toFixed(2)}}€</p>
                <p class="pt-1.5"><b>Beneficio total: </b>{{(total*0.20).toFixed(2)}}€</p>
            </div> -->
        </div>
        <!-- Content section-->
        
        <div class="total-tabla row px-3.5 lg:px-0">
            <div class="col-12 col-lg-7">
                <div class="table-responsive-md">
                    <table class="tabla-collaborator table table-striped">
                        <thead class="bg-collaborator text-white" >
                            <tr>
                                <th scope="col" class="text-center">ID Retiro</th>
                                <th scope="col" class="text-center">Fecha</th>
                                <th scope="col" class="text-center">Facturación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders.data" :key="order.id">
                                <td class="text-center font-bold">{{order.transaction_id}}</td>
                                <td class="text-center">{{moment(order.updated_at).format("DD/MM/YYYY")}}</td>
                                <td class="text-center">{{order.total*0.20}}</td>
                            </tr>
                            <tr v-if="orders.data.length == 0">
                                <td colspan="5" class="text-center">Sin resultados</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row px-3.5 lg:px-0">
            <div class="col-12 col-lg-7">
                <div class="ver-mas row my-2.5 justify-content-center">
                    <div class="col-11 col-md-10 text-center overflow-auto">
                        <paginator :paginator="orders"/>
                        <!-- <button class="btn btn-outline-orange font-bold py-1 px-12">Cargar más</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Content section-->
    </section>
    <!-- Modal Request -->
        <ModalSales :id="'request'">
            <div>
                <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="flex mt-3.5">
                <img src="/vendor_asset/img/collaborator/dashboard/icons/dinero.svg" class="m-auto h-8"
                style="filter: invert(53%) sepia(76%) saturate(625%) hue-rotate(354deg) brightness(107%) contrast(104%);"
                >
            </div>
            <h2 class="text-lg text-center font-bold">¿Quieres solicitar el saldo disponible?</h2>
            <p class="px-4 my-2 text-xs text-center">
                Envíanos una notificación y nos encargaremos de realizarte la transferencia alrededor
                de unos 5 días hábiles.
            </p>
            <div class="my-2.5 text-center">
                <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" @click="sendNotification">{{textButton}}</button>
            </div>
            <div class="my-2.5 text-center">
                <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" data-dismiss="modal" aria-label="Close">No enviar todavia</button>
            </div>
        </ModalSales>
        <!-- Modal Request  -->
        <ModalSales :id="'negativo'">
            <h2 class="text-lg text-center font-bold mt-3">¡Atención!</h2>
            <p class="px-4 my-2 text-xs text-center">
                Actualmente no tiene un saldo para retirar.
            </p>
            <div class="my-3.5 text-center">
                <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
            </div>
        </ModalSales>
         <!-- Modal Notice -->
        <ModalSales :id="'notice'"> 
            <div>
                <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="flex mt-3.5">
                <img src="/vendor_asset/img/collaborator/dashboard/icons/dinero.svg" class="m-auto h-8"
                style="filter: invert(53%) sepia(76%) saturate(625%) hue-rotate(354deg) brightness(107%) contrast(104%);"
                >
            </div>
            <h2 class="text-lg text-center font-bold">Te faltan</h2>
            <h3 class="text-lg text-center my-0.5">
                <span class="text-4xl text-orangec font-bold">{{remainingDays}}</span> 
                <template v-if="Number(this.remainingDays)>1">
                    días
                </template>
                <template v-else>
                    dia
                </template>
                
            </h3>
            <h2 class="text-lg text-center font-bold">para poder solicitar una transferencia de saldo</h2>
            <p class="px-4 my-2 text-xs text-center">
                Puedes solicitar una transferencia de saldo cada 3 meses.
            </p>
            <div class="my-3.5 text-center">
                <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
            </div>
        </ModalSales>
        <!-- Modal Notice  -->
         <!-- Modal Notification -->
        <div class="modal modal-notification fade" id="notification" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"  @click="reload"></i>
                        </div>
                        <div class="my-2.5 text-center">
                            <i class="far fa-check-circle text-orangec text-4xl"></i>
                        </div>
                        <h2 class="text-lg text-center font-bold">¡Notificación recibida!</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            La transferencia se realizará en 5 días habiles. Para cualquier
                            consulta ponte en contacto con nosotros.
                        </p>
                        <div class="my-3.5 text-center">
                            <button @click="reload" class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Notification  -->
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import Paginator from '@/Components/Paginator.vue'
import ModalSales from '@/Pages/Collaborator/components/Modal.vue'
import { Link } from '@inertiajs/inertia-vue3';
import Moment from 'moment'
export default {
    layout:TemplateApp,
    components:{
        Link,
        Paginator,
        ModalSales
    },
    props:{
        orders:Object,
        date:String,
        totalOrders:Object
    },
    data(){
        return{
            total:0,
            withdrawal:0,
            desde:null,
            hasta:null,
            dateTEST:this.date,
            countTest:0,
            remainingDays:null,
            textButton:'Enviar notificación'
        }
    },
    created(){
        console.log(this.date)
        this.moment=Moment;
        this.totalOrders.forEach(order =>{
            if(order.returned == 0 && order.status == "complete" && order.withdrawal == 0){
                this.withdrawal += Number(order.total);
            }
        });
        let urlClean = this.$page.url.split('desde=')[1];
        if(urlClean){
            this.desde = urlClean.split('&hasta=')[0]
            this.hasta = urlClean.split('&hasta=')[1]
        }
    },
    methods:{
        back(){
            window.history.back();
        },
        requestTransfer(){
            if(this.withdrawal > 0){
                if(this.dateTEST !== null){
                    let dia = Number(this.moment(this.dateTEST).format("DD"));
                    let mes = Number(this.moment(this.dateTEST).format("MM"));
                    let año = Number(this.moment(this.dateTEST).format("YYYY"));
                    let ago = this.moment().diff(this.moment([año,(mes - 1),(dia)]),'days');
                    this.remainingDays = 90 - ago;
                    if(Number(ago) > 90){
                        $('#request').modal('show')
                    }else{
                        $('#notice').modal('show')
                    }
                }
            }else{
                $('#negativo').modal('show')
            }
        },
        sendNotification(){
            this.textButton = 'Enviando...';
            let request=$('#request');
            let noti=$('#notification');
            axios({
				url: route('associates.notify'),
				method: 'POST',
			})
			.then((response) => {
                this.textButton = 'Enviar notificación';
                request.modal('hide')
                noti.modal('show')
			}) 
        },
        filter(){
            if(this.desde !== null){
                if(this.moment(this.hasta).isAfter(this.desde)){
                    this.$inertia.get(route('associates.withdrawals'), {desde:this.desde,hasta:this.hasta},
                    { 
                        preserveScroll: true
                    })
                }else{
                    this.$swal({
                        title: 'A elegido un intervalo de fechas incorrecto',
                        icon: 'info',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Aceptar!',
                        confirmButtonAriaLabel: 'Aceptar!',
                    })
                }
                
            }
        },
        reload(){
            window.location.reload()
        },
    },
    
}
</script>
<style scoped>
.tabla-collaborator > tbody > tr > td ,
.tabla-collaborator > thead > tr  > th {
    border-left: 2px solid #4d778e;
    border-right: 2px solid #4d778e;
}
.tabla-collaborator>tbody>tr:nth-child(odd)>td, 
.tabla-collaborator>tbody>tr:nth-child(odd)>th {
background-color: #d4f0ff;
}
.tabla-collaborator>tbody>tr:nth-child(even)>td, 
.tabla-collaborator>tbody>tr:nth-child(even)>th {
background-color: #ffeacb;
}

</style>