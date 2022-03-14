<template>
	<Layout>
	<div class="tab-content dashboard-content mt-all-40">
    	<div id="hotels" class="tab-pane fade show active">
   				<div class="row">
   					<div class="col-md-6">
   						<h3>Gestión de ryders</h3>	
   					</div>
    				<div align="center" class="col-md-6 mb-3">
    					<div class="d-single-info text-lg-center">
                               <Link class="view-cart bg-info" :href="route('ryders.create')">Agregar Ryder</Link>
                        </div>
    				</div> 
    			</div>
    			<template v-if="users.data.length > 0">
    			<div class="table-responsive">
            		<table class="table table-striped table-bordered table-hover">
            			<thead>
            				<tr>
            					<th>Nombre</th>
            					<th>Apellido</th>
            					<th>Genero</th>
            					<th>Dirección de correo</th>
            					<th>Dirección de habitacion</th>
            					<th>Acciones</th>
            				</tr>
            			</thead>
                		<tbody>
                    		<tr v-for="user in users.data" :key="user.id">
                        		
                        		<td class="mb-1">{{ user.profile.firstname }}</td>
                        		<td class="mb-1">{{ user.profile.lastname }}</td>
                        		<td class="mb-1">{{ user.profile.gender }}</td>
                        		<td class="mb-1">{{ user.email }}</td>
                        		<td class="mb-1">{{ user.profile.ryder.address }}</td>
                        		<td class="mb-1">
                        			<Link class="view-cart bg-secundary ml-2" :href="route('ryders.edit',{ryder: user.id})" title="Ver Hotel"> Editar </Link>
                    				<button class="view-cart bg-danger ml-2" title="eliminar hotel" @click="deleteUser(user.id)"> Eliminar </button>
                        		</td>
                    		</tr>
                		</tbody>
            		</table>
            		<div class="row justify-content-center mb-3">
                    	<div class="col-9">
                        	<paginator :paginator="users"/>
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
    	props: {
        	users: Object,
    	},
    	methods: {
        	deleteUser(user){
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
  							this.$inertia.delete(route('admin.destroy',{admin : user}),
  							{
								preserveScroll: true,
  							})
  						}
					})
            	
        	}
    	}
	}

</script>