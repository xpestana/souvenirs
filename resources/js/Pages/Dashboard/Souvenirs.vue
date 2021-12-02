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
            			<th>Stock</th>
            			<th>Destacado</th>
            			<th>Acciones</th>
            		</tr>
            	</thead>
                <tbody>
                	<tr>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
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
        	souvenirs: Object,
    	},
	}

</script>