<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
    	<div class="row">
   			<div class="col-md-6">
   				<h3>Gestión de souvenirs</h3>	
   			</div>
    		<div align="center" class="col-md-6 mb-3">
    			<div class="d-single-info text-lg-center">
                	<Link class="view-cart bg-info" :href="route('souvenirs.create')">Agregar Souvenir</Link>
                </div>
    		</div> 
    	</div>
    	<div class="table-responsive">
        	<table class="table table-striped table-bordered table-hover">
            	<thead>
            		<tr>
            			<th>Titulo</th>
            			<th>Precio</th>
            			<th hidden>Stock</th>
            			<th>Destacado</th>
            			<th>Acciones</th>
            		</tr>
            	</thead>
                <tbody>
                	<tr v-for="product in products" :key="product.id">
                		<td>{{ product.title }}</td>
                		<td>{{ product.price }} €</td>
                		<td hidden>{{ product.stock }}</td>
                		<td style="font-size: 13px;">
                			<template v-if="product.featured==0"><i class="fas fa-times-circle text-danger"></i></template>
                			<template v-if="product.featured==1"><i class="fas fa-check-square text-success"></i></template>
                		</td>
                		<td>
                			<Link class="view-cart bg-info ml-2" :href="route('souvenirs.show',{souvenir: product.id})" title="Ver Souvenir"> Ver </Link>
                        	<Link class="view-cart bg-secundary ml-2" :href="route('souvenirs.edit',{souvenir: product.id})" title="Ver Hotel"> Editar </Link>
                    		<button class="view-cart bg-danger ml-2" title="eliminar hotel" @click="deleteProduct(product.id)"> Eliminar </button>
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
	export default {
    	components: {
        	Head,
        	Link,
        	Layout,
    	},
    	props: {
        	products: Object,
    	},
    	created(){
    		console.log(this.products);
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
  							this.$inertia.delete(route('souvenirs.destroy',{souvenir : product}),
  							{
								preserveScroll: true,
  							})
  						}
					})
            	
        	}
    	}
	}

</script>