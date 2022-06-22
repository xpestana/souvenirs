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
                <p class="text-white ml-2.5 xl:ml-3.5 leading-4 whitespace-nowrap">¡Contact <br>us!</p>
            </div>
        </a>
        <section id="banner" class="container-fluid xl:px-16 2xl:px-28 mb-28 lg:flex relative">
        <div class="d-xl-none banner-overlay"></div>
        <div class="row pb-14 md:pb-0 my-auto">
            <div class="col-12 col-xl-6 pt-44 pl-8">
                <div class="title">
                    <h1 class="text-5xl md:text-7xl font-weight-bolder">
                        Improve the <span class="text-collaborator">experience</span> of guests
                    </h1>
                </div>
                <div class="banner-text">
                    <p class="text-justify pt-2 text-xl pr-16 md:pr-0">
                        Increase your profits and reviews
                        accommodation offering a wide variety of services
                    </p>
                </div>
                <div class="pt-8 d-flex flex-column flex-md-row">
                    <Link :href="route('collaborator.register')" class="btn btn-collaborator w-48 mx-auto mx-md-0 text-xl my-2">
                        <p class="text-xl">Sign up</p>
                    </Link>
                    <Link :href="route('login')" class="btn btn-outline-collaborator w-48 text-xl mx-auto ml-md-4 my-2">Log in</Link>
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
                    <h1 class="text-center text-4xl md:text-5xl">Who is it for?</h1>
                    <p class="text-center text-xl md:text-3xl mt-6 md:mt-14">
                        At <b>Hicitty</b> we help hotel guests
                        and apartments have the best and fullest of experiences
                    </p>
                    <p class="text-center text-base md:text-xl mt-12">
                        Therefore, this is of interest to you if you <b>manage</b> any of the
                        <br>following establishments:
                    </p>
                </div>
            </div>
            <div class="row mb-auto justify-content-center justify-content-md-around lg:px-40">
                <div class="direction-btn text-2xl col-7 col-md-3 my-4 md:my-0 text-center text-white py-2 rounded">Tourist apartments <br></div>
                <div class="direction-btn text-2xl  col-7 col-md-3 py-4 md:py-8 my-4 md:my-0 text-center text-white rounded">Hotels</div>
                <div class="direction-btn text-2xl  col-7 col-md-3  my-4 md:my-0 text-center text-white py-2 rounded">Business <br> tourism</div>
            </div>
        </section>
        <section id="offer" class="container-fluid xl:px-16 2xl:px-28 md:flex">
            <div class="row my-auto justify-content-around px-2 md:px-32 lg:pb-28 pt-24 lg:pt-0">
                <div class="col-12">
                    <h1 class="text-center text-4xl md:text-5xl text-white md:pl-24 mb-8 md:mb-0">What we offer?</h1>
                </div>
                <div class="col-md-4">
                    <img class="h-64 md:h-96 mx-auto" src="/vendor_asset/img/collaborator/section1.png" alt="">
                </div>
                <div class="col-md-8">
                    <div class="row 2xl:pr-10">
                        <div class="col-12">
                            <p class="text-white text-xl my-4">
                                Make available to guests a wide variety of <br>
                                experiences and services that we offer from <b>Hicitty</b> for the
                                city ​​they are going to visit.
                            </p>
                        </div>
                        <div class="col-12 col-md-6 offer-item mt-3 md:mt-0">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/kayakn.svg" class="d-inline w-8">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Experiences</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    The guest can choose and book from a large number of activities, experiences
                                    typical of the city in which it is located, such as <b>guided tours, local shows....</b>
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
                                    From the typical <b>magnets, postcards and other souvenirs</b> to gastronomic souvenirs
                                    such as <b>cheeses, wines, products, typical of the city....</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 offer-item mt-3">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/info.svg" class="d-inline w-6">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">Tourist information</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    It offers all the relevant and interesting information about the city so that the
                                    guest do not miss anything.<br>
                                    You will find <b>guides on what to do, what to visit, where to eat, places of leisure, routes....</b>
                                </p>
                            </div>
                        </div>  
                        <div class="col-12 col-md-6 offer-item mt-3">
                            <div class="offer-title">
                                <img src="/vendor_asset/img/collaborator/hicittylogopequeñon.svg" class="d-inline w-6">
                                <p class="d-inline text-xl font-weight-bolder text-white pl-2.5">And much more</p>
                            </div>
                            <div class="offer-title">
                                <p class="text-base text-white pl-11">
                                    Not everything has to be tourism. It also offers a variety of services that
                                    improve the guest experience such as; <b>spa, transfers, co-working,
                                    laundry....</b>
                                </p>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </section>
        <section id="slide" class="container-fluid xl:px-16 2xl:px-28 lg:flex flex-column mb-16 lg:mb-14 lg:mt-14 ">
            <div class="row mt-auto">
                <div class="col-12">
                    <h1 class="text-4xl md:text-5xl md:pl-24 mb-6 md:mb-4">How do we do it?</h1>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-12">
                    <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
                        <Slide :key="0">
                            <div class="row">
                                <div class="col-12 col-md-6 pl-4 md:pl-28 text-left">
                                    <h2 class="text-2xl md:text-3xl font-weight-bolder md:pl-24 mb-8 md:mb-0">
                                        1. <span class="text-collaborator">Registration</span> on the platform
                                        and <span class="text-collaborator">registration</span> of the properties
                                    </h2>
                                    <p class="text-base md:text-2xl mt-4 md:leading-8 md:pl-24">
                                        Register in less than 1 minute and register your properties so that we can send
                                        custom impact elements.
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
                                        2. <span class="text-collaborator">Delivery</span> and
                                        <span class="text-collaborator">placement</span> of the impact element
                                        in the property.
                                    </h2>
                                    <p class="text-base md:text-2xl md:leading-8 md:pl-24">
                                        We generate your QR and send it to you. Then place the impact element
                                        in a place that is visible simply and quickly and that is easy
                                        to scan for the guest.
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
                                        3. <span class="text-collaborator">Incentivization</span> to the client
                                        to leave a review
                                    </h2>
                                    <p class="text-base md:text-2xl my-4 md:leading-8 md:pl-24">
                                        Once the hosting is over, we will encourage the client to leave a
                                        good assessment of the property in which he stayed.
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
                                        4. <span class="text-collaborator">Control</span> of benefits of the
                                        estate
                                    </h2>
                                    <p class="text-base md:text-2xl mt-2 md:leading-8 md:pl-24">
                                        From the platform that we offer to HiCitty collaborators, they will be able to
                                        control at all times the properties registered and the benefits
                                        obtained from each of them.
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
                    <h1 class="text-center text-4xl md:text-5xl text-white mb-12 md:mb-16">What's the score?</h1>
                </div>
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/val.svg" alt="img-card" class="w-24 h-24 mx-auto">
                    </div>
                    <div class="card-title">
                        <h3 class="text-lg text-center font-weight-bolder">
                            Improve the tenant experience
                        </h3>
                    </div>
                    <div class="card-text">
                        <p class="text-base">
                            It offers a wide variety of services to guests who
                            allow them to enjoy a better experience.
                        </p>
                    </div>
                </div>
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/valoracionn.svg" alt="img-card" class="h-24 w-24 mx-auto">
                    </div>
                    <div class="card-title">
                        <h3 class="text-lg text-center font-weight-bolder">
                            Increase ratings
                        </h3>
                    </div>
                    <div class="card-text">
                        <p class="text-base">
                            By improving the tenant experience, we will encourage them to stop
                            a good assessment of the site where they have stayed.
                        </p>
                    </div>
                </div>
                <div class="col-9 col-md-3 my-2 md:my-0 rounded-lg bg-white p-3 result-card shadow-lg">
                    <div class="card-icon">
                        <img src="/vendor_asset/img/collaborator/dineron.svg" alt="img-card" class="h-24 w-24 mx-auto">
                    </div>
                    <div class="card-title">
                        <h3 class="text-lg text-center font-weight-bolder">
                            Add a new income line
                        </h3>
                    </div>
                    <div class="card-text">
                        <p class="text-base">
                            You will receive 20% of everything the client has bought without having to invest
                            a minimum of time and work.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <p class="text-center pt-8 md:pt-16 text-2xl md:text-3xl text-white">And the best of all</p>
                    <h1 class="text-center text-3xl md:text-5xl text-white mt-6 px-8 md:px-0">Without investing time or money</h1>
                </div>
            </div>
        </section>
        <section id="win" class="container-fluid xl:px-16 2xl:px-28 lg:flex my-16 lg:my-28">
            <div class="row my-auto">
                <div class="col-12 md:px-48">
                    <h1 class="text-center text-3xl md:text-6xl font-weight-bolder">
                        Start earning <br> with Hicitty
                    </h1>
                    <p class="text-center text-xl md:text-2xl mt-4">
                        You are just one step away from starting to get the most out of your properties.
                        Sign up and start earning.
                    </p>
                    <div class="text-center mt-8">
                        <div class="d-md-inline pl-8 mb-6">
                            <i class="fas fa-check p-2 text-white rounded" style="background-color:#aacfe4;"></i>
                            <p class="text-2xl d-inline mr-4 font-weight-bolder">
                                Effortless   
                            </p>
                        </div>
                        <div class="d-md-inline">
                            <i class="fas fa-check p-2 text-white rounded" style="background-color:#aacfe4;"></i>
                            <p class="text-2xl d-inline font-weight-bolder">
                                100% Free    
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-14 text-center ">
                    <Link :href="route('collaborator.register')" class="btn btn-win text-xl w-72">I want to register!</Link>
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
                                We only win if you win
                            </h1>
                            <p class="text-sm text-white">
                                Copyright ©2022 HiCitty. All rights reserved
                            </p>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2 px-8 px-md-2 pt-12 md:pl-24 flex flex-column">
                            <div class="">
                                <p class="text-white 2xl:text-xl mb-1">Visit our website</p>
                                <Link :href="route('home')">
                                <img class="w-24 2xl:w-36 mr-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
                                </Link>
                            </div>
                            <div class="mt-4">
                                <p class="text-white mb-1 2xl:text-xl">Contact</p>
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
    font-family:Montserrat;
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
@media (min-width:1380px) {
    .banner-wticon{
        width: 3%;
    } 
}
@media (min-width:1280px) {
    #result{
        height: 70em;
    }
    #offer{
        height: 65em;
    }
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