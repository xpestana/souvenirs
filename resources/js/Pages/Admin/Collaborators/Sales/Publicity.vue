<template>
	<div id="dashboard-perfil-bank" class="container py-8 ml-2 md:ml-0 md:px-24">
	    <!-- HEADER -->
	    <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
	               	<i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
	                Ventas por publicidad
	            </h1>
	        </div>
	    </div>
	    <!--END Header-->
		<!-- MIGA DE PAN -->
		<div class="header row mx-1.5 lg:mx-0 py-3">
            <div class="col-12 text-left px-0">
                <p class="text-gray-500">Gestión de anfitriones / {{user.profile.firstname}} / <b>Ventas por totales</b></p>
            </div>
        </div>
		<!-- END MIGA DE PAN -->
	    <div class="total-saldo lg:flex mt-2 mb-8 mx-1.5 lg:mx-0">
            <div class="rounded-xl w-55 bg-collaborator-grey py-2.5 px-2 lg:mr-4">
                <div class="flex">
                    <div class="">
                        <Link
                            :href="route('admin.collaborator.sales-total', {id: user.id})"
                            class="btn  bg-collaborator-grey ml-auto py-1 mr-2.5 font-bold"
                            :class="filterUrl ==`/admin/colaborador/${user.id}/ventas-totales` ? 'bg-collaborator-orange text-white shadow' : 'text-muted'"
                        >
                            Ventas totales
                        </Link>
                    </div>
                    <div class="">
                        <Link
                            :href="route('admin.collaborator.sales-publicity', {id: user.id})"
                            class="btn bg-collaborator-grey ml-auto py-1 mr-2.5 font-bold"
                            :class="filterUrl ==`/admin/colaborador/${user.id}/ventas-publicidad` ? 'bg-collaborator-orange text-white shadow' : 'text-muted'"
                        >
                            Ventas publicidad
                        </Link>
                    </div>
                    <div class="">
                        <Link
                            :href="route('admin.collaborator.sales-property', {id: user.id})"
                            class="btn bg-collaborator-grey ml-auto py-1 mr-2.5 font-bold"
                            :class="filterUrl ==`/admin/colaborador/${user.id}/ventas-inmueble` ? 'bg-collaborator-orange text-white shadow' : 'text-muted'"
                        >
                            Ventas inmueble
                        </Link>
                    </div>
                </div>
            </div>
            <div class="mt-4 mt-lg-0 w-auto mt-xl-0 rounded-xl bg-collaborator-orange px-2 py-2.5">
                <div class="lg:flex justify-content-center justify-content-lg-between">
                    <div class="pt-2 text-left lg:mr-8">
                        <h2 class="font-bold inline text-white text-base">Saldo pendiente: </h2><br class="lg:hidden">
                        <p class="inline text-white text-base">{{ (withdrawal*0.20).toFixed(2) }} €</p>
                    </div>
                    <div class="pt-0.5 text-right">
                        <button class="btn bg-white text-orangec lg:ml-auto py-1 lg:mr-2.5 font-bold" @click="requestTransfer">Pedir transferencia</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:flex mb-8 justify-content-lg-start text-lg-left pt-2 pt-lg-0">
            <p class="block mr-4"><b>Facturación total: </b>{{total.toFixed(2)}}€</p>
            <p class="block mr-4"><b>Beneficio total: </b>{{(total*0.20).toFixed(2)}}€</p>
           <p class="block"><b>Última tranferencia de saldo realizada: </b>{{dateLast ? moment(dateLast).format('DD/MM/YYYY') : 'sin retiros'}}</p>
        </div>
	    <!-- Filtro por fecha -->
	    <div class="row lg:mx-0 mt-8 justify-content-start">
	    	<div class="col-12 ml-md-0 pl-md-0 col-md-3">
	    		<div class="md-form md-outline input-with-post-icon datepicker">
	    		  <label class="font-bold mb-1">Mostrar desde:</label>
				  <input
				  	v-model="form.from"
				  	placeholder="Select date"
				  	type="date"
				  	class="col-form-input w-100 rounded py-1.5"
				  	@change="validFilterPublicity()"
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
				  		@change="validFilterPublicity()"
				  	>
				</div>
	    	</div>
	    </div>
	    <!-- END Filtro por fecha -->
		<!-- table -->
		<div class="row mt-3.5">
			<div class="col-12">
				<div class="table-responsive-md">
		        	<table class="tabla-collaborator table table-striped">
					  <thead class="bg-collaborator text-white text-sm text-center">
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
					      <td class="text-center">{{ item.city }}</td>
					      <td class="text-center">{{ item.created_at }}</td>
					      <td class="text-center">{{ item.total }}€</td>
					      <td class="text-center">{{ item.beneficio }}€</td>
					    </tr>
					    <tr v-if="filterOrders.length < 1">
							<td colspan="8" class="text-center">Sin resultados</td>
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
                            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs" @click="sendNotification">{{textButton}}</button>
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
        <div class="modal modal-notification fade" id="notification" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-sales mx-auto px-2">
                    <div class="modal-body p-0 relative">
                        <div>
                            <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"  @click="reload"></i>
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
                            <button @click="reload" class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
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
        
        <ModalSales :id="'negativo'">
            <h2 class="text-lg text-center font-bold mt-3">¡Atención!</h2>
            <p class="px-4 my-2 text-xs text-center">
                Actualmente no tiene un saldo para retirar.
            </p>
            <div class="my-3.5 text-center">
                <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  data-dismiss="modal" aria-label="Close">Cerrar mensaje</button>
            </div>
        </ModalSales>
    </div>
</template>

<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
	import { Inertia } from '@inertiajs/inertia'
	import TemplateApp from '@/Pages/Admin/Layouts/Layout'
	import ModalSales from '@/Pages/Collaborator/components/Modal.vue'
	import Paginator from '@/Components/Paginator.vue'
	import Moment from 'moment'
	export default {
		layout:TemplateApp,
	    components:{
	        Head,
	        Link,
			Paginator,
			ModalSales,
	    },
	    props:{
	        orders: Object,
	        date:String,
			hotels:Object,
			totalorders:Array,
			dateLast: String,
			user: Object,
	    },
	    data () {
	    	return {
	    		form: this.$inertia.form({
					from: null,
					to: null
				}),
	    		headerTable:[
	    			{name:'ID Transacción'},
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
				textButton:'Enviar notificación',
	    	}
	    },
	    computed:{
	    	filterOrders () {
	    		const map = this.orders.data.map(item =>{
	    			var total = parseInt(item.total).toFixed(2);
	    			var beneficio = (total * 0.2).toFixed(2);
	    			return {
	    				transactionId: item.transaction_id,
	    				created_at: this.moment(item.created_at).format("DD/MM/YYYY"),
	    				total: total,
	    				beneficio: beneficio,
	    				city: 'Sevilla',
	    			}
	    		})
	    		return map
			},
			filterUrl () {
				var url = this.$page.url.split('?')[0]
				return url
			},
	    },
	    created () {
			this.moment = Moment
	    	this.totalorders.forEach(order =>{
	            this.total += Number(order.total);
	            if (order.withdrawal == 0) {
	                this.withdrawal += Number(order.total);    
	            }
	            
	        })
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
	    	validFilterPublicity() {
	    		if (this.form.to && this.form.from) {
					if (this.moment(this.form.to).isAfter(this.form.from)) {
						this.submitPublicity()
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
					this.submitPublicity()
				}
			},
			submitPublicity () {
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
					this.form.get(this.route('collaborator.sales.publicity'), {
						preserveScroll: true,
					});
				},1500);
			},
			requestTransfer(){
				if(this.withdrawal > 0){
					let dia = Number(this.moment(this.dateTEST).format("DD"));
					let mes = Number(this.moment(this.dateTEST).format("MM"));
					let año = Number(this.moment(this.dateTEST).format("YYYY"));
					let ago = this.moment().diff(this.moment([año,(mes - 1),(dia)]),'days');
					this.remainingDays = 90 - ago;
					if(Number(ago) > 90){
						$('#request').modal('show')
					}else{
						$('#notice').modal('show')
					}
				}else{
					$('#negativo').modal('show')
				}
			},
	        sendNotification(){
				this.textButton = 'Enviando...';
				let request=$('#request');
				let noti=$('#notification');
				axios({
					url: route('admin.collaborator.request-notify'),
					method: 'POST',
					data: {id: this.user.id},
				})
				.then((response) => {
					this.textButton = 'Enviar notificación';
					request.modal('hide')
					noti.modal('show')
				}) 
			},
			goBack () {
	            window.history.back()
	        }
	    },
	}
</script>
<style lang="scss" scoped>
	a:focus{
	    ouline: none;
	    box-shadow: none;
	}
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
</style>