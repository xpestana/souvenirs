<template>
  
<div class="section cuerpo">
    <div class="section cabezera"> 
        <div class="container">
            <div class="row mb-2 mb-md-0">
                <div class="col-6 logo-caja">
                    <img class="w-28 md:w-44" src="/vendor_asset/img/logo/hilogo.png">
                </div>
                <div class="col-6 text-right boton">
                    <Link :href="route('login')" class="btn btn-primary iniciar md:px-4 md:py-2 md:mt-1">Log in<i class="fas fa-user-friends fas fa-user-friends pl-0 pl-md-2"></i> </Link>
                </div>
            </div>
        </div>
    </div>

    <div class="section inicio"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left head-registra">
                <h1 class="titulo text-5xl md:text-6xl">Register   <br>your <br> lodging</h1>
                <p class="r-1"><small>Signing up is just a few minutes. Get started today!</small></p>
                <p class="r-2"><small>Create an account <b>collaborator</b> to get started</small></p>
                    
                <Link :href="route('collaborator.register')" type="button" class="btn btn-primary empezar">Begin</Link>
                    
            </div>
                            
            <div class="col-md-6 beneficios">     
                
                <div class="d-flex fs-beneficios my-2">
                    <i class="far fa-check-circle pt-2 pe-3"></i>
                    <p class="fw-bold beneficios-text m-2">Signing up is free</p>
                </div>
                <div class="d-flex fs-beneficios my-2">
                    <i class="far fa-check-circle pt-2 pe-3"></i>
                    <p class="fw-bold beneficios-text m-2">New line of income without additional work</p>
                </div>
                <div class="d-flex fs-beneficios my-2">
                    <i class="far fa-check-circle pt-2 pe-3"></i>
                    <p class="fw-bold beneficios-text m-2">We increase your ratings</p>
                </div>
                <div class="d-flex fs-beneficios my-2">
                    <i class="far fa-check-circle pt-2 pe-3"></i>
                    <p class="fw-bold beneficios-text m-2">We improve the experience of your tenants</p>
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
a.btn.btn-primary.iniciar {
    background-color: #fff;
    color: #3490dc;
    font-weight: 600;
}
.section.inicio {
    margin-top: 100px;
}
p.r-1 {
    font-size: 24px;
    color: #6c757d;
    margin-top: 30px;
}
p.r-2 {
    font-size: 24px;
    color: #3490dc;
    margin-top: 24px;
}
.fs-beneficios{
        font-size: 1.5em;
        color: #fff;
    }
.beneficios-text{
        font-size: 1.2em;
        color:#fff;
    }
    a.btn.btn-primary.empezar {
    background: #5d7ffb;
    font-size: 25px;
    padding-left: 35px;
    padding-right: 35px;
    border-radius: 30px;
    margin-top: 40px;
}
.section.cuerpo {
    background-image: url(/vendor_asset/img/fondo-inicio.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    padding-top: 25px;
    padding-bottom: 200px;
}
/* responsive */
@media (max-width: 576px) { 
    .beneficios p {
    color: #6c757d !important;
}
.beneficios {
    margin-top: 35px;
}
i.far.fa-check-circle.pt-2.pe-3 {
    color: #6c757d;
}
.head-registra {
    background: rgb(190 229 240);
    padding-top: 60px;
    padding-bottom: 60px;
}
.section.inicio {
    margin-top: 0px;
}
}
</style>