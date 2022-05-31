<template>
	<div class="container px-lg-5 mt-4">	
		<section id="colaborador">
			<div class="row">
				<div class="col-3 ">
					<Link :href="route('admin.associates')"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
				</div>
			</div>
			<div class="row ficha mx-lg-4 my-4 p-2 bg-light border">
                <div class="col-12 d-md-flex justify-content-md-between">
                    <div class="">
						<h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{ collaborator.profile.firstname}}</h1>	
					</div>
                    <div class="mt-md-3 d-flex flex-column flex-md-row justify-content-center justify-content-md-between">
                        <p class="font-weight-bolder text-muted mt-md-3 d-md-inline mx-auto mx-md-4">{{collaborator.email}}</p>
                        <Link :href="route('admin.associates.edit',collaborator.id)" class="btn btn-sm btn-secondary py-0 px-4 mt-2 mt-md-3 mx-auto">Editar</Link>
                    </div>
				</div>
				<div class="col-12 d-md-inline-flex mt-1">
                    <div class="pr-md-4 text-md-center">
                        <p class="font-weight-bolder text-muted d-inline d-md-block">Benefecio total</p> 
                        <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ total }}€</p>
                    </div>
                    <div class="pr-md-4 text-md-center"> 
                        <p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
                        <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ orders }}</p>
                    </div>
                    <div class="pr-md-4 text-md-center"> 
                        <p class="font-weight-bolder text-muted d-inline d-md-block">Actividades registrados:</p>
                        <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{collaborator.hotel.length}}</p>
                    </div>
                    <div class="pr-md-4 text-md-center pt-1"> 
                            <a href="#" class="text-primary px-md-2" data-toggle="modal" :data-target="'#colaborador'+collaborator.id">Obtener QR</a>
                            <!-- Central Modal Small -->
                            <div class="modal fade" :id="'colaborador'+collaborator.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                                        :imgclass="'souvenirs_img'+collaborator.id"
                                                        style="max-width: 50%;"
                                                        :value="url+'?c='+collaborator.id"
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
                                                        downloadButton="view-cart bg-info mt-3 souvenirs_btn"
                                                        :downloadOptions="{ name: 'souvenirs', extension: 'png' }"
                                                        crossOrigin="anonymous"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row px-3 pt-4 pb-5">
                                                <div class="col-6 text-left">
                                                    <a class="bnt btn-azulc text-white rounded-pill px-4 py-1" href="#" data-dismiss="modal" >Volver</a>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <a  class="bnt btn-azulc text-white rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(collaborator.id,collaborator.profile.firstname)">Descargar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Central Modal Small -->
                    </div>
                    <div class="pr-md-4 text-md-center"> 
                        <p class="text-muted d-inline d-md-block pl-md-2 pl-md-0">{{collaborator.profile.city}}</p>
                    </div>
				</div>
			</div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button class="btn btn-lg btn-outline-azulc d-md-inline px-5 py-1">
                        Colaborador
                    </button>
                    <button class="btn btn-lg btn-xl btn-outline-secondary d-md-inline ml-md-1 py-1 mt-2 mt-md-0">
                        Prestador de servicios
                    </button>
                </div>
            </div>
		</section>
	</div>
	<div class="container mt-5 px-0 px-md-4">
		<section id="tabla">
        <div class="row cabeza mx-lg-4">
                <div class="col-12">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-3xl"><strong>Ventas de colaboración</strong></h1>
                </div>
            </div>
            <div class="row cuerpo mx-lg-4 mt-md-2">
                <div class="col-12 px-md-0">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center" scope="col">ID transacción</th>
                                    <th class="text-center" scope="col">Devuelto</th>
                                    <th class="text-center" scope="col">Correo</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Beneficio</th>
                                    <th class="text-center" scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr v-if="shippings.length == 0">
                                    <td colspan="6" class="text-center">Propiedad sin ventas relacionadas</td>
                                </tr> -->
                                <tr>
                                    <td class="text-center">transaction_id</td>
                                    <td class="text-center p-0">
                                        <!-- <template v-if="order.returned == 1"> -->
                                            <select class="rounded py-1 mt-2" name="returned" id="returned">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        <!-- </template>
                                        <template v-else>
                                            <select class="rounded py-1 mt-2" name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template> -->
                                    </td>
                                    <td class="text-center">email</td> 
                                    <td class="text-center">Fecha</td>
                                    <td class="text-center">100€</td>
                                    <td class="text-center px-0">
                                        <Link href="#" 
                                            class="btn btn-sm text-white d-inline p-0.5 mx-0" as="button" 
                                            style="background-color: #2b59a2">
                                            Más detalles
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-lg-4 pie justify-content-end my-4">
                <div class="col-12 col-md-4">
                    <h2 class="text-azulc text-2xl font-weight-bolder">Total</h2>
                    <p><b>Tu beneficio es de 100€</b></p>
                </div>
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
	data(){
            return{
                total: 0,
                orders: 0
            }
        },
	computed:{
            hoteles(){
            const obj = this.collaborator.hotel.map((col)=>{
                var total_orders = 0;
                var total_benefits = 0;
				this.orders = this.orders + col.orders.length;
				col.orders.forEach(function(order) {
                    total_benefits = parseInt(total_benefits)  + parseInt(order.total);
                });
                this.total = this.total + (total_benefits/100)
            return {
                id : col.id,
                calle: col.calle,
                planta: col.planta,
                image : col.image,
                type : col.type,
                total_orders : col.orders.length,
                total_benefits: total_benefits/100
            }
            });
            return obj;
        },

        },
	created(){
		console.log(this.collaborator);
	},
	methods:{
		souvenirs_btn(id,name){
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
					link.setAttribute('download',`${name}.png`);
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