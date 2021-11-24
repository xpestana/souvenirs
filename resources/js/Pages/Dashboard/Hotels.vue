<template>
	<Layout>
		<div class="tab-content dashboard-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="row">
   					<div class="col-md-6">
   						<h3>Administrador de Hoteles Registrados</h3>	
   					</div>
    				<div align="center" class="col-md-6">
    					<div class="d-single-info text-lg-center">
                               <Link class="view-cart bg-info" :href="route('hotels.create')">Agregar Hotel</Link>
                        </div>
    				</div>
    			</div>
    			<div class="table-responsive">
            		<table class="table">
            			<thead>
            				<tr>
            					<th>Logo</th>
            					<th>Nombre del hotel</th>
            					<th>Tipo</th>
            					<th>Dirección del hotel</th>
            					<th>Acciones</th>
            				</tr>
            			</thead>
                		<tbody>
                    		<tr>
                        		<td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        		<td style="font-size: 15px;">165 €</td>
                        		<td style="font-size: 15px;">1</td>
                        		<td style="font-size: 15px;">165 €</td>
                        		<td style="font-size: 15px;">
                        			<Link class="text-info links-orders" :href="route('cart')">Ver</Link>
                        		</td>
                    		</tr>
                		</tbody>
            		</table>
        		</div>
			</div>
		</div>
	</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
	import Layout from '@/Layouts/LayoutProfile.vue'      
	export default {
    	components: {
        	Head,
        	Link,
        	Layout,
    	},
    	created(){
    	},
    	
	}

</script>