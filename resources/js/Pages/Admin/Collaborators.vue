<template>
	<section id="section">
		<div class="container cabeza">
			<div class="row titulo">
				<div class="col-12 p-3 p-md-5 text-center">
					<h1 class="text-azulc font-weight-bolder display-4">Gestor de colaboradores</h1>
				</div>
			</div>
			<div class="row justify-content-around opciones w-75 mx-auto align-items-center">
				<div class="col-12 col-md-5 col-lg-5 my-lg-2 my-md-0 my-2 px-0">
					<a type="button" class="btn btn-azulc text-white py-1 px-xl-2 agregar" @click.prevent="createCollaborator" >Agregar colaborador<i class="fas fa-plus px-1 px-lg-3"></i></a>
				</div>
				<div class="col-12 col-md-4 col-lg-4 my-lg-2 my-md-0 my-2 px-0">
					<div class="input-search m-0">
						<span class="fa fa-search text-muted position-absolute d-block text-center"></span>
						<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="formSearch.search" @keyup.prevent="search">
					</div>
				</div>
				<div class="col-12 col-md-3 col-lg-3 pl-md-5 my-lg-2 my-md-0 my-2 px-0 select-aloj">
					<div class="dropdown">
						<button class="text-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Alojamiento
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" type="button" @click="tipo('hotel')">Hotel</a>
							<a class="dropdown-item" type="button" @click="tipo('apartamento')">Apartamento</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		<div class="container px-0 cuerpo">
				<Link v-for="clbtr in colaboradores" :key="clbtr.id" :href="route('admin.collaborator.show',clbtr.id)">
				<div class="row colaborador my-4 p-2 w-75 mx-auto bg-light justify-content-center justify-content-md-between" >
					<div class="col-10 col-md-6">
						<h1 class="font-weight-bolder text-center text-md-left">{{clbtr.firstname}} </h1>
					</div>
					<div class="col-10 col-md-6">
						<p class="font-weight-bolder text-muted mt-3 text-center text-md-left">{{clbtr.email}}</p>
					</div>
					<div class="col-12">
						<div class="d-md-inline-flex mt-3 pb-2 pb-md-0">
							<div class="pr-md-4 text-md-center">
								<p class="font-weight-bolder text-muted d-inline d-md-block">Benefecio total</p> 
								<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">0€</p>
							</div>
							<div class="pr-md-4 text-md-center"> 
								<p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
								<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{clbtr.total_orders }}</p>
							</div>
							<div class="pr-md-4 text-md-center"> 
								<p class="font-weight-bolder text-muted d-inline d-md-block">Alojamientos registrados:</p>
								<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{clbtr.lodgings}}</p>
							</div>
						</div>
					</div>
				</div>
				</Link>
			
			<div class="row justify-content-center mt-5" v-if="collaborators.data.length <= 0">
				<div class="col-4 text-center">
					<h3 class="text-muted">No existen resultados</h3>
				</div>
			</div>
			<div class="row justify-content-center mb-3" v-if="collaborators.data.length > 0">
            	<div class="col-10 col-sm-6 col-lg-4 px-0 py-4 paginate_scroll">
                	<paginator :paginator="collaborators"/>
                </div>
            </div>
		</div>
	</section>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
	layout:Layout,
	components: {
		Paginator,
		Link
	},
	props: {
	collaborators: Object
	},
	computed:{
            colaboradores(){
            const obj = this.collaborators.data.map((col)=>{
                var total_orders = 0;
                col.hotel.forEach(function(hotel) {
                    total_orders = total_orders + hotel.orders.length;
                });
                
            return {
                id : col.id,
                firstname: col.firstname,
                email: col.email,
                lodgings : col.hotel.length,
                total_orders : total_orders
            }
            });
            return obj;
        },

        },
	mounted(){
		this.busqueda()
		console.log(this.collaborators)
	},
	data(){
		return{
			formSearch: this.$inertia.form({
				search: null,
			}),
		}
	},
	methods:{
		busqueda(){
			let input = this.$page.url.split("?search=","2")[1];
			if(input !== undefined){
				this.formSearch.search = input;	
			}
		},
		createCollaborator(){
			this.$inertia.get(route('admin.collaborator.create'),{}, {
				preserveScroll: true
			})
		},
		search() {
			this.collaborators.data = {};
				let template =`
					<div class="row mt-5 justify-content-center">
						<div class="col-4 text-center">
							<div class="spinner-border text-info" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>
					`
				$('.cuerpo').html(template);
			setTimeout(()=>{
				this.formSearch.get(this.route('admin.colaboradores'), {
					preserveScroll: true,
				});
			},1500);
		},
	}
}
</script>
<style scoped>
.opciones .input-search span{
    z-index: 2;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    pointer-events: none;
}
.opciones .form-control{
	border: 1px solid #dedede;
	height: 2.3em;
	padding-left:2.3em;
}
.opciones .form-control:hover{
	border: 1px solid #b3b3b3;
}
.opciones .dropdown button{
	font-size: 23px;
}
.cuerpo .colaborador{
    box-shadow: 1px 1px 3px 3px rgba(0 0 0 / 20%);
}
.cuerpo .colaborador h1{
    font-size: 30px;
}
.cabeza .agregar{
	font-size: 17px;
}
@media (max-width: 900px)
{
	.cabeza .titulo h1{
	 font-size: 2.5em;
	}
}
@media (max-width: 1025px)
{
	#section .row{
	 width: 100% !important;
	}
}
@media (max-width: 800px){
        .paginate_scroll{
            overflow-x: scroll;
        }
    }
</style>