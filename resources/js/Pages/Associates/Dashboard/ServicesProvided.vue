<template>
    <div class="container px-0 px-lg-5 pt-md-5">
        <section id="info" class="text-center">
            <h1 class="font-weigth-bolder text-xl">
                Ponte en contacto con tu administrador<br> 
                para habilitar estas funcionalidades
            </h1>
            <p>Atención especializada</p>
            <p>(+34) 777 777 777</p>
        </section>
        <section id="tabla" hidden>
        <div class="container-fluid px-0 px-md-5">
            <div class="row cabeza mx-lg-4">
                <div class="col-12 my-md-4">
                    <h1 class="text-center mb-4 titulo text-azulc text-2xl md:text-4xl"><strong>Ventas de los <br> servicios prestados</strong></h1>
                </div>
            </div>
            <div class="row tabla">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-light" >
                                <tr>
                                    <th class="text-center" scope="col">Servicio</th>
                                    <th class="text-center" scope="col">Fecha</th>
                                    <th class="text-center" scope="col">Personas</th>
                                    <th class="text-center" scope="col">Precio ud</th>
                                    <th class="text-center" scope="col">Precio total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Tour 1</td>
                                    <td class="text-center">02/05/2022</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">20</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Tour 1</td>
                                    <td class="text-center">02/05/2022</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">20</td>
                                </tr>
                                <tr hidden>
                                    <td colspan="8" class="text-center">Sin pedidos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-2 pie justify-content-md-end my-4">
                <div class="col-12 col-md-6">
                    <h2 class="text-azulc text-2xl font-weight-bolder text-right">Total 22€</h2>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
<script>
import Paginator from '@/Components/Paginator'
import { Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Pages/Associates/Layouts/Layout'
export default {
	layout:Layout,
	components: {
		Paginator,
		Link
	}
}
</script>
<style scoped>
</style>