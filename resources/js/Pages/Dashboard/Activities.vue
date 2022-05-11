<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
		<div class="row">
   			<div class="col-md-6">
   				<h3>Gestión de Actividades</h3>	
   			</div>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-hover">
    			<thead>
            		<tr>
            			<th>Titulo</th>
            			<th>Flow</th>
            			<th>Localidad</th>
            			<th>Type</th>
            			<th>Acciones</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr v-for="product in products" :key="product.short_id">
            			<td>
            				{{ product.name }}
            			</td>
						<td>
							{{ product.flow }}
						</td>     
						<td>
							{{ product.location_name }}
						</td>    
						<td>
							{{ product.type['name'] }}
						</td>   			
            			<td>
            				<input type="checkbox" :value="product.short_id" @change="update(product.short_id)">
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
        		moment:null,
        		form: this.$inertia.form({
                	name: null,
                	duration: null,
                	description: null,
                	flow: null,
                	short_id: null,	
                	summary: null,	
                	type: null,	
                	location_name: null,
                	coordinates: null,	
                	images: null,
                	pricing_notes: null,
            	}),
        	}
        },
    	created(){
    		console.log("todos", this.products);
    		this.moment=Moment;
    	},
    	methods: {
    		update(product){
    			this.product(product);
    			this.form.post(route('update.activities',{activities : product}),
  					{
						preserveScroll: true,
  					})
    		},
    		product(short_id){
            	var product = this.products.filter(product => product.short_id == short_id)[0];
            	this.form.name = product.name;
            	this.form.duration = product.duration;
            	this.form.description = product.description;
            	this.form.flow = product.flow;
            	this.form.short_id = product.short_id;
            	this.form.summary = product.summary;
            	this.form.coordinates = product.coordinates;
            	this.form.type = product.type.name;
            	this.form.location_name = product.location_name;
            	this.form.images = product.images;
            	this.form.pricing_notes = product.pricing_notes;
            	

        	}
    	}
	}

</script>