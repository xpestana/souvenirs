<template>
    <div class="detalles">
        <div class="container mt-5">
            <div class="row titulo">
                <div class="col-1 text-white">
                    <a href="javascript:void(0);" @click="back"><i class="fas fa-angle-left bg-info px-2 py-1"></i></a>		
                </div>
                <div class="col-11">
                    <h1 class="text-center mb-4 titulo text-info display-4"><strong>Ventas totales</strong></h1>
                </div>
            </div>
            <div class="row tabla">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-light" >
                                <tr>
                                    <th scope="col" class="text-center">Alojamiento</th>
                                    <!-- <template v-if="this.$page.props.auth.profile.gestor==1">
                                        <th scope="col" class="text-center">N° pedidos</th>
                                        <th scope="col" class="text-center">Total</th>
                                    </template>
                                    <template v-else> -->
                                        <th scope="col" class="text-center">Dirección</th>
                                        <!-- <th scope="col" class="text-center">Devuelto</th> -->
                                        <th scope="col" class="text-center">ID de transacción</th>
                                        <!-- <th scope="col" class="text-center">Correo</th> -->
                                        <th scope="col" class="text-center">Fecha</th>
                                    <!-- </template> -->
                                    <th scope="col" class="text-center">Beneficio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="venta in ventas" :key="venta.id">
                                    <td class="text-center">{{venta.calle}} {{venta.planta}}</td>
                                    <!-- <template v-if="this.$page.props.auth.profile.gestor==1">
                                        <td class="text-center">{{venta.shippings.length}}</td>
                                        <td class="text-center">{{ parseInt(venta.total_benefit*0.20).toFixed(2) }}</td>
                                    </template>
                                    <template v-else> -->
                                        <td class="text-center">{{venta.address}}</td>
                                        <!-- <td class="text-center">-</td> -->
                                        <td class="text-center">{{venta.id_t }}</td>
                                        <!-- <td class="text-center">{{venta.email}}</td> -->
                                        <td class="text-center">{{moment(venta.date).format("DD/MM/YYYY")}}</td>
                                    <!-- </template> -->
                                    <td class="text-center">{{venta.total_benefit.toFixed(2)}}€</td>
                                </tr>
                                <tr v-if="ventas.length == 0">
                                    <td colspan="7" class="text-center">Sin alojamientos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row pie justify-content-end">
                <div class="col-sm-4 col-md-3 mt-4">
                    <h2 class="text-info"><strong>Total</strong></h2>
                    <p><b>Tu beneficio es de {{total}}€</b></p>
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
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
import { Head, Link } from '@inertiajs/inertia-vue3'
import Paginator from '@/Components/Paginator'
import Moment from 'moment'

export default {
    layout:TemplateApp,
    props:{
        orders:Object
    },
    components:{
        Head,
        Link,
        Paginator
    },
    data(){
        return{
            total:0
        }
    },
    created(){
        console.log(this.orders)
        this.moment=Moment;
    },
    methods:{
        back() {
            window.history.back();
        },
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
</style>