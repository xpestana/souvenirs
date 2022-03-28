<template>
	<section id="section">
		<div class="container cabeza">
			<div class="row titulo">
				<div class="col-12 p-3 p-md-5 text-center">
					<h1 class="text-azulc font-weight-bolder display-4">Gestor de colaboradores</h1>
				</div>
			</div>
			<div class="row justify-content-around opciones w-75 mx-auto align-items-center">
				<div class="col-12 col-md-5 my-lg-2 my-md-0">
					<a type="button" class="btn btn-azulc text-white py-1 px-2 agregar" @click.prevent="createCollaborator" >Agregar colaborador<i class="fas fa-plus px-1 px-lg-3"></i></a>
				</div>
				<div class="col-12 col-md-4 my-2 my-md-0">
					<div class="input-search m-0">
						<span class="fa fa-search"></span>
						<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="search">
					</div>
				</div>
				<div class="col-12 col-md-3 pl-md-5 my-2 my-md-0 select-aloj">
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
			
				<div class="row colaborador my-4 p-2 w-75 mx-auto bg-light" v-for="clbtr in colaboradores" :key="clbtr.id">
					<Link  :href="route('admin.collaborator.show',clbtr.id)">
					<div class="col-12 col-md-7">
						<h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{clbtr.name}}</h1>
					</div>
					<div class="col-12 col-md-5">
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
								<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{clbtr.orders }}</p>
							</div>
							<div class="pr-md-4 text-md-center"> 
								<p class="font-weight-bolder text-muted d-inline d-md-block">Alojamientos registrados:</p>
								<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{clbtr.lodgings}}</p>
							</div>
						</div>
					</div>
					</Link>
				</div>
			
			<div class="row justify-content-center mb-3">
            	<div class="col-4">
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
	created(){
		console.log(this.collaborators.data);
	},
	data(){
		return{
			search:''
		}
	},
	methods:{
		createCollaborator(){
			this.$inertia.get(route('admin.collaborator.create'),{}, {
				preserveScroll: true
			})
		},
	},
	computed:{
		datacol(){
			const obj = this.collaborators.data.map((col)=>{
				return {
					id : col.id,
					name : col.profile == null ? 'Sin nombre' : col.profile.firstname,
					email : col.email,
					lodgings: col.hotel.length,
					hotel: col.hotel,
					orders: col.hotel.orders !== undefined ? clbtr.hotel.orders.length : 0,
				}
			});
			obj.sort(function (x, y) {
				if (x.name.toLowerCase() < y.name.toLowerCase()) {return -1;}
				if (x.name.toLowerCase() > y.name.toLowerCase()) {return 1;}
				return 0;
			});
			
			return obj;
		},
		colaboradores(){
			let filter1 = '';
			let filter2 = '';
			if(this.search != ''){
				return this.datacol.filter((col)=>{
					filter1 = col.name.toLowerCase().includes(this.search.toLowerCase());
					filter2 = col.email.toLowerCase().includes(this.search.toLowerCase());
					return (filter1 == true || filter2 == true) ? true : false;
				})
			}
			return this.datacol;
		}
	}
}
</script>
<style scoped>
.opciones .input-search span{
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
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
</style>