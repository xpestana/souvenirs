<template>
    <section id="tabla">
        <div class="container mt-5 px-0 px-md-4">
            <div class="row">
                <div class="col-3 ">
                    <Link :href="route('admin.sales')"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
                </div>
            </div>
            <div class="row cabeza mx-lg-4">
                <div class="col-12">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-3xl"><strong>Venta "{{ order.transaction_id }}"</strong></h1>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in order.shippings" :key="item.id">
                                    <td class="text-center">{{ item.product.title }}</td>
                                    <td class="text-center">
                                        <template v-if="item.returned == 1">
                                            <select class="rounded py-1" name="returned" id="returned" @change="returned(item.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select class="rounded py-1" name="returned" id="returned" @change="returned(item.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>
                                    </td>
                                    <td class="text-center">{{ item.email }}</td>
                                    <td class="text-center">{{ moment(item.created_at).format("DD/MM/YYYY") }}</td>
                                    <td class="text-center px-1">{{ Number(item.amount) }} €</td>
                                </tr>
                                <tr v-if="order.shippings.length == 0">
                                    <td colspan="5" class="text-center">Venta vacia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-lg-4 pie justify-content-end my-4">
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de {{totalPedido}}€</b></p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3';
import Moment from 'moment'
	export default {
    	layout:Layout,
    	props:{
        	order:Object,
    	},
        components:{
            Link
        },
        created(){
            this.moment=Moment;
            console.log(this.order)
        },
		methods:{
	        returned(id){
    	        this.$inertia.post(route('admin.shipping.returned'), {
                id: id,
        	    })
        	},
    	},
        computed:{
            totalPedido(){
                let noDevueltos = this.order.shippings.filter(el => el.returned == 0)
                return (noDevueltos.reduce((acc,el)=> acc + Number(el.amount),0))
            }
        }
    }
</script>