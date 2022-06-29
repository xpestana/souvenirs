<template>
    <section id="dashboard-total-header" class="container py-8 ml-2 md:ml-0 md:px-24">
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
        
        <div class="total-saldo row my-8 mx-1.5 lg:mx-0">
            <div class="col-12 col-lg-7 rounded-xl bg-collaborator-orange py-2.5">
                <div class="row justify-content-center">
                    <div class="pt-2 col-12 col-lg-6 text-center text-lg-left">
                        <h2 class="font-bold inline text-white text-base">Saldo pendiente: </h2><br class="lg:hidden">
                        <p class="inline text-white text-base">{{ (withdrawal*0.20).toFixed(2) }} €</p>
                    </div>
                    <div class="pt-0.5 col-12 col-lg-6 text-center text-lg-right">
                        <button class="btn bg-white text-orangec lg:ml-auto py-1 lg:mr-2.5 font-bold" @click="requestTransfer">Pedir transferencia</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 text-center text-lg-left pt-2 pt-lg-0">
                <p class="pt-0.5"><b>Facturación total de retiros: </b>{{total.toFixed(2)}}€</p>
                <p class=""><b>Beneficio total de retiros: </b>{{(total*0.20).toFixed(2)}}€</p>
            </div>
        </div>
        <!-- Content section-->
        <div class="total-fechas row mb-3.5">
            <div class="col-md-3 col-12">
                <label class="font-bold mb-1">Mostrar desde:</label>
                <input type="date" v-model="desde" id="desde" class="w-100 rounded col-form-input py-1.5">
            </div>
            <div class="col-md-3 col-12">
                <label class="font-bold mb-1">Hasta:</label>
                <input type="date" v-model="hasta" @change="filter" class="w-100 rounded col-form-input py-1.5">
            </div>
        </div>
        <div class="total-tabla row">
            <div class="col-12">
                <div class="table-responsive-md">
                    <table class="tabla-collaborator table table-striped">
                        <thead class="bg-collaborator text-white" >
                            <tr>
                                <th scope="col" class="text-center">ID de transacción</th>
                                <th scope="col" class="text-center">Ciudad</th>
                                <th scope="col" class="text-center">Fecha</th>
                                <th scope="col" class="text-center">Facturación</th>
                                <th scope="col" class="text-center">Beneficio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders.data" :key="order.id">
                                <td class="text-center font-bold">{{order.transaction_id}}</td>
                                <td class="text-center">{{order.hotel.zone}}</td>
                                <td class="text-center">{{moment(order.created_at).format("DD/MM/YYYY")}}</td>
                                <td class="text-center">{{order.total}}</td>
                                <td class="text-center">{{(order.total*0.20).toFixed(2)}}€</td>
                            </tr>
                            <tr v-if="orders.data.length == 0">
                                <td colspan="5" class="text-center">Sin resultados</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ver-mas row my-2.5 justify-content-center">
            <div class="col-11 col-md-8 col-lg-4 col-xl-6 text-center overflow-auto">
                <paginator :paginator="orders"/>
                <!-- <button class="btn btn-outline-orange font-bold py-1 px-12">Cargar más</button> -->
            </div>
        </div>
        <!-- END Content section-->
        <!-- Modal Request -->
        <div class="modal modal-request fade" id="request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
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
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" @click="sendNotification">Enviar notificación</button>
                        </div>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" data-dismiss="modal" aria-label="Close">No enviar todavia</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Request  -->
        <!-- Modal Notification -->
        <div class="modal modal-notification fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
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
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Notification  -->
        <!-- Modal Notice -->
        <div class="modal modal-notice fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Notice  -->
        <ModalSales :id="'negativo'">
            <h2 class="text-lg text-center font-bold mt-3">¡Atención!</h2>
            <p class="px-4 my-2 text-xs text-center">
                Actualmente no tiene un saldo para retirar.
            </p>
            <div class="my-3.5 text-center">
                <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
            </div>
        </ModalSales>
    </section>
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
        hotels:Object,
        orders:Object,
        date:String,
        withdrawalsOrders:Object
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
        }
    },
    created(){
        this.moment=Moment;
        console.log(this.withdrawalsOrders)
        this.orders.data.forEach(order =>{
            this.total += Number(order.total); 
        });
        if (this.withdrawalsOrders.data.length > 0) {
            this.withdrawalsOrders.data.forEach(order =>{
                this.withdrawal += Number(order.total);    
            });
        }
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
            }else{
                $('#negativo').modal('show')
            }
        },
        sendNotification(){
            let request=$('#request');
            let noti=$('#notification');
            this.$inertia.post(route('collaborator.notify'),{
                onSuccess: (page) => {
                    request.modal('hide')
                    noti.modal('show')
                },
            })
        },
        filter(){
            if(this.desde !== null){
                if(this.moment(this.hasta).isAfter(this.desde)){
                    this.$inertia.get(route('dashboard.withdrawals'), {desde:this.desde,hasta:this.hasta},
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
        }
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