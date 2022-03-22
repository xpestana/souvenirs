<template>
    <Head title="Alojamientos"/>
    <div class="detalles">
        <div class="container mt-5">
            <div class="row cabeza">
                <div class="col-1 text-white volver-icon">
                    <Link :href="route('collaborator.index')"><i class="fas fa-angle-left bg-info"></i></Link>	
                </div>
                <div class="col-11">
                    <h1 class="text-center mb-4 titulo text-info"><strong>Ventas de {{hotel.calle}} {{hotel.planta}}</strong></h1>
                </div>
            </div>
            <div class="row cuerpo">
                <div class="col-12 col-md-3 text-center">
                    <p class="text-info mb-4"><strong class="pr-2">Ventas totales</strong><i class="fas fa-angle-right rounded-circle bg-info text-white px-2 py-1"></i></p>
                    <img class="rounded-circle m-auto" :src="'/storage/hotel'+hotel.image" alt="">
                    <h6 class="mt-3"><strong>Piso {{hotel.planta}}</strong></h6>
                    <p class="ventas">VENTAS</p>
                </div>
                <div class="col-12 col-md-9">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-active">
                            <thead>
                                <tr>
                                    <th scope="col">ID transacción</th>
                                    <th scope="col">Devuelto</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Beneficio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>00labc</td>
                                    <td>M 20</td>
                                    <td>hola@email.com</td>
                                    <td>04/02/2022</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>00labc</td>
                                    <td>M 20</td>
                                    <td>hola@email.com</td>
                                    <td>04/02/2022</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>00labc</td>
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
            <div class="row pie">
                <div class="col-md-5 offset-7 col-md-3 offset-md-9">
                    <h2 class="text-info">Total</h2>
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
        hotel:Object
    },
    components:{
        Head,
        Link,
    }
}
</script>

<style scope>
.cabeza .titulo{
    font-size: 4em;
    padding: 0 110px;
}
.cabeza .volver-icon i{
    
    padding: 5px 10px;
}
.cuerpo img{
    max-height: 125px;
}
.pie h2{
    font-size: 2em;
}
/* responsive*/
@media (max-width:767px){
    .cabeza .titulo{
        font-size: 2em;
        padding: 0 5px;
    }
    .pie h2{
        margin-top: 10px;
    }
    .cuerpo .ventas{
        margin-bottom: 15px;
    }
}
</style>