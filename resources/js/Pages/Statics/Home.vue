<template>
      <Carousel :autoplay="6000" :wrap-around="true" :transition="600">
    <Slide :key="0">
      <div style="background-image: url(/vendor_asset/img/bg-image/home.png);" class="bg-image welcome w-100  pt-50">
        
        </div>
    </Slide>
    <Slide :key="1">
      <div style="background-image: url(/vendor_asset/img/bg-image/home-2.jpg);" class="bg-image welcome w-100  pt-50">
        
        </div>
    </Slide>
  </Carousel>
  <div class="row justify-content-center pt-50 m-0 text-home">
            <div class="col-7  mt-4 p-0">
                <img id="logo-welcome" src="/vendor_asset/img/logo/logo-white.png" class="mx-auto">
                <div class="w-100"></div>
            <div class="col-12  mt-4  p-0">
                <p id="welcome-text" class="text-center">Un viaje lleno de experiencias y<br>recuerdos</p>
            </div>
            <div class="w-100 mt-4"></div>
            <div class="col-12 my-4 p-0 row justify-content-center">
                <div class="blog-btn text-center col-md-4 col-sm-12">
                    <Link 
                        class="bg-info" 
                        :href="route('souvenirs')">
                            Souvenirs
                    </Link>
                </div>
                <div class="blog-btn text-center col-md-4 col-sm-12">
                    <Link
                        class="bg-info"
                        :href="route('activities')">
                            Actividades
                    </Link>
                </div>
            </div>
        </div>
        </div>
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
    .text-home{
        position: absolute;
        top: 13%;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto !important;
    }
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
    @media (max-width: 767px){
        .blog-btn {
            margin-bottom: 10px !important; 
        }
    }
</style>