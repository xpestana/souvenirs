<template>
    <section id="colaborador">
        <div class="container px-0 px-md-5">
            <div class="row">
                <div class="col-3 ">
                    <a href="javascript:void(0);" @click="back"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></a>	
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
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ orders }}</p>
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
        <div class="container mt-5 px-0 px-md-4">
            <div class="row cabeza mx-lg-4">
                <div class="col-12">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-3xl"><strong>Venta "{{ shipping.order.transaction_id }}"</strong></h1>
                </div>
            </div>
            <div class="row cuerpo mx-lg-4 mt-md-2">
                <div class="col-12 px-md-0">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center" scope="col">Artículo</th>
                                    <th class="text-center" scope="col">Devuelto</th>
                                    <th class="text-center" scope="col">Correo</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Pago</th>
                                    <th class="text-center" scope="col">Beneficio alojamiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ shipping.product.title }}</td>
                                    <td class="text-center">
                                        <template v-if="shipping.returned == 1">
                                            <select class="py-1 rounded" name="returned" id="returned" @change="returned(shipping.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select class="py-1 rounded" name="returned" id="returned" @change="returned(shipping.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>
                                    </td>
                                    <td class="text-center">{{ shipping.email }}</td>
                                    <td class="text-center">{{ moment(shipping.created_at).format("DD/MM/YYYY") }}</td>
                                    <td class="text-center">{{ parseInt(shipping.amount) }} €</td>
                                    <td class="text-center">{{ (parseInt(shipping.amount) * 0.20).toFixed(2) }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-lg-4 pie justify-content-between my-4">
                <div class="col-12 col-md-5">
                    <h5  class="text-azulc mt-1 p-1 font-weight-bolder"><Link :href="route('admin.sales.hab',{id: collaborator.id})" >Ventas totales<i class="fas fa-angle-right ml-2 py-1 px-1.5 bg-azulc text-white rounded-circle"></i></Link></h5>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de {{ (parseInt(shipping.amount) * 0.2).toFixed(2) }}€</b></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Moment from 'moment'
import { Inertia } from '@inertiajs/inertia'
export default {
    layout:Layout,
    props:{
        hotel:Object,
        collaborator:Object,
        shipping:Object,
    },
    data(){
        return{
            orders:0,
            total:0,
        }
    },
    created(){
        console.log(this.shipping)
        this.datosColaborador();
        this.moment=Moment;
    },
    components:{
    },
    methods:{
        returned(id){
            Inertia.post(route('admin.shipping.returned'), {
                id: id,
            })
        },
        back() {
            window.history.back();
        },
        datosColaborador(){
            const obj = this.collaborator.hotel.map((col)=>{
                var total_benefits = 0;
                this.orders = this.orders + col.orders.length;
                col.orders.forEach(function(order) {
                    total_benefits = parseInt(total_benefits)  + parseInt(order.total);
                });
                this.total = this.total + (total_benefits*0.20)
            });
        },
    },
    
    
}
</script>