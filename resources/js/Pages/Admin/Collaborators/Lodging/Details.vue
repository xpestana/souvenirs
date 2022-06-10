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
            <div class="row cuerpo mx-lg-3 mt-md-2">
                <div class="col-md-3 d-none d-md-flex flex-column">
                    <img :src="'/storage/hotel/'+hotel.image" class="rounded-circle m-auto w-40 h-36" alt="hotel-img">
                    <h5 class="text-azulc mt-2 p-1 font-weight-bolder text-center"><Link :href="route('admin.sales.hab',{id: collaborator.id})" v-if="shippings.length !== 0">Ventas totales<i class="fas fa-angle-right ml-2 py-1 px-1.5 bg-azulc text-white rounded-circle"></i></Link></h5>
                </div>
                <div class="col-12 col-md-9 px-md-0">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center" scope="col">ID transacción</th>
                                    <th class="text-center" scope="col">Devuelto</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Beneficio</th>
                                    <th class="text-center" scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="shippings.length == 0">
                                    <td colspan="6" class="text-center">Propiedad sin ventas relacionadas</td>
                                </tr>
                                <tr v-for="order in shippings" :key="order.id">
                                    <td class="text-center">{{ order.transaction_id }}</td>
                                    <td class="text-center p-0">
                                        <template v-if="order.returned == 1">
                                            <select class="rounded py-1 mt-2" name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select class="rounded py-1 mt-2" name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>
                                    </td>
                                    <td class="text-center">{{ moment(order.created_at).format("DD/MM/YYYY") }}</td>
                                    <td class="text-center">{{ parseInt(order.total)/100 }} €</td>
                                    <td class="text-center px-0">
                                        <Link :href="route('admin.hab.transaction',{id:collaborator.id, shipping:order.id})" 
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
            <div class="row mx-lg-4 pie justify-content-end my-4">
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total {{ totalBeneficio }}€</h2>
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
        shippings:Object,
        collaborator:Object,
        hotel:Object,
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
        console.log(this.shippings)
        this.datosColaborador()
    },
    updated(){
        this.datosColaborador()
    },
    methods:{
        datosColaborador(){
            this.total=0;
            this.orders=0;
            const obj = this.collaborator.hotel.map((col)=>{
                var total_benefits = 0;
                this.orders = this.orders + col.orders.length;
                col.orders.forEach(function(order) {
                    total_benefits = parseInt(total_benefits)  + parseInt(order.total);
                });
                this.total = this.total + (total_benefits/100)
            });
            let shippingsReturned=0;
            this.shippings.forEach(order=>{
                if(order.returned){
                    shippingsReturned = parseInt(shippingsReturned)  + parseInt(order.total)/100;
                }
            });
            this.total = this.total - shippingsReturned
            
        },
        returned(id){
            Inertia.post(route('admin.shipping.returned'), {
                id: id,
            })
        },
    },
    computed:{
        totalBeneficio(){
            let noDevueltos = this.shippings.filter(el => el.returned == 0)
            const total = noDevueltos.reduce((acc,col)=> acc + parseInt(col.total),0);
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