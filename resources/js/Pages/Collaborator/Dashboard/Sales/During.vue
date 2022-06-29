<template>
	<div id="dashboard-perfil-bank" class="container py-8 ml-2 md:ml-0 md:px-24">
	    <ModalCookies/>
	    <!-- HEADER -->
	    <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
	                <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
	                Ventas por inmueble
	            </h1>
	        </div>
	    </div>
	    <!--END Header-->
	    <div class="total-saldo row my-8 mx-1.5 lg:mx-0">
            <div class="col-12 col-lg-8 rounded-xl bg-collaborator-orange py-2.5">
                <div class="row justify-content-center">
                    <div class="pt-2 col-12 col-lg-6 text-center text-lg-left">
                        <h2 class="font-bold inline text-white text-base">Saldo pendiente: </h2><br class="lg:hidden">
                        <p class="inline text-white text-base">{{ (withdrawal*0.20).toFixed(2) }} €</p>
                    </div>
                    <div class="pt-0.5 col-12 col-lg-6 text-center text-lg-right">
                        <button class="btn bg-white text-orangec lg:ml-auto py-1 lg:mr-2.5 font-bold" @click="requestTransfer">Pedir transferencia</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center text-lg-left pt-2 pt-lg-0">
                <p class="pt-0.5"><b>Facturación total: </b>{{total}}€</p>
                <p class=""><b>Beneficio total: </b>{{(total*0.20).toFixed(2)}}€</p>
            </div>
        </div>
	    <!-- Filtro por fecha -->
	    <div class="row lg:mx-0 justify-content-start">
	    	<div class="col-12 ml-md-0 pl-md-0 col-md-3">
	    		<div class="md-form md-outline input-with-post-icon datepicker">
	    		  <label class="font-bold mb-1">Mostrar desde:</label>
				  <input
				  	v-model="form.from"
				  	placeholder="Select date"
				  	type="date"
				  	class="col-form-input w-100 rounded py-1.5"
				  	@change="validFilterProperty()"
				  >
				</div>
	    	</div>
	    	<div class="col-12 col-md-3 mt-2.5 mt-md-0">
	    		<div class="md-form md-outline input-with-post-icon datepicker">
	    			<label class="font-bold mb-1">Hasta:</label>
				  	<input
				  		v-model="form.to"
				  		placeholder="Select date"
				  		type="date" class="col-form-input w-100 rounded py-1.5"
				  		@change="validFilterProperty()"
				  	>
				</div>
	    	</div>
	    </div>
	    <!-- END Filtro por fecha -->
		<!-- table -->
		<div class="mt-3.5 row">
			<div class="col-12">
				<div class="table-responsive-sm">
		        	<table class="table table-striped">
					  <thead class="text-white text-sm text-center">
					    <tr id="tablep">
					      <th
					      	v-for="(item, key) in headerTable"
					    	:key="key"
					      	scope="col"
					      >
					  		{{ item.name }}
					  	  </th>
					    </tr>
					  </thead>
					  <tbody class="text-sm" id="tbody">
					    <tr
		 					v-for="(item, index) in filterOrders"
		 					:key="index"
		 					id="tablep"
					    >
					      <td class="text-center font-bold underline">{{ item.transactionId }}</td>
					      <td class="text-center">{{ item.alojamiento }}</td>
					      <td class="text-center">{{ item.tipoAloj }}</td>
					      <td class="text-center">{{ item.province }}</td>
					      <td class="text-center">{{ item.city }}</td>
					      <td class="text-center">{{ item.created_at }}</td>
					      <td class="text-center">{{ item.total }}€</td>
					      <td class="text-center">{{ item.beneficio }}€</td>
					    </tr>
					    <tr v-if="filterOrders.length < 1">
							<td colspan="8" class="text-center">No hay resultados para la busqueda</td>
						</tr>
					  </tbody>
					</table>
		        </div>
			</div>
		</div>
         <div class="ver-mas row my-2.5 justify-content-center">
        	<div class="col-11 col-md-8 col-lg-4 col-xl-6 text-center">
     			 <paginator :paginator="orders" />
     		</div> 
        </div>
        <!-- end table -->
        <!-- Modal Request -->
        <div class="modal modal-request fade" id="request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class="flex mt-3.5">
                            <img src="/vendor_asset/img/collaborator/dashboard/icons/dinero.svg" class="m-auto h-8"
                            style="filter: invert(53%) sepia(76%) saturate(625%) hue-rotate(354deg) brightness(107%) contrast(104%);"
                            >
                        </div>
                        <h2 class="text-lg text-center font-bold">¿Quieres solicitar el saldo disponible?</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            Envíanos una notificación y nos encargaremos de realizarte la transferencia alrededor
                            de unos 5 días hábiles.
                        </p>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" @click="sendNotification">Enviar notificación</button>
                        </div>
                        <div class="my-2.5 text-center">
                            <button class="btn rounded btn-outline-orange px-3.5 py-1 text-xs" data-dismiss="modal" aria-label="Close">No enviar todavia</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Request  -->
        <!-- Modal Notification -->
        <div class="modal modal-notification fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class="my-2.5 text-center">
                            <i class="far fa-check-circle text-orangec text-4xl"></i>
                        </div>
                        <h2 class="text-lg text-center font-bold">¡Notificación recibida!</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            La transferencia se realizará en 5 días habiles. Para cualquier
                            consulta ponte en contacto con nosotros.
                        </p>
                        <div class="my-3.5 text-center">
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Notification  -->
        <!-- Modal Notice -->
        <div class="modal modal-notice fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class="flex mt-3.5">
                            <img src="/vendor_asset/img/collaborator/dashboard/icons/dinero.svg" class="m-auto h-8"
                            style="filter: invert(53%) sepia(76%) saturate(625%) hue-rotate(354deg) brightness(107%) contrast(104%);"
                            >
                        </div>
                        <h2 class="text-lg text-center font-bold">Te faltan</h2>
                        <h3 class="text-lg text-center my-0.5">
                            <span class="text-4xl text-orangec font-bold">{{remainingDays}}</span> 
                            <template v-if="Number(this.remainingDays)>1">
                                días
                            </template>
                            <template v-else>
                                dia
                            </template>
                            
                        </h3>
                        <h2 class="text-lg text-center font-bold">para poder solicitar una transferencia de saldo</h2>
                        <p class="px-4 my-2 text-xs text-center">
                            Puedes solicitar una transferencia de saldo cada 3 meses.
                        </p>
                        <div class="my-3.5 text-center">
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Notice  -->
    </div>
</template>

<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
	import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
	import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
	import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
	import Paginator from '@/Components/Paginator.vue'
	import moment from 'moment'
	export default {
		layout:TemplateApp,
	    components:{
	        Head,
	        Link,
	        ModalCookies,
	        Paginator,
	    },
	    props:{
	        hotels:Object,
	        orders:Object,
	        date:String,
	    },
	    data () {
	    	return {
	    		form: this.$inertia.form({
					from: null,
					to: null
				}),
	    		headerTable:[
	    			{name:'ID Transacción'},
	    			{name:'Alojamiento'},
	    			{name:'Tipo Aloj.'},
	    			{name:'Provincia'},
	    			{name:'Ciudad'},
	    			{name:'Fecha'},
	    			{name:'Facturación'},
	    			{name:'Beneficio'},
	    		],
	    		page:this.$page.url.split('?page=')[1] == undefined ? 1 : this.$page.url.split('?page=')[1],
	    		showPagination: false,
	    		total:0,
            	withdrawal:0,
            	dateTEST:this.date,
	            countTest:0,
	            remainingDays:null,
	    	}
	    },
	    computed:{
	    	filterOrders () {
	    		const map = this.orders.data.map(item =>{
	    			var total = parseInt(item.total).toFixed(2);
	    			var beneficio = (total * 0.2).toFixed(2);
	    			return {
	    				transactionId: item.transaction_id,
	    				created_at: moment(item.created_at).format("DD/MM/YYYY"),
	    				total: total,
	    				beneficio: beneficio,
	    				city: 'Sevilla',
	    				province:  item.shippings.length > 0 ? item.shippings[0].city : '',
	    				alojamiento: item.hotel.address,
	    				tipoAloj: item.hotel.type,
	    			}
	    		})
	    		return map
	    	},
	    },
	    created () {
	        this.orders.data.forEach(order =>{
	            this.total += Number(order.total);
	            if (order.withdrawal == 0) {
	                this.withdrawal += Number(order.total);    
	            }
    		});
	    },
	    mounted(){
			this.busqueda()
		},
	    methods: {
	    	busqueda(){
				let queryFrom = this.$page.url.split("from=","2")[1];
				let queryTo = this.$page.url.split("to=","2")[1];
				if(queryFrom !== undefined ){
	                let limpioFrom = queryFrom.slice(0,10)
					this.form.from = limpioFrom
				}
				if(queryTo !== undefined ){
	                let limpioTo = queryTo.slice(0,10)
					this.form.to = limpioTo
				}
			},
	    	validFilterProperty() {
	    		if (this.form.to && this.form.from) {
					if (moment(this.form.to).isAfter(this.form.from)) {
						this.submitDuring()
					} else {
						this.$swal({
	                        title: 'Intervalo de fechas incorrecto',
	                        icon: 'info',
	                        showCloseButton: false,
	                        showCancelButton: false,
	                        focusConfirm: false,
	                        confirmButtonText:
	                            '<i class="fa fa-thumbs-up"></i> Aceptar!',
	                        confirmButtonAriaLabel: 'Aceptar!',
	                    })
					}
				} else {
					this.submitDuring()
				}
			},
			requestTransfer(){
	            let dia = Number(moment(this.dateTEST).format("DD"));
	            let mes = Number(moment(this.dateTEST).format("MM"));
	            let año = Number(moment(this.dateTEST).format("YYYY"));
	            let ago = moment().diff(moment([año,(mes - 1),(dia)]),'days');
	            this.remainingDays = 90 - ago;
	            if(Number(ago) > 90){
	                $('#request').modal('show')
	            }else{
	                $('#notice').modal('show')
	            }
	        },
	        sendNotification(){
	            let request=$('#request');
	            let noti=$('#notification');
	            this.$inertia.post(route('collaborator.notify'),{
	                onSuccess: (page) => {
	                    request.modal('hide')
	                    noti.modal('show')
	                },
	            })
	        },
			submitDuring () {
				this.orders.data = [];
				/*let nodos = document.getElementById('tbody').childNodes.length;
				if(nodos == 3 || nodos > 4){
					let tr =`<tr><td colspan="8">
						<div class="spinner-border text-info text-center" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</td></tr>`
					document.getElementById('tbody').insertAdjacentHTML("afterbegin",tr);
				}*/
				setTimeout(()=>{
					this.form.get(this.route('collaborator.sales.inmueble'), {
						preserveScroll: true,
					});
				},1500);
			},
			goBack () {
	            window.history.back()
	        },
	    },
	}
</script>
<style lang="scss" scoped>
	.table-striped>tbody>tr:nth-child(odd)>td, 
 	.table-striped>tbody>tr:nth-child(odd)>th {
       background-color: #d4f0ff;
    }
    .table-striped>tbody>tr:nth-child(even)>td, 
    .table-striped>tbody>tr:nth-child(even)>th {
       background-color: #ffeacb;
    }
    .table-striped>thead>tr>th {
       background-color: #86bcd9;
    }
    table > tbody > tr >td, table > tbody > tr >th,
    table > thead > tr >td, table > thead > tr >th{
    	border-left: 2px solid #4d778e !important;
    	border-right: 2px solid #4d778e !important;
    	border-top: none !important;
    	border-bottom: none !important;
    	vertical-align:middle;
    }
    #tablep td, #tablep th{
    	width: 130px;
    	overflow: auto;
    }
    table{
    	display: block;
    	overflow-x: auto;
    	white-space: nowrap;
    }
</style>