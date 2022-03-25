<template>
	<section id="section">
		<div class="container cabeza">
			<div class="row titulo">
				<div class="col-12 p-3 p-md-5 text-center">
					<h1 class="text-info font-weight-bolder display-4">Gestor de colaboradores</h1>
				</div>
			</div>
			<div class="row justify-content-around opciones w-75 mx-auto align-items-center">
				<div class="col-12 col-md-4 my-2 my-md-0">
					<button class="btn btn-primary py-1 w-100 px-0">Agregar colaborador<i class="fas fa-plus px-3"></i></button>
				</div>
				<div class="col-12 col-md-4 my-2 my-md-0">
					<div class="input-search m-0">
						<span class="fa fa-search"></span>
						<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="search">
					</div>
				</div>
				<div class="col-12 col-md-4 pl-md-5 my-2 my-md-0 select-aloj">
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
			<div v-for="clbtr in colaboradores" :key="clbtr.id" class="row colaborador my-4 p-2 w-75 mx-auto bg-light">
				<div class="col-12 col-md-7">
					<h1 class="pt-1 pb-2 font-weight-bolder">{{clbtr.profile.firstname}}</h1>
				</div>
				<div class="col-12 col-md-5">
					<p class="font-weight-bolder text-muted mt-3">{{clbtr.email}}</p>
				</div>
				<div class="col-12">
					<div class="d-md-inline-flex mt-3">
						<p class="pr-md-4 font-weight-bolder text-muted text-md-center">Benefecio total <br> 0€</p>
						<p class="pr-md-4 font-weight-bolder text-muted text-md-center">Pedidos totales: <br>{{clbtr.orders }} </p>
						<p class="pr-md-4 font-weight-bolder text-muted text-md-center">Alojamientos registrados: <br> {{clbtr.lodgings}}</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
export default {
	layout:Layout,
	props: {
	collaborators: Object
	},
	data(){
		return{
			search:''
		}
	},
	computed:{
		datacol(){
			const obj = this.collaborators.data.map((col)=>{
				return {
					name : col.name,
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
	},
	methods:{
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
@media (max-width: 900px)
{
	.cabeza .titulo h1{
	 font-size: 2.5em;
}
}
</style>