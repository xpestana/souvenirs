<template>
    <Head title="Activities"/>
<Layout>
<!-- Breadcrumb Area Start Here -->
<div class="breadcrumb-area pt-65 pb-70 bg-img bg-info">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 style="font-size: 2.5rem;" class="text-white">{{ product.title }}</h1>        
            </div>
            <div class="col-md-3">
                <div align="center" class="col-md-12">
                    <template v-if="product.activities.priceN">
                        <h3 style="font-size: 1.5rem;" class="text-white">Adulto: {{ product.activities.priceA }} € <br>Niño: {{ product.activities.priceN }} € </h3>
                    </template>
                    <template v-else>
                       <h3 style="font-size: 1.5rem;" class="text-white">Precio: {{ product.activities.priceA }} € </h3>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true" :autoplay="7000">
                <Slide v-for=" image in product.images" :key="image.id">
                    <div :style="'background:url(/storage/souvenirs/'+image.url+')'" class="img-act"></div>
                </Slide>
            </Carousel>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End Here -->

<div class="main-product-thumbnail white-bg pt-90 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-all-40">
                <Back/>
                <div class="grid-list-view d-flex align-items-center  mb-sm-15 mt-4">
                    <ul class="nav tabs-area d-flex align-items-center">
                        <li><a class="active mr-3 mb-4" href="#description"><i class="fas fa-clipboard-list"></i> Descripción</a></li>
                        <li><a class="active mr-3 mb-4" href="#price"><i class="fas fa-euro-sign"></i> Precios de la actividad</a></li>
                        <li><a class="active mr-3 mb-4" href="#details"><i class="fas fa-info-circle"></i> Cancelación</a></li>
                        <li><a class="active mr-3 mb-4" href="#point"><i class="fas fa-map-marker-alt"></i> Punto de encuentro</a></li>
                    </ul>
                </div>
                <div id="description" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;">Descripción</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15" v-html="product.description"> 
                </div>
                <div id="price" class="col-md-12 mt-4 pb-15">
                    <h3 style="font-size: 2rem;" class="mt-3 border-bottom">Precio</h3> 
                    <div class="row ">
                        <template v-if="product.activities.priceN">
                            <div class="col-md-6 mt-4">
                                <ul>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;">Adultos <i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceA }} €</h3></li>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;">Niños <i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceN }} €</h3></li>
                                </ul>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-md-6">
                                <ul>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;"><i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceA }} €</h3></li>
                                </ul>
                            </div>    
                        </template>
                    </div>
                </div>
                <div id="details" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Detalles de cancelación</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15" v-html="product.activities.details">
                </div>
                <div id="point" class="col-md-12 mt-4  border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Punto de encuentro</h3> 
                </div>
                <div style="overflow-x: scroll;" class="col-md-12 mt-3 pb-15" v-html="product.activities.iframe">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-all-40">
                <calendar :product="product"/>
            </div>
        </div>
    </div>
</div>
    <activities/>
</Layout>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
    import Back from '@/Layouts/Components/Back.vue'
    import Calendar from '@/Layouts/Components/Calendar.vue' 
    import Activities from '@/Layouts/Components/Activities.vue' 
    import { Carousel, Navigation, Slide } from 'vue3-carousel'
    import 'vue3-carousel/dist/carousel.css';
    import Moment from 'moment'

    export default {
        components: {
            Link,
            Head,
            Back,
            Layout,
            Activities,
            Carousel,
            Slide,
            Navigation,
            Calendar,
        },
        data: () => {
            return {
                moment:null,
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
            breakpoints: {
              700: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
              1024: {
                itemsToShow: 2.5,
                snapAlign: 'start',
                },
                },
            }

        },
        props: {
            product: Object,
        },
        created(){
            this.moment=Moment;
        }
    }
</script>
<style scope>
    .img-back{
        height: 300px;
    }
    .img-thumb{
        width: 100%;
        height: 100px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        margin-left: 10px;
    }
    .carousel__prev, .carousel__next{
        background-color: #31516B !important; 
    }
    .pro-price{
        margin-bottom: 0px;
    }
    .img-act{
        width: 100%;
        height: 300px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        margin-left: 10px;
    }
    #description p{
        font-size: 17px;
    }
    .border-bottom{
        border-bottom: 2px solid #ccc !important;
            padding-bottom: 10px !important;
    }
    .price{
        font-size: 25px !important;
        border-radius: 100%;
        padding: 20px 20px;
    }
</style>