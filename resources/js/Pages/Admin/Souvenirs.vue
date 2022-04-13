<template>
    <div class="container cabeza-souvenirs px-md-2 px-lg-5 pt-md-3">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Gestión de souvenirs</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-3 mb-2 mt-md-5 mb-md-4 opciones px-md-5">
            <div class="col-10 col-md-12 col-lg-4 my-2 my-lg-0  text-center text-md-left">
                <button class="btn btn-outline-azulc rounded-pill py-1 px-3"><i class="fas fa-plus pr-1 pr-lg-3"></i>Agregar souvenir</button>
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
                                                <input type="text" class="w-14 md:w-100 rounded-sm border mr-2 h-8">
                                            </div>
                                            <div class="col-1 col-md-1 text-left px-0"><p class="text-lg">€</p></div>
                                        </div>
                                        <div class="row px-5 mb-4 justify-content-center">
                                            <div class="col-4 text-center px-0 mb-2"><p>ó</p></div>
                                            <div class="col-10 text-center px-0">
                                                <select id="" class="border rounded-sm">
                                                    <option value="">Actualizar valor</option>
                                                    <option value="">14</option>
                                                    <option value="">15</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="row justify-content-center justify-content-md-between px-5">
                                            <div class="col-12 col-md-6 my-2 my-md-0 text-center text-md-left">
                                                <button class="btn btn-primary-c rounded-pill py-0 px-5" data-dismiss="modal" >Volver</button>
                                            </div>
                                            <div class="col-12 col-md-6 my-2 my-md-0 text-center text-md-right">
                                                <button class="btn btn-primary-c rounded-pill py-0">Crear nuevo valor</button>
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
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Mark</td>
                                <td class="text-center">Otto</td>
                                <td class="text-center">@mdo</td>
                                <td class="text-center d-inline-flex d-md-block">
                                    <button class="btn btn-sm py-0 px-1 py-md-1 px-md-1 text-white d-inline mx-1" style="background-color: #c1d4f1">Ver</button>
                                    <button class="btn btn-sm py-0 px-1 py-md-1 px-md-1 text-white d-inline mx-1" style="background-color: #2b59a2">Editar</button>
                                    <button class="btn btn-sm btn-danger py-0 px-1 py-md-1 px-md-1 d-inline mx-1">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
export default {
    layout:Layout,
    components:{
        
    },
    data(){
		return{
			formSearch: this.$inertia.form({
				search: null,
			}),
		}
	},
    methods:{
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
				this.formSearch.get(this.route('admin.colaboradores'), {
					preserveScroll: true,
				});
			},1500);
		},
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