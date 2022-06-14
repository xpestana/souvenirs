<template>
<div>
<ModalCookies/>
</div>                    
<section id="collaborator" class="container-fluid">
    <div class="d-none d-md-block">
        <HomeMenu/>
    </div>
    <div class="d-md-none">
        <MenuMobile/>
    </div>
    
    <section id="banner">
        <div class="row pb-14 md:pb-0">
            <div class="d-md-none banner-overlay"></div>
            <div class="col-12 col-md-6 pt-44 pl-12">
                <div class="title">
                    <h1 class="text-5xl md:text-7xl font-weight-bolder">
                        Mejora la <span class="text-collaborator">experiencia</span> de los huéspedes
                    </h1>
                </div>
                <div class="banner-text">
                    <p class="text-justify pt-2 text-xl pr-16 md:pr-0">
                        Aumenta los beneficios y las reseñas de tu
                        alojamiento ofreciendo una gran variedad de servicios
                    </p>
                </div>
                <div class="pt-8 d-flex flex-column flex-md-row">
                    <Link :href="route('collaborator.register')"  class="btn btn-collaborator w-48 text-xl mr-4 mx-auto my-2">Regístrate</Link>
                    <Link :href="route('login')" class="btn btn-outline-collaborator w-48 text-xl mx-auto my-2">Iniciar Sesión</Link>
                </div>
            </div>
            <div class="d-none  d-md-block col-md-6 pt-16">
                <div class="relative">
                    <img src="/vendor_asset/img/collaborator/banner1.png" class="absolute left-0 top-10" width="200">
                    <img src="/vendor_asset/img/collaborator/banner2.png"  class="absolute top-16 right-8" width="200">
                    <img src="/vendor_asset/img/collaborator/bannercenter.png" width="450" class="mx-auto">
                    <img src="/vendor_asset/img/collaborator/banner3.png"  class="absolute left-6 bottom-6" width="160">
                </div>
            </div>
    </div>
    </section>
    <section id="direction">
        <div class="row mt-28 justify-content-center">
            <div class="col-12 col-md-9 px-12 md:px-0">
                <h1 class="text-center text-3xl md:text-5xl">¿A quién está dirigido?</h1>
                <p class="text-center text-xl md:text-3xl mt-6 md:mt-14">
                    Desde <b>Hicitty</b> ayudamos a que los huéspedes de los hoteles
                    y apartamentos tengan la mejor y más plena de las experiencias
                </p>
                <p class="text-center text-base md:text-xl mt-12">
                    Por lo tanto esto te interesa si <b>gestionas</b> alguno de los
                    <br>siguientes establecimientos:
                </p>
            </div>
        </div>
        <div class="row my-16  justify-content-center justify-content-md-around md:px-40">
            <button class="btn btn-collaborator direction-btn text-2xl col-7 col-md-3 my-4 md:my-0">Apartamentos <br> turísticos</button>
            <button class="btn btn-collaborator direction-btn text-2xl  col-7 col-md-3 py-4 md:py-8 my-4 md:my-0">Hoteles</button>
            <button class="btn btn-collaborator direction-btn text-2xl  col-7 col-md-3  my-4 md:my-0">Negocios <br> turísticos</button>
        </div>
    </section>
    <section id="offer">
        <div class="row my-16  justify-content-around px-2 md:px-32 pt-28">
            <div class="col-12">
                <h1 class="text-center text-4xl md:text-5xl text-white md:pl-24 mb-8 md:mb-0">¿Qué ofrecemos?</h1>
            </div>
            <div class="col-md-4">
                <img class="h-64 mx-auto" src="/vendor_asset/img/collaborator/section1.png" alt="">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <p class="text-white text-xl my-4">
                            Pon al alcance de los huéspedes una gran variedad de <br>
                            experiencias y servicios que ofrecemos desde <b>Hicitty</b> para la
                            ciudad que van a visitar.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 offer-item">
                        <div class="offer-title">
                            <img src="/vendor_asset/img/collaborator/kayak.svg" class="d-inline w-8">
                            <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Experiencias</p>
                        </div>
                        <div class="offer-title">
                            <p class="text-base text-white pl-11">
                                El huésped podra escoger y reservar entre una gran cantidad de actividades  experiencias
                                propias de la ciudad en la que se encuentra, como <b>tours guiados, espetáculos locales....</b>
                            </p>
                        </div>
                    </div>    
                    <div class="col-12 col-md-6 offer-item">
                        <div class="offer-title">
                            <img src="/vendor_asset/img/collaborator/regalo.svg" class="d-inline w-8">
                            <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Souvenirs</p>
                        </div>
                        <div class="offer-title">
                            <p class="text-base text-white pl-11">
                                Desde los típicos <b>imanes, postales y démas recuerdos</b> hasta souvenirs gastrinómicos
                                como <b>quesos, vinos, productos, típicos de la ciudad....</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 offer-item mt-3">
                        <div class="offer-title">
                            <img src="/vendor_asset/img/collaborator/informacion.svg" class="d-inline w-8">
                            <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Información turística</p>
                        </div>
                        <div class="offer-title">
                            <p class="text-base text-white pl-11">
                                Ofrece toda la información relevante y de interés de la ciudad para que el
                                huésped no se pierda nada.<br>
                                Encontrará <b>guías de qué hacer, que visitar,donde comer, lugares de ocio, rutas....</b>
                            </p>
                        </div>
                    </div>  
                    <div class="col-12 col-md-6 offer-item  mt-3">
                        <div class="offer-title">
                            <img src="/vendor_asset/img/collaborator/viajeros.svg" class="d-inline w-8">
                            <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Y mucho más</p>
                        </div>
                        <div class="offer-title">
                            <p class="text-base text-white pl-11">
                                No todo tiene que ser turismo. Ofrece también una variedad de servicios que
                                mejoren la experiencia del huésped como; <b>spa, tranfers, co-working, lavandería....</b>
                            </p>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </section>
    <section id="slide">
        <div class="row md:my-10">
            <div class="col-12">
                <h1 class="text-center text-3xl md:text-5xl md:pl-24 mb-8 md:mb-0">¿Cómo lo hacemos?</h1>
            </div>
            <div class="col-12 col-md-6 pl-4 md:pl-28 md:mt-4">
                <h2 class="text-2xl font-weight-bolder">
                    1. <span class="text-collaborator">Registro</span> en la plataforma<br>
                    y <span class="text-collaborator">alta</span> de los inmuebles
                </h2>
                <p class="text-base md:text-xl mt-4 md:leading-8">
                    Regístrate en menos de 1 minuto y da de alta tus inmuebles para que podamos enviar
                    los elementos de impacto personalizados.
                </p>
            </div>
            <div class="col-12 col-md-6">
                <img src="/vendor_asset/img/collaborator/slide1.png" alt="img" class="w-3/4 mx-auto">
            </div>
        </div>
    </section>
    <section id="result">
        <div class="row my-16  justify-content-around md:px-32 pt-16 md:pt-44">
            <div class="col-12">
                <h1 class="text-center text-5xl text-white mb-16">¿Cuál es el resultado?</h1>
            </div>
            <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-light p-3 result-card shadow-lg">
                <div class="card-icon">
                    <img src="/vendor_asset/img/collaborator/viajeros.svg" alt="img-card" class="w-24 mx-auto">
                </div>
                <div class="card-title">
                    <h3 class="text-lg text-center font-weight-bolder">
                        Mejorar la experiencia de los inquilinos
                    </h3>
                </div>
                <div class="card-text">
                    <p class="text-base">
                        Ofrece un gran variedad de servicios a los huéspedes que 
                        les permita disfrutar de una mejor experiencia.
                    </p>
                </div>
            </div>
            <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-light p-3 result-card shadow-lg">
                <div class="card-icon">
                    <img src="/vendor_asset/img/collaborator/valoracion.svg" alt="img-card" class="w-24 mx-auto">
                </div>
                <div class="card-title">
                    <h3 class="text-lg text-center font-weight-bolder">
                        Aumentar las valoraciones
                    </h3>
                </div>
                <div class="card-text">
                    <p class="text-base">
                        Al mejorar la experiencia de los inquilinos, les incentivaremos que dejen
                        una buena valoración sobre el sitio donde se han alojado.
                    </p>
                </div>
            </div>
            <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-light p-3 result-card shadow-lg">
                <div class="card-icon">
                    <img src="/vendor_asset/img/collaborator/dinerobolsa.svg" alt="img-card" class="w-24 mx-auto">
                </div>
                <div class="card-title">
                    <h3 class="text-lg text-center font-weight-bolder">
                        Añadir una nueva línea de ingresos
                    </h3>
                </div>
                <div class="card-text">
                    <p class="text-base">
                        Recibirás el 20% de todo los que el cliente haya comprado sin tener que invertir
                        un mínimo de tiempo y trabajo.
                    </p>
                </div>
            </div>
            <div class="col-12">
                <p class="text-center pt-8 md:pt-16 text-2xl md:text-3xl text-white">Y lo mejor de todo</p>
                <h1 class="text-center text-3xl md:text-5xl text-white mt-6 px-8 md:px-0">Sin invertir tiempo ni dinero</h1>
            </div>
        </div>
    </section>
    <section id="win">
        <div class="row my-16">
            <div class="col-12 md:px-48">
                <h1 class="text-center text-3xl md:text-6xl font-weight-bolder">
                    Empieza a ganar <br> con Hicitty
                </h1>
                <p class="text-center text-xl md:text-2xl mt-4">
                    Estás a un solo paso de empezar a sacar el máximo partido de tus inmuebles.
                    Regístrate y empieza a ganar.
                </p>
                <div class="text-center mt-8">
                    <div class="d-md-inline pl-8 mb-6">
                        <i class="fas fa-check p-2 text-white rounded" style="background-color:#aacfe4;"></i>
                        <p class="text-2xl d-inline mr-4 font-weight-bolder">
                            Sin esfuerzo    
                        </p>
                    </div>
                    <div class="d-md-inline">
                        <i class="fas fa-check p-2 text-white rounded" style="background-color:#aacfe4;"></i>
                        <p class="text-2xl d-inline font-weight-bolder">
                            100% Gratis    
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 my-14 text-center ">
                <Link :href="route('collaborator.register')" class="btn btn-collaborator text-xl w-72">¡Quiero registrarme!</Link>
            </div>
        </div>
    </section>
    <section id="footer">
        <div class="row relative">
            <div class="px-48 hicitty h-32 md:h-96 w-100">
                <img class="absolute left-0" src="/vendor_asset/img/collaborator/footerhiccity.svg" alt="">
            </div>
            <div class="col-12 foot" style="background-color:#000">
                <div class="row justify-content-between pb-8">
                    <div class="col-12 col-md-4 px-8">
                        <h1 class="text-4xl md:text-5xl text-white py-8 pr-12 md:pr-0">
                            Solo ganamos si tu ganas     
                        </h1>
                        <p class="text-sm text-white">
                            Copyright ©2022 HiCitty. Todos los derechos reservados 
                        </p>
                    </div>
                    <div class="col-12 col-md-4 px-8 px-md-2 pt-12 md:pl-24">
                        <div class="">
                            <p class="text-white">Visita nuestra web</p>
                            <Link :href="route('home')">
                            <img class="w-24 mr-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
                            </Link>
                        </div>
                        <div class="mt-4">
                            <p class="text-white">Contacto</p>
                            <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                            <img class="d-inline mr-3" src="/vendor_asset/img/collaborator/itgicon.svg" alt="">
                            </a>
                            <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="">
                            <img class="d-inline mx-3 h-8" src="/vendor_asset/img/collaborator/linkedin.svg" alt="">
                            </a>
                            <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                            <img class="d-inline mx-3 h-8" src="/vendor_asset/img/collaborator/wticon.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
            



</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
import HomeMenu from '@/Pages/Collaborator/components/HomeMenu.vue'  
import MenuMobile from '@/Pages/Collaborator/components/HomeMobileMenu.vue'  
export default {
    components: {
        BreezeButton,
        Link,
        ModalCookies,
        HomeMenu,
        MenuMobile
    },

}

</script>

<style scoped>
.bg-trans{
    background-color:transparent !important;
}
#banner .title h1{
    letter-spacing: 5px;
}
#direction .direction-btn{
    box-shadow: 5px 5px 5px 0px rgba(255,156,6,0.63);
}
#offer{
    background-image: url('/vendor_asset/img/collaborator/offer.png');
}
#result{
    background-image: url('/vendor_asset/img/collaborator/result.png');
}
#offer,
#result{
    background-size: cover;
    height: 64em;
    background-repeat: no-repeat;
}
#footer .hicitty{
    background-image: url('/vendor_asset/img/collaborator/offer.png');
    background-size: cover;
    background-position: 10% -26%;
    background-repeat: no-repeat;
}
@media (max-width:767px) {
    .btn-outline-collaborator{
        border:2px #fff solid !important;
    }
    #banner{
        background-image: url('/vendor_asset/img/collaborator/bannermobile.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
    #banner .title h1{
        letter-spacing: 2px;
    }
    #banner .title h1, .banner-text p,
    .btn-outline-collaborator{
        color:#fff !important;
    }
    #banner .banner-overlay{
        background-color: #0006;
        height: 46em;
        width: 100%;
        position: absolute;
    }
    #offer{
        height: 105em;
        background-position: 29% 0%;
    }
    #result{
        height: 95em;
        background-position: 68% 35%;
        background-size: auto;
    }
}
</style>