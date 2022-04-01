<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
		<div class="row">
   			<div class="col-md-6">
   				<h3>Gestión de Actividades</h3>	
   			</div>
    		<div align="center" class="col-md-6 mb-3">
    			<div class="d-single-info text-lg-center">
                	<Link class="view-cart bg-info" :href="route('activities.create')">Agregar Actividad</Link>
                </div>
    		</div> 
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-hover">
    			<thead>
            		<tr>
            			<th>Titulo</th>
            			<th>Precio</th>
            			<th>Fecha de inicio / final</th>
            			<th>Destacado</th>
            			<th>Acciones</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr v-for="product in products" :key="product.id">
            			<td>{{ product.title }}</td>
            			<td>
            				<template v-if="product.activities.priceN">
            					Adulto: {{ product.activities.priceA }} / Niño: {{ product.activities.priceN }}
            				</template>
            				<template v-else>
            					{{ product.activities.priceA }}
            				</template>
            			</td>
            			<td>
            				<template v-if="product.activities.end">
            					De {{ moment(product.activities.init).format('DD/MM/YYYY') }} a {{ moment(product.activities.end).format('DD/MM/YYYY') }}
            				</template>
            				<template v-else>
            					El {{ moment(product.activities.init).format('DD/MM/YYYY')}}
            				</template>
            			</td>
            			<td style="font-size: 13px;">
                			<template v-if="product.featured==0"><i class="fas fa-times-circle text-danger"></i></template>
                			<template v-if="product.featured==1"><i class="fas fa-check-square text-success"></i></template>
                		</td>
            			<td>
            				<Link class="view-cart bg-info ml-2" :href="route('activities.show',{actividade: product.id})" title="Ver Actividades"> Ver </Link>
                        	<Link class="view-cart bg-secundary ml-2" :href="route('activities.edit',{actividade: product.id})" title="Editar Actividades"> Editar </Link>
                    		<button class="view-cart bg-danger ml-2" title="Eliminar actividad" @click="deleteProduct(product.id)"> Eliminar </button>
            			</td>
            		</tr>
            	</tbody>
    		</table>
    	</div>
	</div>
	</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
	import Layout from '@/Layouts/LayoutProfile.vue' 
	import Moment from 'moment'

	export default {
    	components: {
        	Head,
        	Link,
        	Layout,
    	},
    	props: {
            products: Object,
        },
        data(){
        	return {
        		moment:null
        	}
        },
    	created(){
    		this.moment=Moment;
    	},
    	methods: {
        	deleteProduct(product){
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
  							this.$inertia.delete(route('activities.destroy',{actividade : product}),
  							{
								preserveScroll: true,
  							})
  						}
					})
            	
        	}
    	}
	}

</script>