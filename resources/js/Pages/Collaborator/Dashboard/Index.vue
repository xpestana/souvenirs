<template>
 <Head title="Alojamientos"/>
 <div class="container">
    <div class="caja">
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h1>¿Necesitas ayuda?</h1>
                <p>Atención especializada</p>
                <p>(+34) 777 777 777</p>
            </div>
            <div class="col-12 text-center">
                <template v-if="hotels.length == 0">
                    <a href="javascript:void(0)" class="btn btn-outline-info boton" @click.prevent="lodging"> <i class="fas fa-plus"></i>Añadir alojamiento</a>
                </template>
                <template v-else>
                    <section id="cabecera">
                        <div class="container">
                            <div class="row caja-info">
                                <div class="col info-boton">
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
                            <div class="row tarjeta mt-2 p-3">
                                <div class="col-12 col-md-2 p-0">
                                    <img class="img-foto w-100" src="/vendor_asset/img/team/Quienes-somos.jpg" >
                                </div>
                                <div class="col-12 col-md-8 texto">
                                    <p>APARTAMENTO</p>
                                    <h1 class="pt-1 pb-2">C/Real N.2 Letra A</h1>
                                    <div class="estadistica">
                                        <p class="px-2">Benefecio total 334€</p>
                                        <p class="px-2">Pedidos totales: 8</p>
                                        <p class="text-primary px-2">Obtener QR</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 p-0 my-auto botones">
                                    <button class="btn btn-info w-75 my-1 py-0 text-white">Ver más</button>
                                    <button class="btn btn-secondary w-75    my-1 py-0 ">Editar</button>
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
        },
    }
}
</script>
<style scope>
	body{
		background-color: transparent;
	}
	.caja h1{
        font-size: 2em;
        font-weight: bolder;
    }
    .caja .boton{
        padding: 10px 50px;
        font-size: 25px;
        margin-top: 50px;
        border-radius:20px;
    }
    .caja .boton i{
        padding-right: 20px;
    }
    .caja .boton:hover{
        color:#fff;
    }

/* responsive */
@media (max-width:450px){
    .caja .boton{
        padding: 10px;
    }
    .caja .boton i{
        padding-right: 5px;
    }
}
.containter{
    max-width: 75%;
}
#cabecera h1{
    font-size: 2em;
    font-weight: bolder;
}
#cabecera .boton{
    padding: 5px 40px;
    border-radius:20px;
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
}
#alojamientos .tarjeta .botones{
    text-align: right;
}
#alojamientos .tarjeta h1{
    font-size: 30px;
    font-weight: bold;
}
#alojamientos .tarjeta img{
    max-height: 100px;
}
#alojamientos .tarjeta .estadistica{
    display: inline-flex;
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
}
</style>