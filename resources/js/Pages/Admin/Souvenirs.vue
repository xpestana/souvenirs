<template>
    <div class="container cabeza-souvenirs px-md-2 px-lg-5 pt-md-3">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Gestión de souvenirs</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-3 mb-2 mt-md-5 mb-md-4 opciones px-md-5">
            <div class="col-10 col-md-12 col-lg-4 my-2 my-lg-0  text-center text-md-left">
                <Link :href="route('admin.souvenirs.create')" class="btn btn-outline-azulc rounded-pill py-1 px-3"><i class="fas fa-plus pr-1 pr-lg-3"></i>Agregar souvenir</Link>
            </div>
            <div class="col-10 col-md-6 col-lg-4 pt-md-1 pl-lg-5 my-2 my-md-0 text-center text-md-left text-lg-center">
                <button class="btn btn-sm bg-azulc text-white py-1 px-5" data-toggle="modal" data-target="#envio">Envío gratuito</button>
                    <!-- Central Modal Small -->
                    <div class="modal fade" id="envio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <!-- Change class .modal-sm to change the size of the modal -->
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content mx-auto" style="width:100% !important">
                                <div class="modal-body py-5 px-0">
                                    <div class="container-fluid px-0">
                                        <div class="row px-5 mb-4">
                                            <div class="col-12 col-md-7 px-0">
                                                <h2 class="text-lg">Envío gratuito a partir de</h2>
                                            </div>
                                            <div class="col-7 col-md-2 px-0 text-right text-md-left">
                                                <input type="text" class="w-14 md:w-100 rounded-sm border mr-2 h-8" id="shippings" v-model="form.shippings" autocomplete="settings" placeholder="..€">
                                            </div>
                                            <div class="col-1 col-md-1 text-left px-0"><p class="text-lg">€</p></div>
                                        </div>
                                        <div class="row px-5 mb-4 justify-content-center">
                                            <div class="col-4 text-center px-0 mb-2"><p>Actualizar valor</p></div>
                                            <div class="col-10 text-center px-0">
                                                <form @submit.prevent="updt_current" @change="updt_current">
                                                    <select id="current" v-model="form.current" class="border rounded-sm">
                                                        <option v-for="setting in settings" :key="setting.id" :value="setting.id">{{ setting.shippings }}</option>
                                                    </select>
                                                </form>
                                            </div>
                                            <div class="col-12 my-2">
                                                <ValidationErrors/>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center justify-content-md-between px-5">
                                            <div class="col-12 col-md-6 my-2 my-md-0 text-center text-md-left">
                                                <button class="btn btn-primary-c rounded-pill py-0 px-5" data-dismiss="modal" >Volver</button>
                                            </div>
                                            <div class="col-12 col-md-6 my-2 my-md-0 text-center text-md-right">
                                                <button class="btn btn-primary-c rounded-pill py-0" @click="submit">Crear nuevo valor</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Central Modal Small -->
            </div>
            <div class="col-10 col-md-6 col-lg-4 pt-md-1 pl-md-5 my-2 my-md-0 text-center text-md-right">
                <div class="input-search m-0">
                    <span class="fa fa-search text-muted position-absolute d-none d-lg-block text-md-right ml-md-2"></span>
                    <input type="text" class="rounded-sm border md:pl-8 h-9" placeholder="Search" v-model="formSearch.search" @keyup.prevent="search">
                </div>
            </div>
        </div>
    </div>
    <div class="container tabla-souvenirs px-0 px-md-2 px-lg-5">
        <div class="row mt-2 px-md-5">
            <div class="col-12">
                <div class="table-responsive-md bg-white">
                    <table class="table table-striped table-borderless">
                        <thead class="table-active text-center">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <template v-if="data.length > 0">
                                <tr v-for="product in data" :key="product.id">
                                    <td class="text-center">{{ product.title_en }}</td>
                                    <td class="text-center">{{ product.price }}</td>
                                    <td class="text-center">{{ product.stock }}</td>
                                    <td class="text-center">{{ product.category }}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                        <Link class="btn btn-sm py-0 px-1 py-md-1 px-md-1 text-white d-inline mx-1" :href="route('souvenirs.show',{souvenir: product.id})" title="Ver Souvenir" style="background-color: #c1d4f1"> Ver </Link>
                                        <Link class="btn btn-sm py-0 px-1 py-md-1 px-md-1 text-white d-inline mx-1" :href="route('admin.souvenirs.edit',{id:product.id,numPage:numPaginate})" style="background-color: #2b59a2">Editar</Link>
                                        <button class="btn btn-sm btn-danger py-0 px-1 py-md-1 px-md-1 d-inline mx-1" @click="deleteProduct(product.id)">Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr v-if="data.length < 1">
                                <td colspan="5" class="text-center">No hay resultados para la busqueda</td>
                            </tr>
                            <tr v-if="carga">
                                <td colspan="5" class="text-center">
                                    <div class="spinner-border text-info text-center" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 flex justify-center mb-4" v-if="showPagination">
                <paginator :paginator="products" />
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Pages/Admin/Layouts/Layout'
import Paginator from '@/Components/Paginator.vue'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
export default {
    layout:Layout,
    props: {
		settings: Object,
        products:Object
	},
    components:{
        Paginator,
        Link,
        ValidationErrors
    },
    mounted(){
		this.busquedaInput()
	},
    data(){
		return{
            data: (this.products.data) ? this.products.data : this.products,
			formSearch: this.$inertia.form({
				search: null,
			}),
            form: this.$inertia.form({
                shippings: null,
                current: null,
            }),
            error:false,
            carga:false,
            showPagination:true,
		}
	},
    methods:{
        busquedaInput(){
			let input = this.$page.url.split("?search=","2")[1];
			if(input !== undefined){
                let limpio = input.split('%')
				this.formSearch.search = limpio[0];	
                this.showPagination=false
			}
            if(input == ''){
                this.showPagination=true
            }
		},
        search() {
			this.data = {};
            this.carga = true
			setTimeout(()=>{
				this.formSearch.get(this.route('admin.souvenirs'), {
					preserveScroll: true,
                    onSuccess: () => {
                        this.carga = false
                    },
				});
			},1500);
		},
        submit() {
                var shippings = document.getElementById('shippings').value;
                const idmodal = $('#envio');
                this.form.shippings = shippings;
                this.form.post(route('settings.shippings.create'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    onSuccess: () => {
                        idmodal.modal('hide');
                        this.form.shippings = '';
                        this.error=false;
                    },
                })
        },
        updt_current() {
            var current = document.getElementById('current').value;
            const idmodal = $('#envio');
        this.form.current = current;
            this.form.post(route('settings.shippings.update', {id:current}),{
                _token: this.$page.props.csrf_token,
                errorBag: 'updt_current',
                preserveScroll: true,
                onSuccess: () => {
                    idmodal.modal('hide');
                },
            })
        },
        deleteProduct(product){
            this.$swal({
                title: '¿Estas seguro?',
                text: "Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.delete(route('souvenirs.destroy',{souvenir : product}),{
                            onSuccess: () => {
                                location.reload();
                            }
                        })
                    }
                })
        }
    },
    computed:{
        settings(){
            const obj = this.settings.map((col)=>{
                if(col.active == 1){
                    this.form.current = col.id;
                }
                return {
                    id : col.id,
                    shippings: col.shippings,
                    active: col.active,
                }
            });
            return obj;
        },
        numPaginate(){
            let num = this.$page.url.split("?page=","2")[1];
            return num == undefined ? 1 : num;
        }
    }
}
</script>

<style>
.cabeza-souvenirs .opciones .input-search span{
    z-index: 2;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    pointer-events: none;
}
</style>