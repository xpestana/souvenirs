<template>
    <section id="dashboard-lodgings" class="container py-8 ml-2 md:ml-0 md:px-14">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 text-left">
                <h1 class="font-bold text-xl lg:text-3xl text-muted">
                    <i class="cursor-pointer text-muted mr-2 fas fa-arrow-left" @click.prevent="goBack()"></i>
                    Gestión de Alojamientos
                </h1>
            </div>
        </div>
        <!--END Header section-->
        <!-- Miga de pan -->
        <div class="my-4 mx-1.5 lg:mx-0">
            <p class="text-muted font-light">Gestor de anfitrión / Usuario {{ user.id }} <span class="text-muted font-bold"> / Alojamientos</span></p>
        </div>
        <!-- Din de miga de pagn -->
        <!-- Header section-->
        <div class="lodgings-filter row  my-4 mx-1.5 lg:mx-0 shadow p-1 rounded-xl bg-white">
            <div class="col-8 col-lg-4">
                    <div class="row">
                    <div class="col-2 pr-0">
                        <i class="fas fa-search text-gray-400 relative top-3 lg:text-lg"></i>
                    </div>
                    <div class="col-10 px-0">
                        <input type="text" v-model="search" class="border-none w-full px-0" placeholder="Busca tu alojamiento...">
                    </div>
                </div>
            </div>
            <div class="d-none  col-lg-3 border-l-2 border-r-2 d-lg-flex justify-content-around">
                <div class="dropdown">
                    <select v-model="type" class="border-none py-0 font-semibold text-gray-400 2xl:text-lg leading-10 2xl:mt-2">
                        <option value="">Tipo de alojamiento</option>
                        <option value="apartamento">Apartamento</option>
                        <option value="hotel">Hotel</option>
                        <option value="complejo">Complejo turístico</option>
                    </select>
                </div>
                <!-- <i class="fas fa-caret-down relative top-3.5 text-gray-400"></i> -->
            </div>
            <div class="d-none  col-lg-3 d-lg-flex justify-content-around">
                <div class="dropdown">
                    <select class="border-none py-0 font-semibold text-gray-400 2xl:text-lg leading-10 2xl:mt-2">
                        <option value="">Ciudad</option>
                    </select>
                </div>
            </div>
            <div class="col-4 col-lg-2">
                <button @click="searchFilter()" class="bg-collaborator-orange text-white rounded px-2 px-lg-4 py-1 py-lg-2 mt-2 mt-lg-1">
                    Buscar
                </button>
            </div>
        </div>
        <!--END Header section-->
         <!-- Content section-->
        <template v-if="hotels.data.length > 0">
            <div class="lodgings-card row mx-1.5 lg:mx-0" v-for="hotel in hoteles" :key="hotel.id" >
                <div class="lodgings-card-body my-2.5 lg:my-0 mb-4 col-12 w-full h-60 lg:h-28 rounded-xl shadow relative">
                    <div class="row h-full rounded-xl relative bg-cover bg-top">
                        <div class="col-12 col-lg-5 h-3/5 lg:h-auto rounded-l-xl rounded-r-xl lg:rounded-r-none bg-cover bg-center bg-no-repeat relative" 
                            :style="'background-image: url(/storage/hotel'+hotel.image+');'"
                        >
                            <div class="rounded-l-xl gradient-lodgings absolute left-0 top-0 w-full h-full d-none d-lg-block"></div>
                        </div>
                        <div class="col-12 col-lg-4 h-3/5 lg:h-auto lg:bg-black absolute top-0 lg:relative py-lg-2 px-0">
                            <div class="absolute lg:relative z-30 top-0  pt-4 pl-2 pb-2 pt-lg-0 pl-lg-0 pb-lg-0">
                                <h2 class="text-2xl lg:text-lg xl:text-xl text-white font-semibold lg:truncate capitalize " style="line-height:1.3rem">
                                    <template v-if="hotel.type == 'apartamento'">
                                        {{hotel.calle}} {{hotel.planta}}
                                    </template>
                                    <template v-else>
                                        {{hotel.name}}
                                    </template>
                                </h2>
                                <p class="text-white text-sm lg:text-xs leading-5 lg:leading-4 mt-1 mt-lg-1 lg:truncate">
                                    {{hotel.type === 'complejo' ? 'complejo turístico' : hotel.type}} · {{ hotel.hab }}
                                    <template v-if="hotel.type == 'hotel'">
                                        Habitaciones ·
                                    </template>
                                    <template v-if="hotel.type == 'complejo'">
                                        Apartamentos ·
                                    </template>
                                    {{ hotel.zone }}
                                </p>
                            </div>
                            <div class="absolute h-full w-full d-lg-none grandient-mobile rounded-t-xl top-1 left-0"></div>
                            <div class="lodgings-button mt-4 d-none d-lg-block">
                                <Link :href="'#'" class="btn bg-collaborator-orange font-semibold py-1 xl:px-8 mr-2 text-white">Ver ventas</Link>
                                <button @click="requestDisplay(hotel.id)" class="btn bg-collaborator-orange font-semibold py-1 xl:px-4 text-white ml-lg-1">Pedir displays</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 h-2/5 lg:h-auto bg-black rounded-b-xl xl:rounded-r-xl py-lg-2 pl-0 pl-lg-2 xl:rounded-l-none relative">
                            <p class="text-blue-coll text-sm pl-4 pl-lg-0 text-xl lg:text-sm"><b>Beneficios:</b> {{hotel.total_benefit}} €</p>
                            <p class="text-blue-coll text-sm pl-4 pl-lg-0 text-xl lg:text-sm"><b>Pedidos:</b> {{hotel.total_orders}}</p>
                            <button type="button" data-toggle="modal" :data-target="'#edit'+hotel.id" data-backdrop="static" data-keyboard="false" @click.prevent="chageFormEdit()" class="d-none d-lg-inline-block btn btn-outline-orange font-semibold mt-4 text-sm"
                                style="padding: 0.3rem 3rem;"    
                            >
                                Editar
                            </button>
                            <ModalEdit :form="hotel" :ref="`modalEdit${hotel.id}`" :id="'edit'+hotel.id" :user_id="user.id"/>
                            <button  class="d-lg-none btn bg-white absolute bottom-11 right-8 rounded-circle pt-1 pb-0.5 px-2.5 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-caret-down  text-3xl leading-4"></i>
                            </button>
                            <div class="dropdown-menu">
                                <Link :href="'#'" class="dropdown-item">
                                    Ver ventas
                                </Link>
                                <a href="javascript:void(0)" @click="requestDisplay(hotel.id)" class="dropdown-item">
                                    Pedir displays
                                </a>
                                <a href="javascript:void(0)"  class="dropdown-item"  data-toggle="modal" :data-target="'#edit'+hotel.id" data-backdrop="static" data-keyboard="false" @click.prevent="chageFormEdit()">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </template>
        <template v-else>
            <div class="text-center mt-16 lg:mt-32 px-2.5 lg:px-56">
                <h3 class="text-3xl font-bold">¡Todavía no has dado de alta ningún alojamiento!</h3>
                <p class="mt-2 text-sm font-medium">
                    Dar de alta tu primer alojamiento es el primer paso
                    para empezar a ganar con <b>HiCitty</b>
                </p>
            </div>
        </template>
        
        <!-- END Content section-->
        <div class="flex justify-center lg:px-56 my-2">
            <button @click.prevent="openCreateLodging()" class="bg-collaborator-orange text-white font-semibold block py-1.5 rounded px-4">+ Añadir alojamiento</button>
        </div>
        <div class="row justify-content-center" v-if="hotels.data.length > 0">
            <div class="col-12 col-lg-6">
                <paginator :paginator="hotels" />
            </div>
        </div>
    </section>
    <ModalCreateType
        ref="modalCreateType"
        :form.sync="form"
        @clickOpenForm="openFormCreate()"
    />
    <ModalCreateForm
        ref="modalCreateForm"
        :user_id="user.id"
        :form.sync="form"
        @clickBackModalType="openCreateLodging()"
    />
    <NotiModal :id="'display'">
        <template v-slot:header>
            <i class="fas fa-truck text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
            ¿Quieres displays para este inmueble?
        </template>
        <template v-slot:text>
            Si la respuesta es "Si",envíanos una notificación
            y nosotros nos pondremos en contacto contigo lo antes
            posible.
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                @click="sendRequest"
            >Enviar notificación
            </button>
        </template>
    </NotiModal>
    
    <NotiModal :id="'notidisplay'">
        <template v-slot:header>
            <i class="far fa-check-circle text-orangec text-4xl"></i>
        </template>
        <template v-slot:title>
            ¡Notificación recibida!
        </template>
        <template v-slot:text>
            En breve nos pondremos en contacto contigo para hablar de 
            lo que necesitas.
        </template>
        <template v-slot:footer>
            <button class="btn rounded bg-collaborator-orange text-white px-3.5 py-1 text-xs"  
                 data-dismiss="modal" aria-label="Close"
            >Cerrar mensaje
            </button>
        </template>
    </NotiModal>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Inertia } from '@inertiajs/inertia'  
import { Head, Link } from '@inertiajs/inertia-vue3'
import Paginator from '@/Components/Paginator.vue'
import ModalCreateType from '@/Pages/Admin/Collaborators/Lodging/ModalCreateType'
import ModalCreateForm from '@/Pages/Admin/Collaborators/Lodging/ModalCreateForm'
import ModalEdit from '@/Pages/Admin/Collaborators/Lodging/ModalEdit'
import NotiModal from '@/Pages/Collaborator/components/NotiModal'
export default {
    layout: Layout,
    components:{
        Head,
        Link,
        Paginator,
        ModalCreateType,
        ModalCreateForm,
        ModalEdit,
        NotiModal
    },
    props: {
    hotels: Object,
    url:String,
    user: Object,
    },
    data(){
        return{
            showModal:false,
            total: 0,
            orders: 0,
            user_id:0,
            search:null,
            type:'',
            form: this.$inertia.form({
                tipo: null,
            }),
            idNoti:null
        }
    },
    created(){
        console.log(this.hotels)
        if(this.hotels.length > 0){
            this.user_id = this.hotels[0].pivot.user_id
        }
        let url = this.$page.url.split('?')[1];
        if(url !== undefined){
            let inputSearch = this.cleanUrlSearch(url,'buscar');
            const reg = /%20/g;
            const nuevaStr = inputSearch.replace(reg, " ");
            this.search = nuevaStr;
            this.type = this.cleanUrlSearch(url,'tipo')
        }
    },
    computed:{
        hoteles(){
        const obj = this.hotels.data.map((col)=>{
            var total_benefit = 0;
            var i = 0;
            console.log(col.orders)
            col.orders.forEach(function(order) {
                if(order.status == "complete" && order.returned == 0){
                    total_benefit += Number(order.total);
                    i++;
                }
                
            });
            this.total = this.total + (total_benefit *0.20)
            this.orders = this.orders + i
        return {
            ...col,
            total_benefit : (total_benefit*0.20).toFixed(2),
            total_orders : i,
        }
        });
        return obj;
    },
    },
    methods: {
        searchFilter(){
            this.$inertia.get(route('coll.lodgings.index'), {buscar:this.search,tipo:this.type},
            { 
                preserveScroll: true
            })
        },
        lodging(){
            this.$inertia.get(route('collaborator.create.hab'),{}, {
                preserveScroll: true
            })
        },
        cleanUrlSearch(url,string){
            let val = url.split(string+"=")
            if(val[1] !== undefined){
                return val[1].split('&')[0];   
            }else{
                return '';
            }
        },
        openCreateLodging () {
            this.$refs.modalCreateType.openModal()
        },
        openFormCreate () {
            this.$refs.modalCreateForm.openModal()
        },
        requestDisplay(id){
            this.idNoti= id
            $('#display').modal('show')
        },
        openFormEdit (id) {
            console.log('entro al btn')
            this.$refs[`modalEdit${id}`].openModal()
        },
        sendRequest(){
            let id = $('#notidisplay');
            let send = $('#display');
            this.$inertia.get(route('admin.collaborator.lodging.display'),{id:this.idNoti, user_id:this.user.id}, {
                preserveScroll: true,
                onSuccess: (result) => {
                    send.modal('hide')
                    id.modal('show')
                }
            })
        },
        chageFormEdit () {
            this.emitter.emit('chageFormEdit')
        },
        goBack () {
            window.history.back()
        },
    }
}
</script>
<style scoped>
select:focus,
input:focus{
    --tw-ring-shadow:none;
}
.gradient-lodgings{
    background: linear-gradient(90deg, rgba(134,188,217,0) 63%, rgba(1,1,1,1) 90%);
}
@media (max-width:991px){
    .grandient-mobile {
        background: linear-gradient(179deg, rgba(134,188,217,0) 0%, rgba(1,1,1,1) 100%);
    }
}
</style>