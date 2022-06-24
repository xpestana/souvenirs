<template>
    <section id="dashboard-total-header" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="fas fa-arrow-left text-muted mr-2"></i> Ventas totales</h1>
            </div>
        </div>
        <!--END Header section-->
        
        <div class="total-saldo row my-8 mx-1.5 lg:mx-0">
            <div class="col-12 col-lg-8 rounded-xl bg-collaborator-orange py-2.5">
                <div class="row justify-content-center">
                    <div class="pt-2 col-12 col-lg-6 text-center text-lg-left">
                        <h2 class="font-bold inline text-white text-base">Saldo pendiente: </h2><br class="lg:hidden">
                        <p class="inline text-white text-base">0€</p>
                    </div>
                    <div class="pt-0.5 col-12 col-lg-6 text-center text-lg-right">
                        <button class="btn bg-white text-orangec lg:ml-auto py-1 lg:mr-2.5 font-bold">Pedir transferencia</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center text-lg-left pt-2 pt-lg-0">
                <p class="pt-0.5"><b>Facturación total: </b>{{total}}€</p>
                <p class=""><b>Beneficio total: </b>{{(total*0.20).toFixed(2)}}€</p>
            </div>
        </div>
        <!-- Content section-->
        <div class="total-fechas row mb-3.5">
            <div class="col-md-3 col-12">
                <label class="font-bold mb-1">Mostrar desde:</label>
                <input type="date" v-model="desde" class="w-100 rounded col-form-input py-1.5">
            </div>
            <div class="col-md-3 col-12">
                <label class="font-bold mb-1">Hasta:</label>
                <input type="date" v-model="hasta" class="w-100 rounded col-form-input py-1.5">
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
                            <tr v-if="orders.length == 0">
                                <td colspan="5" class="text-center">Sin alojamientos</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ver-mas row my-2.5 justify-content-center">
            <div class="col-11 col-md-8 col-lg-4 col-xl-6 text-center">
                <paginator :paginator="orders"/>
                <!-- <button class="btn btn-outline-orange font-bold py-1 px-12">Cargar más</button> -->
            </div>
        </div>
        <!-- END Content section-->
    </section>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3';
import Moment from 'moment'
export default {
    layout:TemplateApp,
    components:{
        Link,
        Paginator
    },
    props:{
        hotels:Object,
        orders:Object
    },
    data(){
        return{
            total:0,
            desde:null,
            hasta:null,
        }
    },
    created(){
        this.moment=Moment;
        this.orders.data.forEach(order =>{
            this.total += Number(order.total);
        });
    },
    watch:{
        hasta(newVal,oldVal){
            if(this.desde !== null){
                if(this.moment(newVal).isAfter(this.desde)){
                    this.$inertia.get(route('dashboard.sales.total'), {desde:this.desde,hasta:this.hasta},
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
        desde(newVal,oldVal){
            if(this.hasta !== null){
                if(this.moment(this.hasta).isAfter(newVal)){
                    this.$inertia.get(route('dashboard.sales.total'), {desde:this.desde,hasta:this.hasta},
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
    }
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