<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
    	<div id="hotels" class="tab-pane fade show active">
   				<div class="row">
   					<div class="col-md-12">
   						<h3>Envíos pendientes por tomar</h3>	
   					</div>
    			</div>
    			<template v-if="orders.data.length > 0">
    			<div class="table-responsive">
    				<table class="table table-striped table-bordered table-hover">
            			<thead>
            				<tr>
            					<th class="text-center">Id</th>
            					<th class="text-center">Producto</th>
            					<th class="text-center">Dirección de envio y teléfono</th>
            					<th class="text-center">Acciones</th>
            				</tr>
            			</thead>
                		<tbody>
                    		<tr v-for="order in orders.data" :key="order.id">
                    			<td class ="text-orders" style="font-size: 15px;">{{ order.id.toString().padStart(4, 0) }}</td>
                    			<td>
                    				<table class="table table-striped table-bordered table-hover">
                    					<thead>
                    						<tr>
                    							<th>Cantidad</th>
                    							<th>Descripción</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						<tr v-for="product in order.shippings" :key="product.id">
                    							<td>
                    								{{ product.quantity }}
                    							</td>
                    							<td>
                    								<h4><Link :href="route('product.souvenir.show',{product : product.product.id})"> {{ product.product.title }}</Link></h4>
                    							</td>
                    						</tr>
                    					</tbody>
                    				</table>
                    			</td>
                    			<td>
                    				{{ order.shippings[0].address }} {{ order.shippings[0].apart }} {{ order.shippings[0].city }} {{ order.shippings[0].state }} {{ order.shippings[0].zip_code }} 
                    				<br>
                    				Habitación: {{ order.shippings[0].hab }}
                    				<br>
                    				Teléfono: {{ order.shippings[0].phone }}
                    			</td>
                    			<td>
                    				<a class="text-info links-orders" href="javascript:void(0);" @click.prevent="sending(order.id)">Tomar envío</a>
                    			</td>
                    		</tr>
                		</tbody>
            		</table>
            		<div class="row justify-content-center mb-3">
                    	<div class="col-9">
                        	<paginator :paginator="orders"/>
                        </div>
                    </div>
        		</div>
        		</template>
        		<template v-else>
	        			<h2>Nada que mostrar</h2>
        		</template>
			</div>
	</div>
	</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3'
	import Layout from '@/Layouts/LayoutProfile.vue'   
	import Paginator from '@/Components/Paginator.vue'

	export default {
    	components: {
        	Head,
        	Link,
        	Layout,
        	Paginator,
    	},
    	created(){
    		console.log(this.orders)
    	},
    	props: {
        	orders: Object,
    	},
    	methods: {
        	sending(order){
        		this.$swal({
  					title: '¿Estas seguro?',
  					text: "Esta acción no se puede revertir!",
  					icon: 'warning',
  					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
  					cancelButtonColor: '#d33',
  					confirmButtonText: 'Si, tomar envío!',
  					cancelButtonText: 'Cancelar',
				}).then((result) => {
  						if (result.isConfirmed) {
  							this.$inertia.get(route('shipping.take',{order : order}),
  							{
								preserveScroll: true,
  							})
  						}
					})
        	}
    	}
	}

</script>