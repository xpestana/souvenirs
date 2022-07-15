<template>
<!-- @click.prevent="createCollaborator"
<input type="text" class="form-control rounded-sm" placeholder="Search" v-model="formSearch.search" @keyup.prevent="search">
v-for="clbtr in colaboradores" :key="clbtr.id"
<Link :href="route('admin.associates.show',clbtr.id)">{{clbtr.firstname}}{{clbtr.email}}
{{calcularBeneficio(clbtr.orders)}}€{{ clbtr.total_orders }}
<a  class="bnt btn-azulc text-white rounded-pill px-4 py-1" href="javascript:void(0)" @click="souvenirs_btn(clbtr.id,clbtr.firstname)">Descargar</a>
{{clbtr.city}} -->
    <section id="admin-associates-header" class="container pt-8 pb-4 ml-2 md:ml-0 md:px-14">
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 text-left">
                <h1 class="font-bold text-xl lg:text-3xl text-muted">Gestión de partners</h1>
            </div>
        </div>
        
        <div class="lodgings-filter row  my-4 mx-1.5 lg:mx-0 justify-content-lg-between">
            <div class="col-12 col-lg-8 shadow p-1 rounded-xl bg-white pr-lg-0">
                    <div class="row py-1">
                    <div class="col-1 pl-4 pr-0">
                        <i class="fas fa-search text-gray-400 relative top-3 lg:text-lg"></i>
                    </div>
                    <div class="col-10 px-0">
                        <input type="text"  class="border-none w-full pl-1 pr-0" placeholder="Busca tu partner...">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 text-right pt-2 pl-lg-0">
                <button class="w-full bg-collaborator-orange text-white rounded px-2 px-lg-4 py-1 py-lg-2 mt-2 mt-lg-1 font-semibold">
                    + Añadir partner
                </button>
            </div>
        </div>
    </section>

    <section id="admin-associates-body" class="ml-2 md:ml-0 md:px-14 overflow-x-auto">
        <div class="header-cards-associate row mx-1.5 lg:mx-0 px-2 py-1 w-mobile-associate">
            <div class="col-3 text-left">
                <p class="text-gray-400 font-semibold">Usuario</p>
            </div>
            <div class="col-5 text-left">
                <p class="text-gray-400 font-semibold">Estado</p>
            </div>
            <div class="col-2 text-left">
                <p class="text-gray-400 font-semibold">Pedidos</p>
            </div>
            <div class="col-2 text-left">
                <p class="text-gray-400 font-semibold">Beneficios</p>
            </div>
        </div>
        <div v-for="clbtr in colaboradores" :key="clbtr.id" class="admin-card-associate row mx-1.5 lg:mx-0 shadow px-2 rounded-xl bg-header-collaborator py-2.5 mb-6 w-mobile-associate">
            <div class="col-3 text-left border-r border-gray-300">
                <h1 class="font-bold">Usuario 1234</h1>
                <p>correousuario@email.com</p>
            </div>
            <div class="col-5 text-center border-r border-gray-300 pt-0.5 px-0">
                <div class="dropdown inline-block">
                    <a class="btn btn-collaborator-incomplete dropdown-toggle px-3" href="#" role="button" id="profile" data-toggle="dropdown" aria-expanded="false">
                        Perfil incompleto<i class="fas fa-caret-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profile">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="dropdown ml-2 inline-block">
                    <a class="btn btn-collaborator-incomplete dropdown-toggle px-3" href="#" role="button" id="resources" data-toggle="dropdown" aria-expanded="false">
                        Perfil incompleto<i class="fas fa-caret-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="resources">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="col-2 text-center border-r border-gray-300">
                <p class="font-semibold mt-2">2</p>
            </div>
            <div class="col-2 text-center">
                <p class="font-semibold mt-2">2123123€</p>
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
                 col.orders.forEach(function(order) {
                    if(order.status == "complete" && order.returned == 0){
                        total_orders++;
                    }
                });
            return {
                id : col.id,
                firstname: col.firstname,
                email: col.email,
				orders: col.orders,
                city: col.city,
                total_orders:total_orders
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
			total:0,
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
                    if(order.status == "complete" && order.returned == 0){
                        total_benefits = Number(total_benefits)  + Number(order.total);
                    }
                });
                
                return (total_benefits*0.20).toFixed(2);
            }
            return 0;
		}
	}
}
</script>
<style scoped>
.btn-collaborator-full{
    background-color: #b7ffc7;
    color: #6d966d;
    font-weight: 600;
    font-size: 1em;
}
.btn-collaborator-incomplete{
    background-color: #ff7878;
    color: #ffdada;
    font-weight: 600;
    font-size: 1em;
}
input:focus{
    --tw-ring-inset:none;
    --tw-ring-color: none;
}
@media(max-width:676px){
    .w-mobile-associate{
        width:65em ;
    }
}
</style>