<template>
 <Head title="Alojamientos"/>
 <div class="container">
    <div class="main">
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h1>¿Necesitas ayuda?</h1>
                <p>Atención especializada</p>
                <p>(+34) 777 777 777</p>
            </div>
            <div class="col-12 text-center">
                <template v-if="hotels.length == 0">
                    <a href="javascript:void(0)" class="btn btn-outline-info boton-inicio" @click.prevent="lodging"> <i class="fas fa-plus"></i>Añadir alojamiento</a>
                </template>
                <template v-else>
                    <section id="cabecera">
                        <div class="container">
                            <div class="row caja-info">
                                <div class="col-12 col-md-9 info-boton">
                                    <Link type="button" class="btn btn-outline-info boton" as="button"><i class="fas fa-plus"></i>Añadir alojamiento</Link>
                                    <h5 class="text-info p-3">Ventas totales<i class="fas fa-angle-right p-1"></i></h5>
                                </div>
                                <div class="col-12 col-md-3 info-total">
                                    <h3 class="text-info"><strong>Total</strong></h3><br>
                                    <h4><strong>Beneficio 334€</strong></h4><br>
                                    <h4><strong>Pedidos 15</strong></h4><br>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="alojamientos">
                        <div class="container">
                            <div v-for="hotel in hotels" :key="hotel.id" class="row tarjeta mt-2 p-3">
                                <div class="col-12 col-md-2 p-0">
                                    <img class="img-foto w-100" :src="'/storage/hotel'+hotel.image" >
                                </div>
                                <div class="col-12 col-md-8 texto">
                                    <p>{{hotel.type.toUpperCase()}}</p>
                                    <h1 class="pt-1 pb-2">{{hotel.calle}} {{hotel.planta}}</h1>
                                    <div class="estadistica">
                                        <p class="px-2">Benefecio total 334€</p>
                                        <p class="px-2">Pedidos totales: 8</p>
                                        <p class="text-primary px-2">Obtener QR</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 p-0 my-auto botones">
                                    <button class="btn btn-info w-75 my-1 py-0 text-white">Ver más</button>
                                    <button class="btn btn-secondary w-75  my-1 py-0">Editar</button>
                                </div>
                            </div>
                        </div>  
                    </section>
                </template>
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
		components:{
			Head,
           Link,
       },
       props: {
        hotels: Object,
        },
        methods: {
            lodging(){
                this.$inertia.get(route('collaborator.create.hab'),{}, {
                    preserveScroll: true
            })
        }
    }
}
</script>
<style scope>
body{
    background-color: transparent;
}
.main h1{
    font-size: 2em;
    font-weight: bolder;
}
.main .boton-inicio{
    padding: 10px 50px;
    font-size: 25px;
    margin-top: 50px;
    border-radius:20px;
}
.main .boton-inicio i{
    padding-right: 20px;
}
.main .boton-inicio:hover{
    color:#fff;
}

/* responsive main */
@media (max-width:450px){
    .main .boton-inicio{
        padding: 10px;
    }
    .main .boton-inicio i{
        padding-right: 5px;
    }
}
/*estilo templates*/ 
.containter{
    max-width: 75% !important;
}
#cabecera h1{
    font-size: 2em;
    font-weight: bolder;
}
#cabecera .boton{
    padding: 5px 40px;
    border-radius:20px;
}
#cabecera .info-boton{
    text-align: left;
}
#cabecera .info-boton .boton i{
    padding-right: 20px;
}
#cabecera .boton:hover{
    color:#fff;
}
#cabecera .caja-info .info-total{
    line-height: 0;
    font-size: 21px;
}
#alojamientos .tarjeta{
    box-shadow: 0px -1px 10px 4px rgba(0,0,0,0.47);
    -webkit-box-shadow: 0px -1px 10px 4px rgba(0,0,0,0.47);
    -moz-box-shadow: 0px -1px 10px 4px rgba(0,0,0,0.47);
}
#alojamientos .tarjeta{
    box-shadow: 1px 1px 3px 3px rgba(0 0 0 / 20%);
}
#alojamientos .tarjeta .texto p{
    color:#999;
    text-align: left;
}
#alojamientos .tarjeta .botones{
    text-align: right;
}
#alojamientos .tarjeta h1{
    font-size: 30px;
    font-weight: bold;
    text-align: left;
}
#alojamientos .tarjeta img{
    max-height: 100px;
}
#alojamientos .tarjeta .estadistica{
    display: inline-flex;
    float:left;
}
#alojamientos .tarjeta .estadistica p{
    padding-top:0.5em;
}
/* responsive */
@media (max-width:450px){
    #cabecera .boton{
        padding: 10px;
    }
    #cabecera .boton i{
        padding-right: 5px;
    }
}
@media (max-width:930px){
    .container{
        max-width: 90%;
    }
}
@media (max-width:767px){
    #alojamientos .tarjeta .estadistica{
        display: block;
    }
    #alojamientos .tarjeta img{
        max-height: 225px;
    }
    #alojamientos .tarjeta .estadistica p{
        padding-top:0;
    }
    #alojamientos .tarjeta .botones{
        text-align: center;
        padding: 15px !important;
    }
    #cabecera .caja-info{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    #cabecera .info-boton{
        text-align: center;
    }
}
</style>