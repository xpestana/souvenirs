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
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ total }}€</p>
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
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-3xl"><strong>Ventas de {{hotel.calle}} {{hotel.planta}}</strong></h1>
                </div>
            </div>
            <div class="row cuerpo mx-lg-4 mt-md-2">
                <div class="col-12 px-md-0">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center" scope="col">ID transacción</th>
                                    <th class="text-center" scope="col">Devuelto</th>
                                    <th class="text-center" scope="col">Correo</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Beneficio</th>
                                    <th class="text-center" scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="hotel.orders.length == 0">
                                    <td colspan="6" class="text-center">Propiedad sin ventas relacionadas</td>
                                </tr>
                                <tr v-for="order in hotel.orders" :key="order.transaction_id">
                                    <td class="text-center">{{ order.transaction_id }}</td>
                                    <td class="text-center"></td>
                                    <!-- <td>{{ order.shippings[0].email }}</td> -->
                                    <td class="text-center">-</td>
                                    <td class="text-center">{{ moment(order.created_at).format("DD/MM/YYYY") }}</td>
                                    <td class="text-center">{{ parseInt(order.total)/100 }} €</td>
                                    <td class="text-center px-0">
                                        <Link :href="route('admin.hab.transaction',collaborator.id)" 
                                            class="btn btn-sm text-white d-inline p-0.5 mx-0" as="button" 
                                            style="background-color: #2b59a2">
                                            Más detalles
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-lg-4 pie justify-content-between my-4">
                <div class="col-12 col-md-5">
                    <h5  class="text-azulc mt-1 p-1 font-weight-bolder"><Link :href="route('admin.sales.hab',{id: collaborator.id})" v-if="hotel.orders.length !== 0">Ventas totales<i class="fas fa-angle-right ml-2 py-1 px-1.5 bg-azulc text-white rounded-circle"></i></Link></h5>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de {{ totalBeneficio }}€</b></p>
                    <button class="btn btn-primary-c rounded-pill mt-2 py-1 py-md-0">Guardar cambios</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import Moment from 'moment'
export default {
    layout:Layout,
    props:{
        hotel:Object,
        collaborator:Object,
    },
    components:{
        Link
    },
    data(){
        return{
            orders:0,
            total:0,
            moment:null
        }
    },
    created(){
        this.moment=Moment;
        console.log(this.collaborator)
        console.log(this.hotel)
        this.datosColaborador()
    },
    methods:{
        datosColaborador(){
            const obj = this.collaborator.hotel.map((col)=>{
                var total_benefits = 0;
                this.orders = this.orders + col.orders.length;
                col.orders.forEach(function(order) {
                    total_benefits = parseInt(total_benefits)  + parseInt(order.total);
                });
                this.total = this.total + (total_benefits/100)
            });
        },
    },
    computed:{
        totalBeneficio(){
            const total = this.hotel.orders.reduce((acc,col)=> acc + parseInt(col.total),0);
            return (total/100)
        },
    }
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