<template>
  
  <div class="container vh-100">
    <div class="row">
        <div class="col-4 bg-sm-white"></div>
        <div class="col-8  vh-100 barra-azul"></div>
		<div class="col  vh-100  bg-opacity-25 cortina">
			<div class="d-flex justify-content-between">
                <div class="mt-3 logo-caja">
                    <img src="https://hicitty.com/vendor_asset/img/logo/logo.png">
                </div>
                <div class="mt-5 mt-sm-4 ml-sm-5">
                    <!-- <button type="button" class="btn btn-light ml-0 ml-sm-auto boton px-sm-4 py-sm-2">Iniciar sesión<i class="fa-solid fa-user-group pl-1"></i></button> -->
                    <Link :href="route('login')" class="btn btn-light text-primary px-2 py-1 mr-2">Iniciar sesión<i class="fas fa-user-friends pl-2"></i> </Link>
                </div>
            </div>

            <div class="caja-principal d-flex align-items-center justify-content-center justify-content-lg-around">
                
                    <div class="mx-5 pl-lg-5 d-block-flex mt-5 mt-md-5 text-center text-sm-left">
                        <h1 class="display-3 titulo">Registra <br>tu <br> alojamiento</h1>
                        <br>
                        <div class="d-sm-none">
                            <div class="d-flex fs-beneficios text-muted text-start texto-responsive">
                                <i class="fa-solid fa-circle-check pt-2 pl-3"></i>
                                <p class="">Darse de alta es gratis</p>
                            </div>
                            <div class="d-flex fs-beneficios text-muted text-start">
                                <i class="fa-solid fa-circle-check pt-2 pl-3"></i>
                                <p class="">Nueva linea de ingresos sin trabajo adicional</p>
                            </div>
                            <div class="d-flex fs-beneficios text-muted text-start">
                                <i class="fa-solid fa-circle-check pt-2 pl-3"></i>
                                <p class="">Aumentamos tus valoraciones</p>
                            </div>
                            <div class="d-flex fs-beneficios text-muted text-start">
                                <i class="fa-solid fa-circle-check pt-2 pl-3"></i>
                                <p class="">Mejoramos la experiencia de tus inquilinos</p>
                            </div>
                        </div>
                        <div>
                            <p class="lh-1 text-muted"><small>Darse de alta son solo unos minutos¡Empieza hoy mismo!</small></p>
                            <p class="text-primary lh-1"><small>Crea un cuenta de <b>colaborador</b> para empezar</small></p>
                        </div>
                        <div class="d-flex ps-5 m-4">
                            <Link :href="route('collaborator.register')" class="btn btn-primary align-self-center rounded-pill px-4 py-1 ml-lg-5 text-center">Empezar</Link>
                        </div>
                        
                    </div>
                    <div class="text-white mx-lg-5 d-block px-lg-5 beneficios beneficios-escritorio">
                        <div class="d-flex fs-beneficios my-2">
                            <i class="far fa-check-circle pt-2 pe-3"></i>
                            <p class="fw-bold beneficios-text m-2">Darse de alta es gratis</p>
                        </div>
                        <div class="d-flex fs-beneficios my-2">
                            <i class="far fa-check-circle pt-2 pe-3"></i>
                            <p class="fw-bold beneficios-text m-2">Nueva linea de ingresos sin trabajo adicional</p>
                        </div>
                        <div class="d-flex fs-beneficios my-2">
                            <i class="far fa-check-circle pt-2 pe-3"></i>
                            <p class="fw-bold beneficios-text m-2">Aumentamos tus valoraciones</p>
                        </div>
                        <div class="d-flex fs-beneficios my-2">
                            <i class="far fa-check-circle pt-2 pe-3"></i>
                            <p class="fw-bold beneficios-text m-2">Mejoramos la experiencia de tus inquilinos</p>
                        </div>
                    </div>
            </div>


		</div>
    </div>
</div>

</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        BreezeButton,
        Link
    }
}
</script>

<style scoped>
    .logo-caja img{
        height: 100px;
    }
    .fw-bold{
        font-weight: bold;
    }
    .fs-beneficios{
        font-size: 1.5em;
        color: #fff;
    }
    .beneficios-text{
        font-size: 1em;
        color:#fff;
    }
    .titulo{
        line-height: 0.8em;
        letter-spacing: 1px;
        font-weight: bold;
    }
    .boton{
        color:rgba(95, 153, 156, 1);
        font-weight: 500;
    }
    .cortina{
        background: radial-gradient(closest-side,rgba(255,255, 255, 0), rgba(255,255, 255, 0.70));
        position: absolute;
    }
    .beneficios{
        width: 40%;
    }
    .barra-azul{
        background: #6fb2c6;
    }
    .container{
    	min-width: 100%;
    }
    .vh-100{
    	height: 100vh;
    }
    .caja-principal{
    	height: 75%;
    	width: 100%;
    }

    @media screen and (max-width: 840){
        .beneficios-escritorio{
            display: none;
        }
    }
</style>