<template>
      <Carousel :autoplay="6000" :wrap-around="true" :transition="600">
    <Slide :key="'0'">
      <div style="background-image: url(/vendor_asset/img/bg-image/home.png);" class="bg-image welcome w-100  pt-50">
        <div class="row justify-content-center pt-50 m-0">
            <div  align="center" class="col-7 mb-4 p-0">
                <img id="logo-welcome" src="/vendor_asset/img/logo/logo-white.png">
            </div>
            <div class="w-100"></div>
            <div class="col-7 mb-4  p-0">
                <p id="welcome-text" class="text-center">Un viaje lleno de experiencias y<br>recuerdos</p>
            </div>
            <div class="w-100"></div>
            <div class="col-7 my-4  p-0">
                <div class="container">
                <div class="row m-0 w-100 justify-content-center">
                    <div class="col-4 d-flex justify-content-center pr-1 pt-10 discount">
                        <Link
                            id="button-souvernirs"
                            class="bg-info" 
                            :href="route('souvenirs')">
                                Souvenirs
                        </Link>
                    </div>
                    <div class="col-4 d-flex justify-content-center pl-1 pt-10 discount">
                            <Link
                                id="button-activities"
                                class="bg-info"
                                :href="route('activities')">
                                    Actividades
                            </Link>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </Slide>
    <Slide :key="'1'">
      <div style="background-image: url(/vendor_asset/img/bg-image/home-2.jpg);" class="bg-image welcome w-100  pt-50">
        <div class="row justify-content-center pt-50 m-0">
            <div  align="center" class="col-7 mb-4 p-0">
                <img id="logo-welcome" src="/vendor_asset/img/logo/logo-white.png">
            </div>
            <div class="w-100"></div>
            <div class="col-7 mb-4  p-0">
                <p id="welcome-text" class="text-center">Un viaje lleno de experiencias y<br>recuerdos</p>
            </div>
            <div class="w-100"></div>
            <div class="col-7 my-4  p-0">
                <div class="container">
                <div class="row m-0 w-100 justify-content-center">
                    <div class="col-4 d-flex justify-content-center pr-1 pt-10 discount">
                        <Link
                            id="button-souvernirs"
                            class="bg-info" 
                            :href="route('souvenirs')">
                                Souvenirs
                        </Link>
                    </div>
                    <div class="col-4 d-flex justify-content-center pl-1 pt-10 discount">
                            <Link
                                id="button-activities"
                                class="bg-info"
                                :href="route('activities')">
                                    Actividades
                            </Link>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </Slide>
  </Carousel>

</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { Carousel, Pagination, Slide } from 'vue3-carousel';

    import 'vue3-carousel/dist/carousel.css';

    export default{
        components: {
            Link,
            Carousel,
            Slide,
            Pagination,
        },
    }
</script>
<style scope>
    .welcome{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
    }
    #welcome-text{
        font-family: 'Futur', sans-serif;
        line-height: 1.5em;
    }
</style>