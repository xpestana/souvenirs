<template>
	<Layout>
		<div class="tab-content dashboard-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="row">
   					<div class="col-md-6">
   						<h3>Administrador de Hoteles Registrados</h3>	
   					</div>
    				<div align="center" class="col-md-6 mb-3">
    					<div class="d-single-info text-lg-center">
                               <Link class="view-cart bg-info" :href="route('hotels.create')">Agregar Hotel</Link>
                        </div>
    				</div> 
    			</div>
    			<div class="table-responsive">
            		<table class="table table-striped table-bordered table-hover">
            			<thead>
            				<tr>
            					<th>Logo del hotel</th>
            					<th>Nombre del hotel</th>
            					<th>Tipo</th>
            					<th>Dirección del hotel</th>
            					<th>Acciones</th>
            				</tr>
            			</thead>
                		<tbody>
                    		<tr v-for="hotel in hotels" :key="hotel.id">
                        		<td class ="text-orders p-2 mb-1">
                        			<div :style="'background:url(/storage/hotel/'+hotel.image+')'" class="img-back"></div>
                        		</td>
                        		<td class="mb-1" style="font-size: 15px;">{{ hotel.name }}</td>
                        		<td class="mb-1" style="font-size: 15px;">{{ hotel.type }}</td>
                        		<td class="mb-1" style="font-size: 15px;">{{ hotel.address }} {{ hotel.zone }}</td>
                        		<td class="mb-1" style="font-size: 15px;">
                        			<Link class="view-cart bg-info ml-2" :href="route('hotels.show',{hotel : hotel.id})" title="Ver Hotel"> Ver </Link>
                        			<Link class="view-cart bg-secundary ml-2" :href="route('hotels.edit',{hotel : hotel.id})" title="Ver Hotel"> Editar </Link>
                    				<Link class="view-cart bg-danger ml-2" title="eliminar hotel" @click="deleteHotel(hotel.id)"> Eliminar </Link>
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
    	props: {
        	hotels: Object,
    	},
    	created(){
    	},
    	methods: {
        	deleteHotel(hotel){
            	this.$inertia.delete(route('hotels.destroy',{hotel : hotel}))
        	}
    	}
	}

</script>