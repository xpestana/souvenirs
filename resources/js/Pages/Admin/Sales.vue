<template>
    <section id="tabla">
        <div class="container mt-5 px-0 px-md-4 pt-md-5">
            <div class="row cabeza mx-lg-4">
                <div class="col-12">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-4xl"><strong>Mis ventas</strong></h1>
                </div>
            </div>
            <div class="row cuerpo mx-lg-4 mt-md-2">
                <div class="col-12 px-md-0">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center" scope="col">Colaborador</th>
									<th class="text-center" scope="col">Alojamiento</th>
                                    <th class="text-center" scope="col">Devuelto</th>
									<th class="text-center" scope="col">ID de transacción</th>
									<th class="text-center" scope="col">Cliente</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in orders.data" :key="order.id">
                                    <td class="text-center">-</td>
                                    <td class="text-center">{{ order.hotel.calle }} {{ order.hotel.panta }}</td>
                                    <td class="text-center">
                                        <template v-if="order.returned == 1">
                                            <select name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>
                                    </td>
                                    <td class="text-center">{{ order.transaction_id }}</td>
                                    <td class="text-center">{{ order.shippings[0].email / order.shippings[0].phone }}</td>
                                    <td class="text-center">{{ moment(order.created_at).format("DD/MM/YYYY") }}</td>
									<td class="text-center">{{ parseInt(order.total) / 100 }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-lg-4 pie justify-content-end my-4">
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de 333€</b></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Moment from 'moment'

export default {
    layout:Layout,
    components:{
    },
    created(){
        console.log(this.orders);
        this.moment=Moment;
    },
    props:{
        orders:Object,
    },
    methods:{
        back() {
            window.history.back();
        },
        returned(id){
                Inertia.post(route('admin.shipping.returned'), {
                id: id,
                })
            },
    },
    
    
}
</script>

<style>

</style>