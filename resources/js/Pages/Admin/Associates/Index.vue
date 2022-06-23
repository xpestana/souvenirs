<template>
	<section id="section">
		<div class="container cabeza">
			<div class="row titulo">
				<div class="col-12 p-3 p-md-5 text-center">
					<h1 class="text-azulc font-weight-bolder display-4">Gestor de asociados</h1>
				</div>
			</div>
			<div class="row justify-content-start opciones w-75 mx-auto align-items-center">
				<div class="col-12 col-md-5 col-lg-5 my-lg-2 my-md-0 my-2 px-0">
					<a type="button" class="btn btn-azulc text-white py-1 px-xl-2 agregar" @click.prevent="createCollaborator" >Agregar asociado<i class="fas fa-plus px-1 px-lg-3"></i></a>
				</div>
				<div class="col-12 col-md-4 col-lg-4 my-lg-2 my-md-0 my-2 px-0">
					<div class="input-search m-0">
						<span class="fa fa-search text-muted position-absolute d-block text-center"></span>
						<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="formSearch.search" @keyup.prevent="search">
					</div>
				</div>
				<!-- <div class="col-12 col-md-3 col-lg-3 pl-md-5 my-lg-2 my-md-0 my-2 px-0 select-aloj">
					<div class="dropdown">
						<button class="text-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Alojamiento
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" type="button" @click="tipo('hotel')">Hotel</a>
							<a class="dropdown-item" type="button" @click="tipo('apartamento')">Apartamento</a>
						</div>
					</div>
				</div> -->
			</div>
			</div>
		<div class="container px-0 cuerpo">
            <div v-for="clbtr in colaboradores" :key="clbtr.id">
                <div class="row colaborador my-4 p-2 w-75 mx-auto bg-light justify-content-center justify-content-md-between" >
                    <div class="col-10 col-md-6">
                        <Link :href="route('admin.associates.show',clbtr.id)">
                        <h1 class="font-weight-bolder text-center text-md-left">{{clbtr.firstname}} </h1>
                        </Link>
                    </div>
                    <div class="col-10 col-md-6">
                        <p class="font-weight-bolder text-muted mt-3 text-center text-md-left">{{clbtr.email}}</p>
                    </div>
                    <div class="col-12">
                        <div class="d-md-inline-flex mt-3 pb-2 pb-md-0">
                            <div class="pr-md-4 text-md-center">
                                <p class="font-weight-bolder text-muted d-inline d-md-block">Beneficio total</p> 
                                <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{calcularBeneficio(clbtr.orders)}}€</p>
                            </div>
                            <div class="pr-md-4 text-md-center"> 
                                <p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
                                <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{clbtr.orders.length }}</p>
                            </div>
                            <div class="pr-md-4 text-md-center"> 
                                <p class="font-weight-bolder text-muted d-inline d-md-block">Actividades registradas:</p>
                                <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">0</p>
                            </div>
                            <div class="pr-md-4 text-md-center pt-1"> 
                                <a href="#" class="text-primary px-md-2" data-toggle="modal" :data-target="'#colaborador'+clbtr.id">Obtener QR</a>
                                <!-- Central Modal Small -->
                                <div class="modal fade" :id="'colaborador'+clbtr.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                                            :imgclass="'souvenirs_img'+clbtr.id"
                                                            style="max-width: 50%;"
                                                            :value="url+'?c='+clbtr.id"
                                                            :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                                                            :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                                                            :dotsOptions="{
                                                                type: 'square',
                                                                color: '#31516B',
                                                                gradient: {
                                                                type: 'linear',
                                                                rotation: 0,
                                                                colorStops: [
                                                                    { offset: 0, color: '#B4CEE2' },
                                                                    { offset: 1, color: '#B4CEE2' },
                                                                ],
                                                            },
                                                            }"
                                                            fileExt="png"
                                                            :backgroundOptions="{ color: '#ffffff' }"
                                                            :cornersSquareOptions="{ type: 'dot', color: '#B4CEE2' }"
                                                            :cornersDotOptions="{ type: undefined, color: '#B4CEE2' }"
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
                                                        <a  class="bnt btn-azulc text-white rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(clbtr.id,clbtr.firstname)">Descargar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Central Modal Small -->
                            </div>
                            <div class="pr-md-4 text-md-center"> 
                                <p class="text-muted d-inline d-md-block pl-md-2 pl-md-0">{{clbtr.city}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="row justify-content-center mt-5" v-if="collaborators.data.length <= 0">
				<div class="col-4 text-center">
					<h3 class="text-muted">No existen resultados</h3>
				</div>
			</div>
			<div class="row justify-content-center mb-3" v-if="collaborators.data.length > 0">
            	<div class="col-10 col-sm-6 col-lg-4 px-0 pb-4 pt-2 paginate_scroll">
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
import QRCodeVue3 from "qrcode-vue3"
export default {
	layout:Layout, 
	components: {
		Paginator,
		Link,
        QRCodeVue3
	},
	props: {
	collaborators: Object,
    url:String
	},
    created(){
		this.busqueda()
		console.log(this.collaborators)
	},
	computed:{
            colaboradores(){
            const obj = this.collaborators.data.map((col)=>{
                var total_orders = 0;
                
            return {
                id : col.id,
                firstname: col.firstname,
                email: col.email,
				orders: col.orders,
                city: col.city,
            }
            });
            return obj;
        },
        },
	data(){
		return{
			formSearch: this.$inertia.form({
				search: null,
			}),
			total:0
		}
	},
	methods:{
        souvenirs_btn(id,collaborator){
            var urlItem = $('.souvenirs_img'+id).attr('src');
            axios({
                    url: urlItem,
                    method: 'GET',
                    responseType: 'blob'
                })
                .then((response) => {
                        const url = window.URL
                            .createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', `${collaborator}.png`);
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                })                
            },
		busqueda(){
			let input = this.$page.url.split("?search=","2")[1];
			if(input !== undefined){
				this.formSearch.search = input;	
			}
		},
		createCollaborator(){
			this.$inertia.get(route('admin.associates.create'),{}, {
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
				this.formSearch.get(this.route('admin.associates'), {
					preserveScroll: true,
				});
			},1500);
		},
		calcularBeneficio(orders){
            var total_benefits = 0;
            if(orders.length > 0){
                orders.forEach(function(order) {
                    total_benefits = parseInt(total_benefits)  + parseInt(order.total);
                });
                
                return (total_benefits*0.20).toFixed(2);
            }
            return 0;
				
			
			// if(obj.length > 0){
			// 	let beneficio = 0;
			// 	for(let val in obj){
			// 		beneficio = beneficio + Number(obj[val].total_benefits);
			// 	}
			// 	return beneficio;
			// }
			// return 0;
		}
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
.cuerpo .colaborador h1:hover{
    color:#65b4ce;
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