<template>
	<div id="dashboard-perfil-bank" class="container py-8 ml-2 md:ml-0 md:px-24">
	    <ModalCookies/>
	    <!-- HEADER -->
	    <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
	                <Link
	                    :href="route('collaborator.home')"
	                    class="text-muted mr-2"
	                >
	                    <i class="fas fa-arrow-left"></i>
	                </Link>Ventas por inmueble
	            </h1>
	        </div>
	    </div>
	     <!--END Header-->
	    <!-- Filtro por fecha -->
	    <div class="row lg:mx-0 mt-8 justify-content-start">
	    	<div class="col-12 ml-md-0 pl-md-0 col-md-3">
	    		<div class="md-form md-outline input-with-post-icon datepicker">
	    		  <label class="font-bold">Mostrar desde:</label>
				  <input
				  	v-model="form.from"
				  	placeholder="Select date"
				  	type="date"
				  	class="col-form-input w-100 rounded py-1.5"
				  	@change="fiterDuring()"
				  >
				</div>
	    	</div>
	    	<div class="col-12 col-md-3 mt-2.5 mt-md-0">
	    		<div class="md-form md-outline input-with-post-icon datepicker">
	    			<label class="font-bold">Hasta:</label>
				  	<input
				  		v-model="form.to"
				  		placeholder="Select date"
				  		type="date" class="col-form-input w-100 rounded py-1.5"
				  		@change="fiterDuring()"
				  	>
				</div>
	    	</div>
	    </div>
	    <!-- END Filtro por fecha -->
		<!-- table -->
        <div class="table-responsive-sm mt-8">
        	<table class="table table-striped table-responsive">
			  <thead class="text-white text-sm text-center">
			    <tr id="tablep">
			      <th scope="col">ID Transacción</th>
			  	  <th scope="col">Alojamiento</th>
			  	  <th scope="col">Tipo Aloj.</th>
			  	  <th scope="col">Provincia</th>
			  	  <th scope="col">Ciudad</th>
			  	  <th scope="col">Fecha</th>
			  	  <th scope="col">Facturación</th>
			  	  <th scope="col">Beneficio</th>
			    </tr>
			  </thead>
			  <tbody class="text-xs text-muted" id="tbody">
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
        <div class="row justify-content-md-center px-0 px-lg-5 py-2">
        	<div class="col-12 flex justify-center">
     			 <paginator :paginator="orders" />
     		</div> 
        </div>
        <!-- end table -->
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
	        orders: Object,
	        from: String,
	        to: String,
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
	    				city: item.shippings.length > 0 ? item.shippings[0].city : '',
	    				province:  item.shippings.length > 0 ? item.shippings[0].city : '',
	    				alojamiento: item.hotel.address,
	    				tipoAloj: item.hotel.type,
	    			}
	    		})
	    		return map
	    	},
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
	    	fiterDuring() {
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
	    	/*fiterDuring () {
	    		var form = {
	    			from: this.filterSaleDuring.from,
	    			to: this.filterSaleDuring.to,
	    		}
	    		Inertia.get(route('collaborator.sales.inmueble', form))
            },*/
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
    table::-webkit-scrollbar-thumb{
    	background-color:orange;
    }
    table::-webkit-scrollbar-track{
    	background-color:orange;
    }
</style>