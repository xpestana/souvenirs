<template>
    <section id="admin-collaborator" class="container pt-8 pb-4 ml-2 md:ml-0 md:px-14">
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
	        <div class="col-12 col-md-8 text-left">
	            <h1 class="font-bold text-lg md:text-3xl text-muted">
                    Gestión de anfitriones
	            </h1>
	        </div>
	    </div>
		<div class="lodgings-filter row  my-4 mx-1.5 lg:mx-0 justify-content-lg-between">
            <div class="col-12 col-lg-8 shadow p-1 rounded-xl bg-white pr-lg-0">
                    <div class="row py-1">
                    <div class="col-2 col-md-1 pl-4 pr-0">
                        <i class="fas fa-search text-gray-400 relative top-3 lg:text-lg"></i>
                    </div>
                    <div class="col-10 px-0 relative">
                        <input v-model="formSearch.search" @keyup.enter="submitSearch" type="text"  class="border-none w-full pl-1 pr-0" placeholder="Busca tu anfitrión...">
                        <div v-if="searching" class="spinner-border spinner-border-sm absolute right-4 md:right-0 top-3 text-orangec" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 text-right pt-2 pl-lg-0 text-center text-lg-right">
                <button
					class="lg:w-full bg-collaborator-orange text-white rounded px-4 lg:px-2 px-lg-4 py-2 py-lg-1 py-lg-2 mt-2 mt-lg-1 font-semibold"
					@click="openModalRegister"
				>
                    + Añadir anfitrión
                </button>
            </div>
        </div>
    </section>
	<section class="ml-2 md:ml-0 md:px-14 table-responsive-md">
		<div class="w-mobile-collaborator">
			<div class="row mx-0 justify-content-start py-1 w-mobile-collaborator">
				<div class="col-3 text-left text-gray-400 font-semibold">
					Usuario
				</div>
				<div class="col-5 text-left text-gray-400 font-semibold">
					Estado
				</div>
				<div class="col-1 text-center text-gray-400 font-semibold">
					Inmuebles
				</div>
				<div class="col-1 text-center text-gray-400 font-semibold">
					Pedidos
				</div>
					<div class="col-2 text-center text-gray-400 font-semibold">
					Beneficios
				</div>
			</div>
			<div
				v-for="(item, index) in mapCollaborators"
				:key="index"
				class="admin-card-anfitrion row mx-1.5 lg:mx-0 shadow px-2 rounded-xl bg-header-collaborator py-2.5 mb-6 w-mobile-collaborator"
			>
				<div class="col-3 text-left border-r border-gray-300">
					<Link
                        :href="`/admin/colaborador/${item.id}`"
                        class="font-bold"
                    >
                        {{ item.firstname }}
                    </Link>
					<p class="mt-1">{{ item.email }}</p>
				</div>
				<div class="col-5 text-center px-0 border-r border-gray-300">
					<div class="dropdown inline-block mr-2">
						<a
							class="btn rounded px-3 dropdown-toggle"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
							:id="`dropdown-profile-${item.id}`"
							:class="item.completInformation && item.completedNif && item.completedShipping && item.completedBank ? 'btn-collaborator-full' : 'btn-collaborator-incomplete'"
						>
							<span  class="inline-block">
								{{ item.completInformation && item.completedNif && item.completedShipping && item.completedBank ? 'Perfil completo' : 'Perfil incompleto' }}
							</span>
							<i class="fas fa-caret-down inline-block ml-1"></i>
						</a>
						<div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md" :aria-labelledby="`dropdown-profile-${item.id}`">
							<div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
								Ajustes del perfil
							</div>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.profile',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px; margin-right: 2px;"
										src="/vendor_asset/img/collaborator/dashboard/icons/info.svg"
									>
									Información de perfil
								</span>
								<i v-if="item.completInformation" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.tax',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px; margin-right: 2px;"  
										src="/vendor_asset/img/collaborator/dashboard/icons/fiscales.svg"
									>
									Datos fiscales
								</span>
								<i v-if="item.completedNif" class="fas fa-check-circle w-3  text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.bank',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px; margin-right: 2px;"  
										src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
									>
									Información bancaria
								</span>
								<i v-if="item.completedBank" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:2px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.shipping',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px; margin-right: 2px;"  
										src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
									>
									Datos de envío
								</span>
								<i v-if="item.completedShipping" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:1px"></i>
							</Link>
						</div>
					</div>
					<div class="dropdown inline-block">
						<a
							class="btn rounded px-3 dropdown-toggle"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
							:id="`dropdown-resource-${item.id}`"
							:class="item.completedBanner && item.completedUrl && item.completedRequestDisplay && item.completedReseivedDisplay ? 'btn-collaborator-full' : 'btn-collaborator-incomplete'"
						>
							<span class="inline-block">
								{{item.completedBanner && item.completedUrl && item.completedRequestDisplay && item.completedReseivedDisplay ? 'Recursos usados' : 'Recursos por usar'}}
							</span>
							<i class="fas fa-caret-down inline-block ml-1"></i>
						</a>
						<div class="dropdown-menu setting-profile pt-0 rounded-md shadow-md text-xs" :aria-labelledby="`dropdown-resource-${item.id}`">
							<div class="bg-collaborator-orange rounded-t-md py-2 px-2 font-bold text-white">
								Recursos
							</div>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.tax',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px" 
										src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_BannerBlanco.svg"
									>
									Banner descargado
								</span>
								<i v-if="item.completedBanner" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:1px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.tax',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px" 
										src="/vendor_asset/img/collaborator/dashboard/icons/Recursos_UrlBlanco.svg"
									>
									Url generada    
								</span>
								<i v-if="item.completedUrl" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:1px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.tax',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px" 
										src="/vendor_asset/img/collaborator/dashboard/icons/bancaria.svg"
									>
									Displays pedidos
								</span>
								<i v-if="item.completedRequestDisplay" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:1px"></i>
							</Link>
							<Link class="flex dropdown-item link justify-content-between" :href="route('admin.collaborator.tax',{id:item.id})">
								<span class="text-black">
									<img
										class="inline w-4 icon-filter"
										style="margin-top:-4px" 
										src="/vendor_asset/img/collaborator/dashboard/icons/datosenvio.svg"
									>
									Displays enviados
								</span>
								<i v-if="item.completedReseivedDisplay" class="fas fa-check-circle w-3 text-success" style="margin-top:3px"></i>
								<i v-else class="fas fa-times-circle w-3 text-danger" style="margin-top:1px"></i>
							</Link>
						</div>
					</div>
				</div>
				<div class="col-1 flex justify-content-center align-items-center border-r border-gray-300">
					<span class="font-bold inline-block">{{ item.countHotels }}</span>
				</div>
				<div class="col-1 flex justify-content-center align-items-center border-r border-gray-300">
					<span class="inline-block">{{ item.countOrders}}</span>
				</div>
				<div class="col-2 flex justify-content-center align-items-center border-r border-gray-300">
					<span class="inline-block">{{ item.benefit }} €</span>
				</div>
			</div>
		</div>
		<div
			v-if="collaborators.data.length > 0"
			class="row justify-content-center mb-8"
		>
			<div class="col-12 col-lg-6">
				<paginator :paginator="collaborators" />
			</div>
		</div>
	</section>
	<div class="modal modal-notification fade" id="register-collaborator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content modal-register mx-auto">
				<div class="modal-header rounded-t-xl py-2 px-2 m-0 bg-collaborator-orange">
					<h1 class="font-bold text-white inline-block text-lg lg:text-xl">
						<img class="inline w-7 mr-2" style="margin-top:-4px;"
							src="/vendor_asset/img/collaborator/dashboard/icons/gestionaloj.svg"
						>
						Registrar anfitrión
					</h1>
				</div>
				<div class="modal-body px-2 py-2">
					<div class="row">
						<div class="col-12">
							<div class="row justify-content-center">
								<div class="col-10 my-1.5 px-0">
									<!--Alert validation -->
									<ValidationAlert
										:errors="formatErrors"
									/>
									<label  class="font-bold">Correo electrónico <span class="required-input">*</span></label>
									<div class="collaborator-box relative">
										<i class="fas fa-envelope absolute left-0 inset-y-1/3 px-2"></i>
										<input
											v-model="formCollaborator.email"
											type="text"
											class="w-100 rounded col-form-input py-1.5 pl-8"
											placeholder="Correo electrónico..."
											:class="{'error-input': errorsKey.includes('holder')}"
										>
									</div>
								</div>
								<div class="col-10 my-1.5 px-0">
									<label  class="font-bold">Contraseña <span class="required-input">*</span></label>
									<div class="collaborator-box relative">
										<i
											class="cursor-pointer absolute right-0 inset-y-1/3 px-2"
											:class="showPass ? 'fas fa-eye-slash' : 'fas fa-eye'"
											@click="showPass = !showPass"
										></i>
										<i class="fas fa-key absolute left-0 inset-y-1/3 px-2"></i>
										<input
											v-model="formCollaborator.password"
											:type="showPass ? 'text' : 'password'"
											class="w-100 rounded col-form-input py-1.5 pl-8 pr-8"
											placeholder="********"
											:class="{'error-input': errorsKey.includes('holder')}"
										>
									</div>
								</div>
								<div class="col-10 my-1.5 px-0">
									<label  class="font-bold">Nombre <span class="required-input">*</span></label>
										<div class="collaborator-box relative">
										<i class="fas fa-user absolute left-0 inset-y-1/3 px-2"></i>
										<input
											v-model="formCollaborator.name"
											type="text"
											class="w-100 rounded col-form-input py-1.5 pl-8"
											placeholder="Nombre..."
											:class="{'error-input': errorsKey.includes('holder')}"
										>
									</div>
								</div>
								<div class="col-10 my-1.5 px-0">
									<label  class="font-bold">Número de contacto <span class="required-input">*</span></label>
									<div class="collaborator-box relative">
										<i class="fas fa-phone-alt absolute left-0 inset-y-1/3 px-2"></i>
										<input
											v-model="formCollaborator.phone"
											type="text"
											class="w-100 rounded col-form-input py-1.5 pl-8"
											placeholder="Número de contacto..."
											:class="{'error-input': errorsKey.includes('holder')}"
										>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mt-1.5 px-2 flex justify-content-between">
						<button class="btn px-3.5 text-gray-500 py-1 text-xs font-bold inline-block" @click="closeModalRegister">
							<i class="fas fa-reply"></i>
							Volver
						</button>
						<button
							type="submit"
							class="btn inline-block rounded text-white bg-collaborator-orange py-1 px-6"
							:class="{ 'opacity-25': formCollaborator.processing }"
                            :disabled="formCollaborator.processing"
							@click.prevent="submitCreate"

						>
							<i class="fas fa-save mr-2 text-white">
								</i>Guardar
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3'
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:Layout, 
	components: {
		Paginator,
		Link,
		ValidationAlert,
    },
    props: {
        collaborators: {
            type: Array,
            default: () => ([]),
        }
    },
    data() {
        return {
			formSearch: this.$inertia.form({
				search: null,
			}),
			formCollaborator: this.$inertia.form({
				name: null,
				email: null,
				phone: null,
				password: null,
			}),
			showPass: false,
			errorsKey: [],
			searching:false,
        }
	},
	computed: {
		formatErrors () {
            var map = this.errorsKey.map( item => {
                switch (item) {
                    case 'name':
                        return 'Nombre'
                        break;
                    case 'phone':
                        return 'Telefono'
						break;
					case 'email':
                        return 'Correo electrónico'
						break;
					case 'password':
                        return 'Contraseña'
                        break;
                    default:
                    return item
                }
            })
            return map
        },
		mapCollaborators () {
			const coll = this.collaborators.data.map(item => {
				var benefit = 0
				var countOrders = 0
				var countHotels = item.hotel.length
				item.hotel.forEach(item1 => {
					countOrders += item1.orders.length
					item1.orders.forEach(item2 =>{
						benefit += item2.total * 0.20
					})
				})
				return {
					...item,
					countOrders,
					countHotels,
					benefit: benefit.toFixed(2),
				}
			})
			return coll
		},
	},
	mounted(){
		this.busqueda()
	},
    methods: {
		busqueda(){
			let search = this.$page.url.split("search=","2")[1];
			if(search !== undefined ){
				let limpioSearch = search.slice(0)
				this.formSearch.search = limpioSearch
			}
		},
		submitSearch (value) {
			this.searching = true
			this.collaborators.data = []
			this.formSearch.get(this.route('admin.colaboradores'), {
				preserveScroll: true,
				onFinish: ()=>{
					this.searching = true
				},
			})
		},
		submitCreate () {
			this.formCollaborator.post(this.route('admin.collaborator.store'), {
				preserveScroll: true,
				errorBag: 'submitCreate',
                onSuccess:()=>{
                    $('#register-collaborator').modal('hide')
                },
                onError: (errors) => {
                    this.getErrorsKey()
                    this.emitter.emit('errors')
                },
			})
		},
        openModalRegister () {
            $('#register-collaborator').modal({show: true, backdrop: 'static', keyboard: false})
        },
        closeModalRegister () {
            $('#register-collaborator').modal('hide')
		},
		getErrorsKey () {
            this.errorsKey = this.$page.props.errors.submitCreate ? Object.keys(this.$page.props.errors.submitCreate) : []
        },
    },
}
</script>

<style lang="scss" scoped>
    .bg-item{
        background-color: #d9d9d9;
    }
   
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

    .setting-profile {
        top: 3.2rem;
        left: 0;
        width: 250px;
    }

	.error-input{
        border: solid 2.5px red;
    }

    .icon-filter{
        filter: invert(100%) sepia(100%) saturate(100%) hue-rotate(330deg) brightness(100%) contrast(57%);
    }

	.w{
		min-width: 600px;
	}
	.modal-dialog{
		max-width: 27%;
	}

    @media(max-width:767px){
		.modal-dialog{
			max-width: 90%;
		}
		.w{
			min-width: 900px;
		}
		.w-mobile-collaborator{
			min-width:1100px ;
		}
    }

</style>