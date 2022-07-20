<template>
    <section id="admin-associates-header" class="container pt-8 pb-2 ml-2 md:ml-0 md:px-14">
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 text-left">
                <h1 class="font-bold text-xl lg:text-3xl text-muted">Gestión de partners</h1>
            </div>
        </div>
        
        <div class="lodgings-filter row  my-4 mx-1.5 lg:mx-0 justify-content-lg-between">
            <div class="col-12 col-lg-8 shadow p-1 rounded-xl bg-white pr-lg-0">
                    <div class="row py-1">
                    <div class="col-2 col-md-1 pl-4 pr-0">
                        <i class="fas fa-search text-gray-400 relative top-3 lg:text-lg"></i>
                    </div>
                    <div class="col-10 px-0 relative">
                        <input v-model="formSearch.search" @keyup.prevent="search" type="text"  class="border-none w-full pl-1 pr-0" placeholder="Busca tu partner...">
                        <div v-if="searching" class="spinner-border spinner-border-sm absolute right-4 md:right-0 top-3 text-orangec" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 text-right pt-2 pl-lg-0 text-center text-lg-right">
                <button data-toggle="modal" data-target="#addAssociate" class="lg:w-full bg-collaborator-orange text-white rounded px-4 lg:px-2 px-lg-4 py-2 py-lg-1 py-lg-2 mt-2 mt-lg-1 font-semibold">
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
                <Link class="font-bold" :href="route('admin.associate.show',{user:clbtr.id})">
                    {{clbtr.firstname}}
                </Link>
                <p>{{clbtr.email}}</p>
            </div>
            <div class="col-5 text-center border-r border-gray-300 pt-0.5 px-0">
                <div class="dropdown inline-block">
                    <a class="btn dropdown-toggle" 
                        href="#" role="button" :id="'profile'+clbtr.id" data-toggle="dropdown" 
                        aria-expanded="false"
                        :class="{
                            'btn-collaborator-incomplete':!clbtr.completedprofile,
                            'btn-collaborator-full':clbtr.completedprofile,
                            'px-2.5':!clbtr.completedprofile,
                            'px-3':clbtr.completedprofile,
                        }"
                    >
                        <template v-if="clbtr.completedprofile">
                            Perfil completo
                        </template>
                        <template v-else>
                            Perfil incompleto    
                        </template>
                        <i class="fas fa-caret-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu border-0 shadow-xl rounded-xl mt-2 py-0 w-60" :aria-labelledby="'profile'+clbtr.id">
                        <div class="bg-collaborator-orange p-2 rounded-t-xl">
                            <h2 class="text-white font-semibold ml-1.5">Ajustes del perfil</h2>
                        </div>
                        <Link class="dropdown-item py-2 relative" :href="route('admin.associate.profile',{user:clbtr.id})">
                            <img class="inline w-4" style="margin-top:-4px" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
                            >
                            Información perfil
                            <template v-if="clbtr.completedinfo">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link class="dropdown-item py-2 relative" :href="route('admin.associate.tax',{user:clbtr.id})">
                            <img class="inline w-4" style="margin-top:-4px"
                                src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
                            >
                            Datos fiscales
                            <template v-if="clbtr.completednif">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link class="dropdown-item py-2 relative" :href="route('admin.associate.bank',{user:clbtr.id})">
                            <img class="inline w-4" style="margin-top:-4px"
                                src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                            >
                            Información bancaria
                            <template v-if="clbtr.completdebank">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link class="dropdown-item py-2 relative" :href="route('admin.associate.shipping',{user:clbtr.id})">
                            <img class="inline w-4" style="margin-top:-4px"
                                src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                            >
                            Datos de envío
                            <template v-if="clbtr.completedshipping">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                    </div>
                </div>
                <div class="dropdown ml-2 inline-block">
                    <a class="btn dropdown-toggle px-2.5" 
                        href="#" role="button" :id="'resources'+clbtr.id" data-toggle="dropdown"
                        aria-expanded="false"
                        :class="{
                            'btn-collaborator-incomplete':!clbtr.completedresources,
                            'btn-collaborator-full':clbtr.completedresources,
                        }"
                    >
                        <template v-if="completedresources">
                            Recursos usados
                        </template>
                        <template v-else>
                            Recursos por usar    
                        </template>
                        <i class="fas fa-caret-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu border-0 shadow-xl rounded-xl mt-2 py-0 w-60" :aria-labelledby="'resources'+clbtr.id">
                        <div class="bg-collaborator-orange p-2 rounded-t-xl">
                            <h2 class="text-white font-semibold ml-1.5">Recursos</h2>
                        </div>
                        <Link :href="route('admin.associate.resources',{user:clbtr.id})" class="dropdown-item py-2 relative" href="javascript:void(0)">
                            <img
                                class="inline w-4"
                                style="margin-top:-4px" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
                            >
                            Banner descargado
                            <template v-if="clbtr.completedBanner">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link :href="route('admin.associate.resources',{user:clbtr.id})" class="dropdown-item py-2 relative" href="javascript:void(0)">
                            <img
                                class="inline w-4"
                                style="margin-top:-4px" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
                            >
                            Url generada
                            <template v-if="clbtr.completedUrl">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link :href="route('admin.associate.resources',{user:clbtr.id})" class="dropdown-item py-2 relative" href="javascript:void(0)">
                            <img
                                class="inline w-4"
                                style="margin-top:-4px" 
                                src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
                            >
                            Displays pedidos
                            <template v-if="clbtr.completedRequestDisplay">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                        <Link :href="route('admin.associate.resources',{user:clbtr.id})" class="dropdown-item py-2 relative" href="javascript:void(0)">
                            <img class="inline w-4" style="margin-top:-4px"
                                src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
                            >
                            Displays enviados
                            <template v-if="clbtr.completedReseivedDisplay">
                                <i class="fas fa-check-circle pl-1 absolute right-5 top-2.5 text-xs text-success"></i>
                            </template>
                            <template v-else>
                                <i class="fas fa-times-circle pl-1 absolute right-5 top-2.5 text-xs text-danger"></i>
                            </template>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="col-2 text-center border-r border-gray-300">
                <p class="font-semibold mt-2">{{ clbtr.total_orders }}</p>
            </div>
            <div class="col-2 text-center">
                <p class="font-semibold mt-2">{{calcularBeneficio(clbtr.orders)}}€</p>
            </div>
        </div>
        <div v-if="collaborators.data.length == 0" class="admin-card-associate row mx-1.5 lg:mx-0 shadow px-2 rounded-xl bg-header-collaborator py-2.5 my-6">
            <div class="col-12 text-center py-2">
                <h1 class="text-lg">No hay resultados</h1>
            </div>
        </div>
    </section>

    <ValidationAlert
        :errors="errorsKey"
    />
    <section v-if="collaborators.data.length > 0" id="admin-associates-paginator" class="ml-2 md:ml-0 md:px-14">
        <div class="row justify-content-center mt-1.5 mb-4">
            <div class="col-12 col-lg-8">
                <paginator :paginator="collaborators"/>
            </div>
        </div>
    </section>
    <!-- Central Modal Small -->
    <div class="modal fade" id="addAssociate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mx-auto border-0 w-full md:w-3/4">
                <div class="modal-body p-0">
                    <div class="bg-collaborator-orange h-16 pt-3 px-4 rounded-t-xl">
                        <p class="text-white text-2xl font-bold">
                            <img class="inline w-6" style="margin-top:-4px"
                                src="/vendor_asset/img/collaborator/dashboard/icons/gestionaloj.svg"
                            >
                            Registrar partner
                        </p>
                    </div>
                    <div class="mt-1 px-4">
                    <form @submit.prevent="addAssociate" class="row px-4 py-2.5">
                        <div class="col-12 my-1.5 px-0">
                            <label class="font-weight-bolder mb-0.5">
                                Correo electrónico 
                                <span class="text-orangec">*</span>
                            </label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-envelope absolute inset-y-1/3  pl-2.5 pr-2"></i>
                                <input v-model="formAssociate.email" type="email" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Email...." autocomplete="on" required>
                            </div>
                        </div>
                        <div class="col-12 my-1.5 px-0">
                            <label class="font-weight-bolder mb-0.5">Contraseña<span class="text-orangec">*</span></label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-key absolute inset-y-1/3  pl-2.5 pr-2"></i>
                                <i class="far fa-eye cursor-pointer absolute right-0 inset-y-1/3 px-3" v-on:click="showPass('password')"></i>
                                <input  v-model="formAssociate.contraseña" type="password" class="collaborator-input bg-light w-100 rounded py-1 pl-8" id="password" placeholder="********" required>
                            </div>
                        </div>
                        <div class="col-12 my-1.5 px-0">
                            <label class="font-weight-bolder mb-0.5">
                                Nombre
                                <span class="text-orangec">*</span>
                            </label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-user absolute inset-y-1/3  pl-2.5 pr-2"></i>
                                <input v-model="formAssociate.nombre" type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Nombre...." autocomplete="on" required>
                            </div>
                        </div>
                        <div class="col-12 my-1.5 px-0">
                            <label class="font-weight-bolder mb-0.5">
                                Número de contacto 
                                <span class="text-orangec">*</span>
                            </label>
                            <div class="relative w-100 collaborator-box">
                                <i class="fas fa-phone-alt absolute inset-y-1/3  pl-2.5 pr-2"></i>
                                <input v-model="formAssociate.contacto" type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Número de contacto...." autocomplete="on" required>
                            </div>
                        </div>
                        <div class="col-12 mt-3 px-0 text-center text-lg-left">
                            <div class="row justify-content-between mb-3.5">
                                <div class="col-2 col-lg-5">
                                    <button class="btn px-3.5 py-1 text-xs font-bold text-gray-500 mt-0.5" data-dismiss="modal"  aria-label="Close"><i class="fas fa-reply"></i>
                                        Volver
                                    </button>
                                </div>
                                <div class="col-8 col-lg-6 pt-1.5 lg:pt-0 text-right">
                                    <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-2.5 lg:px-6" ><i class="fas fa-save mr-2 text-white"></i>Guardar</button>
                                </div>
                            </div>
                            <!-- <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> -->
                            
                        </div>
                        <div v-if="errors.length > 0" class="text-danger">
                            <p class="text-danger" v-for="error in errors" :key="error">
                                 <span class="text-xl font-bold mr-0.5">•</span>{{error}}
                            </p><br>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Central Modal Small -->

</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3'
import QRCodeVue3 from "qrcode-vue3"
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
	layout:Layout, 
	components: {
		Paginator,
		Link,
        QRCodeVue3,
        ValidationAlert
	},
	props: {
	collaborators: Object,
    url:String,
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
            let profileCompleted = false; 
            let resourcesCompleted = false; 
            if(col.completInformation && col.completedBank && col.completedNif && col.completedShipping){
                profileCompleted = true;
            }
            if(col.completedBanner && col.completedRequestDisplay && col.completedReseivedDisplay && col.completedUrl){
                resourcesCompleted = true;
            }
            return {
                id : col.id,
                firstname: col.firstname,
                email: col.email,
                orders: col.orders,
                city: col.city,
                completedinfo: col.completInformation,
                completdebank: col.completedBank,
                completednif: col.completedNif,
                completedshipping: col.completedShipping,
                completedprofile:profileCompleted,
                completedBanner: col.completedBanner,
                completedUrl: col.completedUrl,
                completedRequestDisplay: col.completedRequestDisplay,
                completedReseivedDisplay: col.completedReseivedDisplay,
                completedresources:resourcesCompleted,
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
            formAssociate: this.$inertia.form({
				nombre: null,
                email: null,
                contraseña:null,
                contacto:null
			}),
			total:0,
            searching:false,
            errorsKey:[],
            errors:[]
		}
	},
	methods:{
        addAssociate(){
            let modal = $('#addAssociate')
            this.formAssociate.post(route('admin.associates.create'),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submitAssociate',
                preserveScroll: true,
                onSuccess:()=>{
                    this.formAssociate.reset()
                    modal.modal('hide')
                    console.log('etnro')
                },
                onError: (errors) => {
                    // this.forceExitConfirm = false
                    this.getErrorsKey()
                    this.getErrors()
                    this.emitter.emit('errors')
                },
            })
        },
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
            this.searching = true;
			this.collaborators.data = {};
            this.formSearch.get(this.route('admin.associates'), {
                preserveScroll: true,
                onSuccess:()=>{
                    this.searching = false;
                }
            });
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
		},
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
        getErrors() {
            this.errors = this.$page.props.errors.submitAssociate ? Object.values(this.$page.props.errors.submitAssociate) : []
        },
        getErrorsKey () {
            this.errorsKey = this.$page.props.errors.submitAssociate ? Object.keys(this.$page.props.errors.submitAssociate) : []
        },
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
.dropdown img{
    filter: invert(63%) sepia(11%) saturate(7%) hue-rotate(345deg) brightness(132%) contrast(87%);
}
.collaborator-input{
    background-color: #e7f6ff !important;
}
</style>