<template>
    <section id="admin-sales-associate" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    Ventas totales
                </h1>
            </div>
        </div>
        <div class="breadcrumb-associate row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de partners / {{user.profile.firstname}} / <b>Ventas totales</b></p>
            </div>
        </div>
        <!--END Header section-->
        <div class="benefit-associate row mx-1.5 lg:mx-0">
            <div class="col-12 text-left px-0">
                <p class="d-lg-inline mr-lg-4"><b>Saldo disponible: </b>{{ (balance*0.20).toFixed(2) }}€</p>
                <p class="d-lg-inline mr-lg-4"><b>Facturación total: </b>{{ total.toFixed(2) }}€</p>
                <p class="d-lg-inline"><b>Beneficio total: </b>{{ (total*0.20).toFixed(2) }}€</p>
            </div>
        </div>
        <div class="last-withdrawal row mx-1.5 lg:mx-0 mt-3">
            <div class="col-12 text-left px-0">
                <p class="d-lg-inline mr-lg-4">
                    <b>Última transferencia de saldo realizada: </b>
                    <template v-if="date != null">
                            {{ moment(date).format("DD/MM/YYYY") }}
                    </template>
                    <template v-else>
                            Sin retiros
                    </template>
                </p>
            </div>
        </div>
        <div class="filtros row my-3 mx-0 justify-content-between">
            <div class="col-12 col-lg-6 px-0">
                <div class="total-fechas row">
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
        </div>
        <!-- Content section-->
        
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
                                <td class="text-center">{{$page.props.auth.profile.city}}</td>
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
    </section>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import ModalSales from '@/Pages/Collaborator/components/Modal.vue'
import { Link } from '@inertiajs/inertia-vue3';
import Moment from 'moment'
export default {
    layout:Layout,
    components:{
        Link,
        Paginator,
        ModalSales
    },
    props:{
        orders:Object,
        totalOrders:Object,
        user:Object,
        date:String
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
            balance:0
        }
    },
    created(){
        this.moment=Moment;
        // console.log(this.$page.props.auth)
        this.totalOrders.forEach(order =>{
            this.total += Number(order.total); 
            if(order.withdrawal == 0){
                this.balance += Number(order.total); 
            }
        });
        if (this.totalOrders.length > 0) {
            this.totalOrders.forEach(order =>{
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
        filter(){
            if(this.desde !== null){
                if(this.moment(this.hasta).isAfter(this.desde)){
                    this.$inertia.get(route('admin.associate.sales',{user:this.user.id}), {desde:this.desde,hasta:this.hasta},
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
        goBack () {
            window.history.back()
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