<template>
    <section id="colaborador">
        <div class="container px-0 px-md-5">
            <div class="row">
                <div class="col-3 ">
                    <Link :href="route('admin.collaborator.show',{id:collaborator.id})"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
                </div>
            </div>
            <div class="row ficha mx-2 mx-lg-4 my-4 p-2 bg-light border">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{ collaborator.profile.firstname}}</h1>
                        <p class="font-weight-bolder text-muted mt-md-3 text-center text-md-left">{{collaborator.email}}</p>
                    </div>
                    <div class="d-md-inline-flex mt-1">
                        <div class="pr-md-4 text-md-center">
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Benefecio total</p> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ total.toFixed(2) }}€</p>
                        </div>
                        <div class="pr-md-4 text-md-center"> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ totalOrders }}</p>
                        </div>
                        <div class="pr-md-4 text-md-center"> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Alojamientos registrados:</p>
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{collaborator.hotel.length}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="tabla">
        <div class="container px-0 px-md-4">
            <div class="row cabeza mx-lg-4">
                <div class="col-12 my-md-4">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-3xl"><strong>Ventas totales</strong></h1>
                </div>
            </div>
            <div class="row tabla mx-2">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-light" >
                                <tr>
                                    <th class="text-center" scope="col">Alojamiento</th>
                                    <th class="text-center" scope="col">Dirección</th>
                                    <th class="text-center" scope="col">Devuelto</th>
                                    <th class="text-center" scope="col">Total</th>
                                    <th class="text-center" scope="col">Beneficio</th>
                                    <th class="text-center w-28" scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="venta in ventas" :key="venta.id">
                                    <td class="text-center">{{venta.calle}} {{venta.planta}}</td>
                                    <td class="text-center">{{venta.address}}</td>
                                    <td class="text-center p-0">
                                        <template v-if="venta.returned == 1">
                                            <select class="py-1 rounded mt-2" name="returned" id="returned" @change="returned(venta.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select class="py-1 rounded mt-2" name="returned" id="returned" @change="returned(venta.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>
                                    </td>
                                    <td class="text-center">{{ venta.total_benefit.toFixed(2) }}</td>
                                    <td class="text-center">{{ (venta.total_benefit*0.20).toFixed(2)}}€</td>
                                    <td class="text-center w-28 px-1">
                                        <template v-if="venta.shippings[0] !== undefined">
                                                <Link :href="route('admin.hab.transaction',[collaborator.id,venta.shippings[0].id])" 
                                                    class="btn btn-sm text-white d-inline p-0.5" as="button" style="background-color: #2b59a2">
                                                    Más detalles
                                                </Link>    
                                        </template>
                                    </td>
                                </tr>
                                <tr v-if="ventas.length == 0">
                                    <td colspan="8" class="text-center">Sin pedidos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-2 pie justify-content-md-end my-4">
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de {{ (total_benefit*0.20).toFixed(2) }}€</b></p>
                    <button class="btn btn-primary-c rounded-pill mt-2 py-1 py-md-0" hidden>Guardar cambios</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import Moment from 'moment'
import { Inertia } from '@inertiajs/inertia'

export default {
    layout:Layout,
    props:{
        orders:Object,
        collaborator:Object,
    },
    components:{
        Link
    },
    data(){
        return{
            totalOrders:0,
            total:0,
            moment:null,
            total_benefit:0
        }
    },
    created(){
        this.moment=Moment;
        console.log(this.collaborator)
        console.log(this.orders)
        this.datosColaborador()
    },
    computed:{
        ventas(){
            const obj = this.orders.data.map((col)=>{
            var total_benefits = 0
            if(col.returned == 0){
                total_benefits = parseInt(total_benefits)  + parseInt(col.total);
            }
            this.total_benefit = this.total_benefit + (total_benefits*0.20)
            return {
                id : col.hotel.id,
                calle: col.hotel.calle,
                planta: col.hotel.planta,
                address: col.hotel.address,
                image : col.hotel.image,
                date : col.hotel.created_at,
                type : col.hotel.type,
                shippings : col.shippings,
                id_t: col.transaction_id,
                email : (col.shippings[0]) ? col.shippings[0].email : "",
                returned : col.returned,
                total_benefit : parseInt(col.total),
            }
            });
            return obj;
        },
    },
     updated(){
        this.datosColaborador()
    },
    methods:{
        returned(id){
            Inertia.post(route('admin.order.returned'), {
                id: id,
            })
        },
        datosColaborador(){
            this.total = 0;
            this.total_benefit = 0;
            const obj = this.collaborator.hotel.map((col)=>{
                var total = 0;
                this.totalOrders = this.totalOrders + col.orders.length;
                
                col.orders.forEach(function(order) {
                    if(order.returned == 0){
                        total = parseInt(total) + parseInt(order.total);
                    }
                });
                this.total = this.total + (total*0.20)
            });
        },
    },
}
</script>

<style>
#colaborador .ficha h1{
	font-size: 30px;
}
#colaborador .ficha{
	border: 1px solid #d5d5d5;
}
</style>