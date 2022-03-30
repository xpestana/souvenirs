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
					<div class="d-flex flex-column flex-md-row justify-content-between">
						<h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{ collaborator.profile.firstname}}</h1>
						<p class="font-weight-bolder text-muted mt-md-3 text-center text-md-left">{{collaborator.email}}</p>
					</div>
					<div class="d-md-inline-flex mt-1">
						<div class="pr-md-4 text-md-center">
							<p class="font-weight-bolder text-muted d-inline d-md-block">Benefecio total</p> 
							<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">0€</p>
						</div>
						<div class="pr-md-4 text-md-center"> 
							<p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
							<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">0</p>
						</div>
						<div class="pr-md-4 text-md-center"> 
							<p class="font-weight-bolder text-muted d-inline d-md-block">Alojamientos registrados:</p>
							<p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{collaborator.hotel.length}}</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3 text-right mt-5">
					<Link :href="route('admin.collaborator.edit',collaborator.id)" class="btn btn-sm btn-secondary py-0 px-2 mt-3 px-4">Editar</Link>
				</div>
			</div>
		</section>
		<section id="info">
			<div class="row justify-content-lg-between mx-lg-4 mt-md-5 align-items-end">
				<div class="col-12 col-md-12 col-lg-5 col-xl-6 my-2 my-md-0">
					<a type="button" class="btn btn-azulc text-white px-2 px-md-4 py-1">Añadir apartamento<i class="fas fa-plus pl-2"></i></a>
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
						<button class="btn btn-link p-0" data-toggle="modal" :data-target="'#modalLodging'+hotel.id">Obtener QR</button>
                                            <!-- Central Modal Small -->
						<div class="modal fade" :id="'modalLodging'+hotel.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
						aria-hidden="true">
						<!-- Change class .modal-sm to change the size of the modal -->
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content mx-auto">
									<div class="modal-body p-0">
										<div class="row mt-5 mb-2">
											<div class="col-12 my-4 d-flex justify-content-center">
												<QRCodeVue3
													:width="1080"
													:height="1080"
													style="max-width: 50%;"
													:imgclass="'souvenirs_img'+hotel.id"
													:value="url+'?h='+hotel.id"
													:qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
													:imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
													:dotsOptions="{
														type: 'square',
														color: '#31516B',
														gradient: {
														type: 'linear',
														rotation: 0,
														colorStops: [
															{ offset: 0, color: '#31516B' },
															{ offset: 1, color: '#31516B' },
														],
													},
													}"
													fileExt="png"
													:backgroundOptions="{ color: '#ffffff' }"
													:cornersSquareOptions="{ type: 'dot', color: '#6cb2eb' }"
													:cornersDotOptions="{ type: undefined, color: '#6cb2eb' }"
													:download="false"
													downloadButton="bg-info mt-3 souvenirs_btn"
													:downloadOptions="{ name: 'souvenirs', extension: 'png' }"
													crossOrigin="anonymous"
												/>
											</div>
										</div>
										<div class="row px-3 py-4 mb-3">
											<div class="col-6 text-left">
												<a class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" href="#" data-dismiss="modal" >Volver</a>
											</div>
											<div class="col-6 text-right">
												<a class="bnt btn-primary-c text-white rounded-pill px-2 px-md-5 py-1" href="javascript:void(0)" @click="souvenirs_btn(hotel.id,hotel.calle+'-'+hotel.planta)">Descargar</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Central Modal Small -->
					</div>
				</div>
				<div class="col-12 col-md-2 p-0 mt-auto px-auto text-center">
					<Link href="#" class="btn btn-sm btn-info w-75 my-1 py-0 text-white">Ver más</Link>
					<Link  :href="route('admin.lodging.edit',[hotel.id,collaborator.id])" class="btn btn-sm btn-secondary w-75 py-0">Editar</Link>
				</div>
			</div>
			<div class="text-center mt-5" v-if="collaborator.hotel.length == 0">
				<h1 class="text-muted font-font-weight-bolder pb-5">No hay alojamientos registrados para este usuario</h1>
			</div>
		</section>	
	</div>  
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import QRCodeVue3 from "qrcode-vue3"
export default {
	layout:Layout,
	components:{
		Link,
		QRCodeVue3
	},
	props: {
		collaborator: Object,
		url:String
	},
	methods:{
		souvenirs_btn(id,lodging){
		var urlItem = $('.souvenirs_img'+id).attr('src');
		axios({
				url: urlItem,
				method: 'GET',
				responseType: 'blob'
			})
			.then((response) => {
					const url = window.URL
						.createObjectURL(new Blob([response.data]));
					console.log(url);
					const link = document.createElement('a');
					link.href = url;
					link.setAttribute('download',`lodging:${lodging}.png`);
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
			})                
		}
	}
}
</script>
<style scoped>
.modal-content {
    width: 100% !important;
}
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