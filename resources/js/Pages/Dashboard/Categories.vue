<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
    	<div id="hotels" class="tab-pane fade show active">
    		<form @submit.prevent="categories">
   				<div class="row">
   					<div class="col-md-6">
                    		<BreezeLabel for="category" value="Nueva Categoria" />
                			<BreezeInput id="category" type="text" class="form-control mt-1 mb-3 block w-full" v-model="form.category" autocomplete="category" placeholder="Categoria" />
   					</div>
    				<div align="center" class="col-md-6 mb-3">
    					<div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
						<BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Registrar </BreezeButton>
	            		<BreezeValidationErrors class="my-3" />
                    	<div class="login-footer text-center">
                       		<div v-if="status" class="mb-4 font-medium text-sm text-danger">
                        		{{ status }}
                       		</div>
                    	</div>
    				</div> 
    			</div>
    		</form>
    			<div class="table-responsive mt-4">
            		<table class="table table-striped table-bordered table-hover">
            			<thead>
            				<tr>
            					<th>id</th>
            					<th>Nombre</th>
            					<th>Acciones</th>
            				</tr>
            			</thead>
                		<tbody>
                    		<tr v-for="cat in $page.props.categories" :key="cat.id">
                        		<td class="mb-1">{{ cat.id }}</td>
                        		<td class="mb-1">{{ cat.name }}</td>
                        		<td class="mb-1">
                    				<button class="view-cart bg-danger" href="javascript:void(0)" @click.prevent="cat_del(cat.id)">Eliminar</button>
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
   import Layout from '@/Layouts/LayoutProfile.vue'  
	import BreezeButton from '@/Components/Button.vue'
	import BreezeInput from '@/Components/Input.vue'
	import BreezeLabel from '@/Components/Label.vue'
	import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
	import { Head, Link } from '@inertiajs/inertia-vue3'

	export default {
    	components: {
        	BreezeButton,
        	BreezeInput,
        	BreezeLabel,
        	BreezeValidationErrors,
        	Head,
        	Link,
        	Layout,
	   	},
	   	data() {
        	return {
        		status: null,
            	form: this.$inertia.form({
                	category: null,
                	cat_del: null,
            	})
        	}
    	},
    	
    	methods: {
        	categories() {
            	this.form.post(route('categories.store'),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'categories',
                    preserveScroll: true,
                    preserveState: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(this.$page.props.flash.code == 200){
                            this.form.reset();
                            this.eraseFeatured();
                        };
                    }
                	
            	})
        	},
        	cat_del(cat){
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
  							this.$inertia.delete(route('categories.destroy',{categoria: cat}),
  							{
								preserveScroll: true,
  							})
  						}
					})
        	}
    	}
	}

</script>