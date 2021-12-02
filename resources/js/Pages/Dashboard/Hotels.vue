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
                    		<tr v-for="hotel in hotels.data" :key="hotel.id">
                        		<td class ="text-orders p-2 mb-1">
                        			<div :style="'background:url(/storage/hotel/'+hotel.image+')'" class="img-back"></div>
                        		</td>
                        		<td class="mb-1">{{ hotel.name }}</td>
                        		<td class="mb-1">{{ hotel.type }}</td>
                        		<td class="mb-1">{{ hotel.address }} {{ hotel.zone }}</td>
                        		<td class="mb-1">
                        			<Link class="view-cart bg-info ml-2" :href="route('hotels.show',{hotel: hotel.id})" title="Ver Hotel"> Ver </Link>
                        			<Link class="view-cart bg-secundary ml-2" :href="route('hotels.edit',{hotel: hotel.id})" title="Ver Hotel"> Editar </Link>
                    				<button class="view-cart bg-danger ml-2" title="eliminar hotel" @click="deleteHotel(hotel.id)"> Eliminar </button>
                        		</td>
                    		</tr>
                		</tbody>
            		</table>
            		<div class="row justify-content-center mb-3">
                    	<div class="col-9">
                        	<paginator :paginator="hotels"/>
                        </div>
                    </div>
        		</div>
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
    	props: {
        	hotels: Object,
    	},
    	created(){
    	},
    	methods: {
        	deleteHotel(hotel){
        		this.$swal({
  					title: '¿Estas seguro?',
  					text: "Esta acción no se puede revertir!",
  					icon: 'warning',
  					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
  					cancelButtonColor: '#d33',
  					confirmButtonText: 'Si, eliminar!',
  					cancelButtonText: 'Cancelar',
				}).then((result) => {
  						if (result.isConfirmed) {
  							this.$inertia.delete(route('hotels.destroy',{hotel : hotel}),
  							{
								preserveScroll: true,
  							})
  						}
					})
            	
        	}
    	}
	}

</script>