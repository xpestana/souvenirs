<template>
    <div class="detalles">
        <div class="container mt-5">
            <div class="row titulo">
                <div class="col-1 text-white">
                    <Link :href="route('collaborator.index')"><i class="fas fa-angle-left bg-info px-2 py-1"></i></Link>	
                </div>
                <div class="col-11">
                    <h1 class="text-center mb-4 titulo text-info display-4"><strong>Ventas totales</strong></h1>
                </div>
            </div>
            <div class="row tabla">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead class="thead-light" >
                                <tr>
                                    <th scope="col">Alojamiento</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Devuelto</th>
                                    <th scope="col">ID de transacción</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Beneficio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>00labc</td>
                                    <td>00labc</td>
                                    <td>M 20</td>
                                    <td>M 20</td>
                                    <td>hola@email.com</td>
                                    <td>04/02/2022</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>00labc</td>
                                    <td>00labc</td>
                                    <td>M 20</td>
                                    <td>M 20</td>
                                    <td>hola@email.com</td>
                                    <td>04/02/2022</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>00labc</td>
                                    <td>00labc</td>
                                    <td>M 20</td>
                                    <td>M 20</td>
                                    <td>hola@email.com</td>
                                    <td>04/02/2022</td>
                                    <td>10</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row pie justify-content-end">
                <div class="col-sm-4 col-md-3 mt-4">
                    <h2 class="text-info"><strong>Total</strong></h2>
                    <p><b>Tu beneficio es de 13€</b></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    layout:TemplateApp,
    props:{
    },
    components:{
        Head,
        Link,
    }
}
</script>

<style scope>
strong{
    font-weight: bold;
}
.pie h2{
    font-size: 2em;
}
</style>