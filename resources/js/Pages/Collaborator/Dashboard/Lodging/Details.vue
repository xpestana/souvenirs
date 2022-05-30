<template>
    <Head title="Alojamientos"/>
    <div class="detalles">
        <div class="container mt-5">
            <div class="row cabeza">
                <div class="col-1 col-md-3 text-white volver-icon">
                    <a href="javascript:void(0);" @click="back"><i class="fas fa-angle-left bg-info"></i></a>	
                </div>
                <div class="col-12 col-md-9">
                    <h1 class="text-center mb-4 titulo text-info text-4xl"><strong>Sales of {{hotel.calle}} {{hotel.planta}}</strong></h1>
                </div>
            </div>
            <div class="row cuerpo">
                <div class="col-12 col-md-3 text-center">
                    <Link v-if="hotel.orders.length > 0" :href="route('collaborator.sales.hab',hotel.orders[0].user_id)"><p class="text-info mb-4"><strong class="pr-2">Total sales</strong><i class="fas fa-angle-right rounded-circle bg-info text-white px-2 py-1"></i></p></Link>
                    <div>
                        <img class="m-auto h-32 w-40 rounded-circle" :src="'/storage/hotel'+hotel.image" alt="">
                    </div>
                    <h6 class="mt-3"><strong>Floor {{hotel.planta}}</strong></h6>
                </div>
                <div class="col-12 col-md-9">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-active">
                            <thead>
                                <tr>
                                    <th scope="col">ID transaction</th>
                                    <template v-if="this.$page.props.auth.profile.gestor==1">
                                        <th scope="col">Room</th>
                                    </template>
                                    <th scope="col">Returned</th>
                                    <th scope="col">EMail</th>
                                    
                                    <th scope="col">Total</th>
                                    <th scope="col">Benefit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="hotel.orders.length == 0">
                                    <template v-if="this.$page.props.auth.profile.gestor==1">
                                        <td colspan="7" class="text-center">Property with no related sales</td>
                                    </template>
                                    <template v-else>
                                        <td colspan="6" class="text-center">Property with no related sales</td>
                                    </template>
                                </tr>
                                <tr v-for="order in hotel.orders" :key="order.transaction_id">
                                    <td>{{ order.transaction_id }}</td>
                                    <template v-if="this.$page.props.auth.profile.gestor==1">
                                        <td>
                                            <template v-if="order.shippings.length >0">
                                                {{order.shippings[0].hab}}
                                            </template>
                                        </td>
                                    </template>
                                    <td>
                                        <p v-if="order.returned == 0">
                                           NOT
                                        </p>
                                        <p v-else>
                                            YES
                                        </p>
                                    </td>

                                    <td>{{ moment(order.created_at).format("DD/MM/YYYY") }}</td>
                                    <td>{{ ((parseInt(order.total)/100)*0.20).toFixed(2) }} €</td>
                                    <td>{{ parseInt(order.total)/100 }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <div class="col-5 offset-7 col-md-3 offset-md-9">
                            <h2 class="text-info text-2xl font-weight-bolder">Total</h2>
                            <p><b>Tu beneficio es de {{ total_benefit.toFixed(2) }}€</b></p>
                        </div>
                    </div>
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

<style scoped>
.cabeza .titulo{
    padding: 0 110px;
}
.cabeza .volver-icon i{
    
    padding: 5px 10px;
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