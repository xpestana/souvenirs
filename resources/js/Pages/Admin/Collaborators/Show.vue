<template>
	
	<div class="container px-lg-5 mt-4">	
		<section id="colaborador">
			<div class="row">
				<div class="col-3 ">
					<Link :href="route('admin.colaboradores')"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
				</div>
			</div>
			<div class="row ficha mx-lg-4 my-4 p-2 bg-light border">
				<div class="col-12 col-md-9">
					<div class="d-flex justify-content-between w-75">
						<h1 class="pt-1 pb-2 font-weight-bolder">{{collaborator.profile.firstname}}</h1>
						<p class="font-weight-bolder text-muted mt-3">{{collaborator.email}}</p>
					</div>
					<div class="d-md-inline-flex mt-1">
						<p class="pr-md-5 font-weight-bolder text-muted text-md-center">Benefecio total <br> 0€</p>
						<p class="pr-md-5 font-weight-bolder text-muted text-md-center">Pedidos totales: <br></p>
						<p class="pr-md-5 font-weight-bolder text-muted text-md-center">Alojamientos registrados:<br>{{collaborator.hotel.length}}</p>
					</div>
				</div>
				<div class="col-12 col-md-3 text-right mt-5">
					<button class="btn btn-sm btn-secondary py-0 px-2 mt-3 px-4">Editar</button>
				</div>
			</div>
		</section>
		<section id="info">
			<div class="row justify-content-lg-between mx-lg-4 mt-md-5 align-items-end">
				<div class="col-12 col-md-12 col-lg-5 col-xl-6 my-2 my-md-0">
					<a type="button" class="btn btn-primary px-2 px-md-4 py-1">Añadir apartamento<i class="fas fa-plus pl-2"></i></a>
					<h5 class="text-info mt-1 p-1 font-weight-bolder"><Link href="#">Ventas totales<i class="fas fa-angle-right p-1"></i></Link></h5>
				</div>
				<div class="col-12 col-md-5 col-lg-4 col-xl-3  my-1 my-md-0">
					<h4 class="text-info font-weight-bolder pl-0 pl-xl-4">Total</h4><br>
					<h4 class="font-weight-bolder pl-0 pl-xl-4">Beneficio 334€</h4><br>
				</div>
				<div class="col-12 col-md-4 col-lg-3 col-xl-3">
					<h4 class="font-weight-bolder">Pedidos 15</h4><br>
				</div>
			</div>
		</section>
	</div>
	<div class="container px-lg-5">
		<section id="alojamientos">
			<div v-for="hotel in collaborator.hotel" :key="hotel.id" class="row tarjeta my-4 p-3 mx-lg-4 ">
				<div class="col-12 col-md-2 p-0">
					<img class="img-foto w-100" :src="'/storage/hotel/'+hotel.image" >
				</div>
				<div class="col-12 col-md-8 texto">
					<p class="text-muted text-uppercase">{{hotel.type}}</p>
					<h1 class="pb-3 pt-1 font-weight-bolder">{{hotel.calle}} {{hotel.planta}}</h1>
					<div class="d-md-inline-flex">
						<p class="pr-md-2 font-weight-bolder text-muted">Benefecio total 334€</p>
						<p class="pl-md-2 pr-md-3 font-weight-bolder text-muted">Pedidos totales: 8</p>
						<button class="btn btn-link p-0" data-toggle="modal" data-target="#centralModal">Obtener QR</button>
					</div>
				</div>
				<div class="col-12 col-md-2 p-0 mt-auto px-auto text-center">
					<Link href="#" class="btn btn-sm btn-info w-75 my-1 py-0 text-white">Ver más</Link>
					<Link  :href="route('admin.collaborator.lodging.edit')" class="btn btn-sm btn-secondary w-75 py-0">Editar</Link>
				</div>
			</div>
		</section>	
	</div>  
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
export default {
	layout:Layout,
	components:{
		Link
	},
	props: {
		collaborator: Object
	},
}
</script>
<style scoped>
#colaborador .ficha h1{
	font-size: 30px;
}
#colaborador .ficha{
	border: 1px solid #d5d5d5;
}
#info h4{
    line-height: 0.5;
    font-size: 1.7em;
}
#alojamientos .tarjeta{
    box-shadow: 1px 1px 3px 3px rgba(0 0 0 / 20%);
}
#alojamientos .tarjeta .img-foto{
    max-height: 100px;
}
#alojamientos .tarjeta h1{
	font-size: 20px;
}
@media (max-width:767px)
{
	#alojamientos .tarjeta img{
		min-height: 210px;
	}
}
</style>