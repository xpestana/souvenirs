<template>
    <Head title="Alojamientos"/>
    <div class="detalles">
        <div class="container mt-5">
            <div class="row cabeza">
                <div class="col-1 text-white volver-icon">
                    <a href="javascript:void(0);" @click="back"><i class="fas fa-angle-left bg-info"></i></a>	
                </div>
                <div class="col-11">
                    <h1 class="text-center mb-4 titulo text-info"><strong>Ventas de {{hotel.calle}} {{hotel.planta}}</strong></h1>
                </div>
            </div>
            <div class="row cuerpo">
                <div class="col-12 col-md-3 text-center">
                    <Link v-if="hotel.orders.length > 0" :href="route('collaborator.sales.hab',hotel.orders[0].user_id)"><p class="text-info mb-4"><strong class="pr-2">Ventas totales</strong><i class="fas fa-angle-right rounded-circle bg-info text-white px-2 py-1"></i></p></Link>
                    <img class="rounded-circle m-auto" :src="'/storage/hotel'+hotel.image" alt="">
                    <h6 class="mt-3"><strong>Piso {{hotel.planta}}</strong></h6>
                    <p class="ventas">VENTAS</p>
                </div>
                <div class="col-12 col-md-9">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-active">
                            <thead>
                                <tr>
                                    <th scope="col">ID transacción</th>
                                    <th scope="col">Devuelto</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Beneficio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="hotel.orders.length == 0">
                                    <td colspan="5" class="text-center">Propiedad sin ventas relacionadas</td>
                                </tr>
                                <tr v-for="order in hotel.orders" :key="order.transaction_id">
                                    <td>{{ order.transaction_id }}</td>
                                    <td></td>
                                    <!-- <td>{{ order.shippings[0].email }}</td> -->
                                    <td>-</td>
                                    <td>{{ moment(order.created_at).format("DD/MM/YYYY") }}</td>
                                    <td>{{ parseInt(order.total)/100 }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row pie">
                <div class="col-5 offset-7 col-md-3 offset-md-9">
                    <h2 class="text-info">Total</h2>
                    <p><b>Tu beneficio es de {{ total_benefit.toFixed(2) }}€</b></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
import { Head, Link } from '@inertiajs/inertia-vue3'
import Moment from 'moment'

export default {
    layout:TemplateApp,
    props:{
        hotel:Object
    },
    data(){
      return {
        moment:null,
        total_benefit: 0
      }
    },
    created(){
        console.log(this.hotel)
        this.moment=Moment;
        var total_benefit = this.total_benefit;
        this.hotel.orders.forEach(function(order) {
            total_benefit = total_benefit  + (parseInt(order.total))/100;
        });
        this.total_benefit = total_benefit;
    },
    components:{
        Head,
        Link,
    },
    methods:{
        back() {
            window.history.back();
        },
    }
}
</script>

<style scope>
.cabeza .titulo{
    font-size: 4em;
    padding: 0 110px;
}
.cabeza .volver-icon i{
    
    padding: 5px 10px;
}
.cuerpo img{
    max-height: 125px;
}
.pie h2{
    font-size: 2em;
}
/* responsive*/
@media (max-width:767px){
    .cabeza .titulo{
        font-size: 2em;
        padding: 0 5px;
    }
    .pie h2{
        margin-top: 10px;
    }
    .cuerpo .ventas{
        margin-bottom: 15px;
    }
}
</style>