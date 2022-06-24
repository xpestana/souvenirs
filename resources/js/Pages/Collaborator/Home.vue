<template>

    <ModalCookies/>
    <div class="d-none d-xl-block">
        <HomeMenu/>
    </div>
    <div class="d-xl-none">
        <MenuMobile/>
    </div>
        <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903" class="d-none d-xl-block">
            <div class="banner-wticon fixed right-6 bottom-16 rounded-md d-flex p-2 z-50">
                <img src="/vendor_asset/img/collaborator/wticon.svg" class="px-1">
                <p class="text-white ml-2.5 xl:ml-3.5 leading-4 whitespace-nowrap">¡Contacta con <br>nosotros!</p>
            </div>
        </a>
        <section id="banner" class="container-fluid xl:px-16 2xl:px-28 mb-28 lg:flex relative">
        <div class="d-xl-none banner-overlay"></div>
        <div class="row pb-14 md:pb-0 my-auto">
            <div class="col-12 col-xl-6 pt-44 pl-8">
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
                    <Link :href="route('collaborator.register')" class="btn btn-collaborator w-48 mx-auto mx-md-0 text-xl my-2">
                        <p class="text-xl">Regístrate</p>
                    </Link>
                    <Link :href="route('login')" class="btn btn-outline-collaborator w-48 text-xl mx-auto ml-md-4 my-2">Iniciar Sesión</Link>
                </div>
            </div>
            <div class="d-none  d-xl-block col-md-6 pt-16">
                <div class="relative">
                    <img src="/vendor_asset/img/collaborator/banner1.png" class="absolute left-0 top-10" width="200">
                    <img src="/vendor_asset/img/collaborator/banner2.png"  class="absolute top-16 right-8" width="200">
                    <img src="/vendor_asset/img/collaborator/bannercenter.png" width="450" class="mx-auto">
                    <img src="/vendor_asset/img/collaborator/banner3.png"  class="absolute left-4 bottom-4" width="160">
                </div>
            </div>
        </div>
        </section>
        <section id="direction" class="container-fluid xl:px-16 2xl:px-28 lg:flex flex-column my-8 lg:my-36">
            <div class="row justify-content-center mt-auto">
                <div class="col-12 col-md-9 px-8 md:px-0">
                    <h1 class="text-center text-4xl md:text-5xl">¿A quién está dirigido?</h1>
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
            <div class="row mb-auto justify-content-center justify-content-md-around lg:px-40">
                <div class="direction-btn text-2xl col-7 col-md-3 my-4 md:my-0 text-center text-white py-2 rounded">Apartamentos <br> turísticos</div>
                <div class="direction-btn text-2xl  col-7 col-md-3 py-4 md:py-8 my-4 md:my-0 text-center text-white rounded">Hoteles</div>
                <div class="direction-btn text-2xl  col-7 col-md-3  my-4 md:my-0 text-center text-white py-2 rounded">Negocios <br> turísticos</div>
            </div>
        </section>
        <section id="offer" class="container-fluid xl:px-16 2xl:px-28 md:flex">
            <div class="row my-auto justify-content-around px-2 md:px-32 lg:pb-60 pt-24 lg:pt-60">
                <div class="col-12">
                    <h1 class="text-center text-4xl md:text-5xl text-white md:pl-24 mb-8 md:mb-0">¿Qué ofrecemos?</h1>
                </div>
                <div class="col-md-4">
                    <img class="h-64 md:h-96 mx-auto" src="/vendor_asset/img/collaborator/section1.png" alt="">
                </div>
                <div class="col-md-8">
                    <div class="row 2xl:pr-10">
                        <div class="col-12">
                            <p class="text-white text-xl my-4">
                                Pon al alcance de los huéspedes una gran variedad de <br>
                                experiencias y servicios que ofrecemos desde <b>Hicitty</b> para la
                                ciudad que van a visitar.
                            </p>
                        </div>
                        <div class="col-12 col-md-6 offer-item mt-3 md:mt-0">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/kayakn.svg" class="d-inline w-8">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Experiencias</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    El huésped podra escoger y reservar entre una gran cantidad de actividades  experiencias
                                    propias de la ciudad en la que se encuentra, como <b>tours guiados, espetáculos locales....</b>
                                </p>
                            </div>
                        </div>    
                        <div class="col-12 col-md-6 offer-item mt-3 md:mt-0">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/regalon.svg" class="d-inline w-6">
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
                                <img src="/vendor_asset/img/collaborator/info.svg" class="d-inline w-6">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Información turística</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    Ofrece toda la información relevante y de interés de la ciudad para que el
                                    huésped no se pierda nada.<br>
                                    Encontrará <b>guías de qué hacer, que visitar, donde comer, lugares de ocio, rutas....</b>
                                </p>
                            </div>
                        </div>  
                        <div class="col-12 col-md-6 offer-item mt-3">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/hicittylogopequeñon.svg" class="d-inline w-6">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Y mucho más</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    No todo tiene que ser turismo. Ofrece también una variedad de servicios que
                                    mejoren la experiencia del huésped como; <b> spa, tranfers, co-working, 
                                    lavandería....</b>
                                </p>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </section>
        <section id="slide" class="container-fluid xl:px-16 2xl:px-28  lg:flex flex-column mb-16 lg:mb-14 lg:mt-40 ">
            <div class="row mt-auto">
                <div class="col-12">
                    <h1 class="text-4xl md:text-5xl md:pl-24 mb-6 md:mb-4">¿Cómo lo hacemos?</h1>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-12">
                    <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
                        <Slide :key="0">
                            <div class="row">
                                <div class="col-12 col-md-6 pl-4 md:pl-28 text-left">
                                    <h2 class="text-2xl md:text-3xl font-weight-bolder md:pl-24 mb-8 md:mb-0">
                                        1. <span class="text-collaborator">Registro</span> en la plataforma
                                        y <span class="text-collaborator">alta</span> de los inmuebles
                                    </h2>
                                    <p class="text-base md:text-2xl mt-4 md:leading-8 md:pl-24">
                                        Regístrate en menos de 1 minuto y da de alta tus inmuebles para que podamos enviar
                                        los elementos de impacto personalizados.
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 px-8 md:px-2">
                                    <img src="/vendor_asset/img/collaborator/slide1.png" alt="img" class="w-86 md:w-3/4 mx-auto">
                                </div>
                            </div>
                        </Slide>
                        <Slide :key="1">
                            <div class="row">
                                <div class="col-12 col-md-6 pl-4 md:pl-28 text-left">
                                    <h2 class="text-2xl md:text-3xl font-weight-bolder md:pl-24">
                                        2. <span class="text-collaborator">Entrega</span> y
                                        <span class="text-collaborator">colocación</span> del elemento de impacto
                                        en el inmueble.
                                    </h2>
                                    <p class="text-base md:text-2xl md:leading-8 md:pl-24">
                                        Generamos tus QR y te lo enviamos. Luego coloca el elemento de impacto
                                        en un lugar que esté a la vista de forma sencilla y rápida y que sea fácil
                                        de escanear para el huésped.
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 px-8 md:px-2">
                                    <img src="/vendor_asset/img/collaborator/slide2.png" alt="img" class="w-28 md:w-56 mx-auto">
                                </div>
                            </div>
                        </Slide>
                        <Slide :key="2">
                            <div class="row">
                                <div class="col-12 col-md-6 pl-4 md:pl-28 text-left">
                                    <h2 class="text-2xl md:text-3xl font-weight-bolder md:pl-24">
                                        3. <span class="text-collaborator">Incentivación</span> al cliente
                                        para dejar un valoración
                                    </h2>
                                    <p class="text-base md:text-2xl my-4 md:leading-8 md:pl-24">
                                        Una vez acabe el hospedaje, incentivaremos al cliente a dejar una
                                        buena valoración al inmueble en el que se alojó.
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 px-8 md:px-2">
                                    <img src="/vendor_asset/img/collaborator/slide3.png" alt="img" class="w-86 md:  w-3/4 mx-auto">
                                </div>
                            </div>
                        </Slide>
                        <Slide :key="3">
                            <div class="row">
                                <div class="col-12 col-md-6 pl-4 md:pl-28 text-left">
                                    <h2 class="text-2xl md:text-3xl font-weight-bolder md:pl-24">
                                        4. <span class="text-collaborator">Control</span> de beneficios de los
                                        inmuebles
                                    </h2>
                                    <p class="text-base md:text-2xl mt-2 md:leading-8 md:pl-24">
                                        Desde la plataforma que ofrecemos a los colaboradores de HiCitty, podrán
                                        controlar en todo momento los inmuebles dados de alta y los beneficios 
                                        obtenidos de cada uno de ellos.
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 px-8 md:px-2">
                                    <img src="/vendor_asset/img/collaborator/slide4.png" alt="img" class="w-56 md:w-72 mx-auto">
                                </div>
                            </div>
                        </Slide>
                        <template #addons>
                            <Navigation />
                            <Pagination />
                        </template>
                    </Carousel>
                </div>
            </div>
        </section>
        <section id="result" class="container-fluid xl:px-16 2xl:px-28 md:flex">
            <div class="row my-auto  justify-content-around xl:px-32 pt-16 md:pt-44 md:pb-24">
                <div class="col-12">
                    <h1 class="text-center text-4xl md:text-5xl text-white mb-12 md:mb-16 lg:pt-14">¿Cuál es el resultado?</h1>
                </div>
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/val.svg" alt="img-card" class="w-24 h-24 mx-auto">
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
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/valoracionn.svg" alt="img-card" class="h-24 w-24 mx-auto">
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
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/dineron.svg" alt="img-card" class="h-24 w-24 mx-auto">
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
        <section id="win" class="container-fluid xl:px-16 2xl:px-28 lg:flex my-16 lg:my-28">
            <div class="row my-auto">
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
                <div class="col-12 mt-14 text-center ">
                    <Link :href="route('collaborator.register')" class="btn btn-win text-xl w-72">¡Quiero registrarme!</Link>
                </div>
            </div>
        </section>
        <section id="footer" class="container-fluid">
            <div class="row relative">
                <div class="md:px-48 hicitty h-32 md:h-96 w-100">
                    <img class="absolute left-0 right-0 md:top-24 lg:top-0 mx-auto 2xl:w-3/4" src="/vendor_asset/img/collaborator/footerhiccity.svg" alt="">
                </div>
                <div class="col-12 foot xl:pt-10 xl:px-16 2xl:px-28" style="background-color:#000">
                    <div class="row justify-content-between pb-8 xl:px-16 2xl:px-28">
                        <div class="col-12 col-md-4 col-xl-6 px-8">
                            <h1 class="text-4xl md:text-5xl text-white py-8">
                                Solo ganamos si tu ganas     
                            </h1>
                            <p class="text-sm text-white">
                                Copyright ©2022 HiCitty. Todos los derechos reservados 
                            </p>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2 px-8 px-md-2 pt-12 md:pl-24 flex flex-column">
                            <div class="">
                                <p class="text-white 2xl:text-xl mb-1">Visita nuestra web</p>
                                <Link :href="route('home')">
                                <img class="w-24 2xl:w-36 mr-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
                                </Link>
                            </div>
                            <div class="mt-4">
                                <p class="text-white mb-1 2xl:text-xl">Contacto</p>
                                <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                                <img class="d-inline mr-2 2xl:mr-2 icon" src="/vendor_asset/img/collaborator/itgicon.svg" alt="">
                                </a>
                                <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="">
                                <img class="d-inline mx-2 2xl:mx-2 h-8 icon" src="/vendor_asset/img/collaborator/linkedin.svg" alt="">
                                </a>
                                <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                                <img class="d-inline mx-2 2xl:mx-2 h-8 icon" src="/vendor_asset/img/collaborator/wticon.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import Header from '@/Layouts/Components/Header';
import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
import HomeMenu from '@/Pages/Collaborator/components/HomeMenu.vue'  
import MenuMobile from '@/Pages/Collaborator/components/HomeMobileMenu.vue'  
export default {
    components: {
        BreezeButton,
        Link,
        ModalCookies,
        HomeMenu,
        MenuMobile,
        Carousel,
        Slide,
        Navigation,
        Pagination,
        Header
    },
    data: () => {
        return {
        settings: {
            itemsToShow: 1,
            snapAlign: 'center',
            },
            showPopup:false,
            editados:false
        }
    },

}

</script>

<style scoped>
body{
    background-color: #fff;
}
*> :not(i){
    font-family: 'Montserrat', sans-serif;
}

.carousel__next{
    color: #FF9C06 !important;
}
.carousel__prev{
    color: #FF9C06 !important;
}

.bg-trans{
    background-color:transparent !important;
}
#banner .title h1{
    letter-spacing: 5px;
}
.banner-wticon{
    width: 4%;
    overflow: hidden;
    background-color: #808080;
    transition: background-color 1s,width 1s,;
} 
.banner-wticon:hover{
    background-color: #FF9C06;
    width: 14%;
} 
#direction .direction-btn{
    background-color: #FF9C06;
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
    background-repeat: no-repeat;
}
#footer .hicitty{
    background-image: url('/vendor_asset/img/collaborator/offer.png');
    background-size: cover;
    background-position: 10% -26%;
    background-repeat: no-repeat;
}
#footer .icon:hover{
    filter: invert(53%) sepia(76%) saturate(625%) hue-rotate(354deg) brightness(107%) contrast(104%);
}
#win  .btn-win{
    background-color: #FF9C06;
    color:#fff;
}

#win  .btn-win:hover{
    background-color: #fff;
    color: #FF9C06;
    border:2px solid #FF9C06;
}
@media (min-width:1900px) {
    .banner-wticon{
        width: 2%;
    } 
}
@media only screen and (min-width: 1380px) and (max-width: 1900px) {
.banner-wticon{
        width: 3%;
    } 
}
@media (min-width:1280px) {
    #result{
        height: 70em;
    }
    /*#offer{
        height: 65em;
    }*/
}
@media (max-width:1200px) {
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
    .btn-outline-collaborator{
        border:2px #fff solid !important;
    }
    #banner .banner-overlay{
        background-color: #0006;
        height: 100%;
        width: 100%;
        position: absolute;
        left:0;
    }
    #offer{
        height: 75em;
        background-position: 29% 0%;
    }
    #result{
        height: 70em;
        background-position: 68% 35%;
        background-size: auto;
    }
}

@media (max-width:767px) {
    #offer{
        height: 110em;
        background-position: 29% 0%;
    }
    #result{
        height: 93em;
        background-position: 68% 35%;
        background-size: auto;
    }
    #slide h1{
        text-align:center;
    }
}
</style>